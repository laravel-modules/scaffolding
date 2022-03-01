#!/bin/sh
set -xe

if [[ "$3" != "schedule:run" ]]; then
    php artisan config:clear

    echo "[+] Running Migrations..."
    php artisan migrate --force

    php artisan storage:link

    if [[ "$APP_ENV" == 'production' || "$APP_ENV" == "staging" ]]; then
        php artisan config:cache
    fi
fi
exec "$@"
