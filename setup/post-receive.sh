#!/usr/bin/env bash
echo "##### post-receive hook #####"
read oldrev newrev refname
echo "Push triggered update to revision $newrev ($refname)"

RUN_FOR_REF="refs/heads/main"
if [[ "$refname" ==  "$RUN_FOR_REF" ]]; then
    GIT="env -i git"
    CMD_CD="cd $(readlink -nf "$PWD/..")"
    CMD_FETCH="timeout 15 $GIT fetch"
    CMD_COMPOSER="if [ -d vendor/ ]; then sudo chmod -R ug+rw vendor/; fi; composer install --optimize-autoloader --no-dev 2>&1"
    CMD_MIGRATE="php artisan migrate --force"
    CMD_NPM="npm ci"
    CMD_BUILD="npm run build"
    CMD_LARAVEL_OPTIMIZE="php artisan optimize"
    CMD_LARAVEL_DOWN="php artisan down"
    CMD_CLEAR_PAGE_CACHE="php artisan app:clear-page-cache"
    CMD_LARAVEL_UP="php artisan up"
    CMD_PM2="pm2 restart pm2.json"
    CMD_HORIZON="sudo service horizon restart"

    echo "$ $CMD_CD"
    eval ${CMD_CD}
    echo "$ $CMD_FETCH"
    eval ${CMD_FETCH}
    echo "$ $CMD_COMPOSER"
    eval ${CMD_COMPOSER}

    echo "$ $CMD_LARAVEL_OPTIMIZE"
    eval ${CMD_LARAVEL_OPTIMIZE}

    echo "$ $CMD_MIGRATE"
    eval ${CMD_MIGRATE}

    if $GIT diff --name-only $oldrev $newrev | grep "^package-lock.json"; then
        echo "$ $CMD_NPM"
        eval $CMD_NPM
    else
        echo "# Skipping npm install, lockfile not modified"
    fi

    # Put the app in maintenance mode during build
    echo "$ $CMD_LARAVEL_DOWN"
    eval $CMD_LARAVEL_DOWN
    echo "$ $CMD_BUILD"
    eval $CMD_BUILD || BUILD_EXIT_CODE=$?
    echo "$ $CMD_HORIZON"
    eval $CMD_HORIZON
    echo "$ $CMD_PM2"
    eval $CMD_PM2
    echo "$ $CMD_CLEAR_PAGE_CACHE"
    eval ${CMD_CLEAR_PAGE_CACHE}
    # Clear maintenance mode after deployment (regardless of errors)
    echo "$ $CMD_LARAVEL_UP"
    eval $CMD_LARAVEL_UP
else
    echo "Ref does not match $RUN_FOR_REF, exiting."
fi

echo "##### end post-receive hook #####"
