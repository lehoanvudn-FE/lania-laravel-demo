#!/usr/bin/env bash
set -euo pipefail

export PORT="${PORT:-10000}"
export DB_DATABASE="${DB_DATABASE:-/var/www/html/database/database.sqlite}"

if [ -z "${APP_KEY:-}" ]; then
    export APP_KEY="$(php artisan key:generate --show --no-interaction)"
fi

mkdir -p "$(dirname "$DB_DATABASE")" storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache
touch "$DB_DATABASE"

php artisan config:clear --no-interaction
php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction

php artisan serve --host=0.0.0.0 --port="$PORT"
