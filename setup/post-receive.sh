#!/usr/bin/env bash
echo "##### post-receive hook #####"
read oldrev newrev refname
echo "Push triggered update to revision $newrev ($refname)"

RUN_FOR_REF="refs/heads/main"
if [[ "$refname" ==  "$RUN_FOR_REF" ]]; then
    GIT="env -i git"
    APP_DIR="$(readlink -nf "$PWD/..")"

    echo "$ cd ${APP_DIR}"
    cd "${APP_DIR}"

    if [ -d "public/build" ] && [ ! -L "public/build" ]; then
        echo "ERROR: public/build is a real directory, not a symlink."
        echo "Run the one-time migration before using this script:"
        echo "  mkdir -p public/builds && mv public/build public/builds/build-initial && ln -s builds/build-initial public/build"
        exit 1
    fi

    BUILD_TIMESTAMP=$(date +%Y%m%d%H%M%S)
    BUILD_DIR="builds/build-${BUILD_TIMESTAMP}"
    BUILDS_KEEP=3

    CMD_FETCH="timeout 15 $GIT fetch"
    CMD_COMPOSER="if [ -d vendor/ ]; then sudo chmod -R ug+rw vendor/; fi; composer install --optimize-autoloader --no-dev 2>&1"
    CMD_NPM="npm ci"
    GIT_COMMIT_HASH=$($GIT rev-parse --short HEAD)
    GIT_COMMIT_DATE=$($GIT log -1 --format=%cI)
    CMD_BUILD="VITE_BUILD_OUTDIR=\"${BUILD_DIR}\" GIT_COMMIT_HASH=\"${GIT_COMMIT_HASH}\" GIT_COMMIT_DATE=\"${GIT_COMMIT_DATE}\" npm run build"
    CMD_SYMLINK_NEW="ln -s \"${BUILD_DIR}\" \"public/build-${BUILD_TIMESTAMP}.new\""
    CMD_SYMLINK_SWAP="mv -Tf \"public/build-${BUILD_TIMESTAMP}.new\" \"public/build\""
    CMD_MIGRATE="php artisan migrate --force"
    CMD_LARAVEL_OPTIMIZE="php artisan optimize"
    CMD_LARAVEL_DOWN="php artisan down"
    CMD_LARAVEL_UP="php artisan up"
    CMD_CLEAR_PAGE_CACHE="php artisan app:clear-page-cache"
    CMD_PM2="pm2 restart pm2.json"
    CMD_HORIZON="sudo service horizon restart"
    CMD_CLEANUP="ls -dt public/builds/build-* | tail -n +$((BUILDS_KEEP + 1)) | xargs --no-run-if-empty rm -rf"

    echo "$ $CMD_FETCH"
    eval $CMD_FETCH

    echo "$ $CMD_COMPOSER"
    eval $CMD_COMPOSER

    echo "$ $CMD_MIGRATE"
    eval $CMD_MIGRATE

    if $GIT diff --name-only $oldrev $newrev | grep "^package-lock.json"; then
        echo "$ $CMD_NPM"
        eval $CMD_NPM
    else
        echo "# Skipping npm install, lockfile not modified"
    fi

    # Build outside maintenance mode: old assets/SSR stay live until restart
    echo "$ $CMD_BUILD"
    mkdir -p public/builds
    eval $CMD_BUILD || {
        echo "Build failed, aborting deployment"
        rm -rf "public/${BUILD_DIR}"
        exit 1
    }

    # Maintenance mode: only for symlink swap, migrations, and restarts
    echo "$ $CMD_LARAVEL_DOWN"
    eval $CMD_LARAVEL_DOWN

    echo "$ $CMD_SYMLINK_NEW"
    eval $CMD_SYMLINK_NEW
    echo "$ $CMD_SYMLINK_SWAP"
    eval $CMD_SYMLINK_SWAP

    echo "$ $CMD_LARAVEL_OPTIMIZE"
    eval $CMD_LARAVEL_OPTIMIZE

    echo "$ $CMD_HORIZON"
    eval $CMD_HORIZON

    echo "$ $CMD_PM2"
    eval $CMD_PM2

    echo "$ $CMD_CLEAR_PAGE_CACHE"
    eval $CMD_CLEAR_PAGE_CACHE

    # Clear maintenance mode after deployment
    echo "$ $CMD_LARAVEL_UP"
    eval $CMD_LARAVEL_UP

    echo "$ $CMD_CLEANUP"
    eval $CMD_CLEANUP

else
    echo "Ref does not match $RUN_FOR_REF, exiting."
fi

echo "##### end post-receive hook #####"
