# SledgeHammerTime: one build, three runtime images (targets: fpm, web, ssr), the same images for prod and beta.
#   docker buildx bake -f docker/docker-bake.hcl            (see docker-bake.hcl; context is the repository root)
# Environment differences (prod vs beta) are runtime configuration only. The few VITE_* values the frontend reads are
# non-secret and identical for both, so they are build args with defaults rather than inputs.
ARG PHP_IMAGE=php:8.5-fpm-trixie
ARG NODE_IMAGE=node:24-trixie-slim

# The build stage runs on the builder's own architecture (the output is architecture independent: pure PHP vendor
# tree, built JS/CSS), so multi-arch builds only emulate the stages that really ship (fpm extensions, ssr install).
# ---------------------------------------------------------------------------------------------------------
FROM --platform=$BUILDPLATFORM ${PHP_IMAGE} AS php-base-build
COPY --from=ghcr.io/mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions bcmath exif gd intl opcache pcntl pdo_pgsql redis igbinary zip sockets \
 && rm -rf /var/lib/apt/lists/* /tmp/*

FROM ${PHP_IMAGE} AS php-base
COPY --from=ghcr.io/mlocati/php-extension-installer:latest /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions bcmath exif gd intl opcache pcntl pdo_pgsql redis igbinary zip sockets \
 && rm -rf /var/lib/apt/lists/* /tmp/*

FROM --platform=$BUILDPLATFORM ${NODE_IMAGE} AS node-bin
FROM --platform=$BUILDPLATFORM composer:2 AS composer-bin

# ---------------------------------------------------------------------------------------------------------
FROM php-base-build AS build
ARG GIT_COMMIT_HASH=unknown
ARG GIT_COMMIT_DATE=unknown
ARG APP_NAME=HammerTime
# the SSR server must be reachable from the web pod, and it is not run in cluster mode
ARG VITE_INERTIA_SSR_HOST=0.0.0.0
ARG VITE_INERTIA_CLUSTER=false
ENV GIT_COMMIT_HASH=${GIT_COMMIT_HASH} GIT_COMMIT_DATE=${GIT_COMMIT_DATE} COMPOSER_ALLOW_SUPERUSER=1 CI=true \
    APP_NAME=${APP_NAME} VITE_APP_NAME=${APP_NAME} \
    VITE_INERTIA_SSR_HOST=${VITE_INERTIA_SSR_HOST} VITE_INERTIA_CLUSTER=${VITE_INERTIA_CLUSTER}
COPY --from=composer-bin /usr/bin/composer /usr/local/bin/composer
COPY --from=node-bin /usr/local/bin/node /usr/local/bin/node
COPY --from=node-bin /usr/local/lib/node_modules /usr/local/lib/node_modules
RUN ln -s /usr/local/lib/node_modules/npm/bin/npm-cli.js /usr/local/bin/npm \
 && npm install -g pnpm@11 \
 && apt-get update && apt-get install -y --no-install-recommends git unzip \
 && rm -rf /var/lib/apt/lists/*
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist
COPY package.json pnpm-lock.yaml pnpm-workspace.yaml ./
RUN pnpm install --frozen-lockfile
COPY . .
RUN composer dump-autoload --optimize --no-dev --no-scripts
# dummy env only so artisan can boot while building; real env is injected at runtime
RUN APP_KEY=base64:AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA= APP_ENV=production \
    CROWDIN_PROJECT_IDENTIFIER=build CROWDIN_PROJECT_ID=0 CROWDIN_API_KEY=build CROWDIN_CLIENT_ID=build CROWDIN_CLIENT_SECRET=build \
    sh -c 'php artisan package:discover --ansi && pnpm run build && php artisan route:cache && php artisan view:cache && php artisan event:cache'

# runtime tree for the fpm image: everything the app needs at runtime, minus node tooling and tests
RUN mkdir /runtime && cp -a /app/. /runtime/ && rm -rf /runtime/node_modules /runtime/tests /runtime/coverage /runtime/.git /runtime/docs /runtime/.env
# resources/views/app.blade.php inlines this one file from node_modules at request time
RUN mkdir -p /runtime/node_modules/@fortawesome/fontawesome-free/css \
 && cp /app/node_modules/@fortawesome/fontawesome-free/css/svg-with-js.min.css /runtime/node_modules/@fortawesome/fontawesome-free/css/

# ---------------------------------------------------------------------------------------------------------
FROM php-base AS fpm
# reported as `build` by the JSON /status (config('app.build'))
ARG GIT_COMMIT_HASH=unknown
ENV GIT_COMMIT_HASH=${GIT_COMMIT_HASH}
RUN apt-get update && apt-get install -y --no-install-recommends postgresql-client && rm -rf /var/lib/apt/lists/*
RUN { echo "memory_limit = 256M"; echo "expose_php = Off"; echo "short_open_tag = On"; \
      echo "upload_max_filesize = 20M"; echo "post_max_size = 24M"; echo "zend.exception_ignore_args = Off"; \
      echo "fatal_error_backtraces = 0"; echo "session.upload_progress.enabled = 0"; \
      echo "opcache.enable=1"; echo "opcache.validate_timestamps=0"; echo "opcache.memory_consumption=96"; \
      echo "opcache.max_accelerated_files=20000"; } > /usr/local/etc/php/conf.d/99-app.ini
COPY docker/www.conf /usr/local/etc/php-fpm.d/zz-app.conf
WORKDIR /var/www/html
COPY --from=build --chown=www-data:www-data /runtime/ ./
RUN mkdir -p storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
 && chown -R www-data:www-data storage bootstrap/cache
USER www-data
EXPOSE 9000

# ---------------------------------------------------------------------------------------------------------
FROM nginx:1-alpine-slim AS web
# static assets + index.php only; PHP itself runs in the fpm container of the same pod (same absolute paths)
COPY --from=build /app/public /var/www/html/public

# ---------------------------------------------------------------------------------------------------------
FROM ${NODE_IMAGE} AS ssr
WORKDIR /app
COPY --from=build /app/bootstrap/ssr ./bootstrap/ssr
COPY --from=build /app/package.json /app/pnpm-lock.yaml /app/pnpm-workspace.yaml ./
RUN npm install -g pnpm@11 && pnpm install --frozen-lockfile --ignore-scripts \
 && npm uninstall -g pnpm && rm -rf /root/.npm /root/.cache
USER node
ENV NODE_OPTIONS=--max-old-space-size=192
CMD ["node", "bootstrap/ssr/ssr.js"]
