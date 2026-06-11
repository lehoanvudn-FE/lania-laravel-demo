FROM composer:2 AS vendor

WORKDIR /app

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader \
    --no-scripts

COPY . .
RUN composer dump-autoload --optimize

FROM php:8.4-cli-alpine

RUN apk add --no-cache bash sqlite \
    && docker-php-ext-install pdo pdo_sqlite

WORKDIR /var/www/html

COPY --from=vendor /app .
COPY docker/start.sh /usr/local/bin/start-laravel

RUN chmod +x /usr/local/bin/start-laravel \
    && mkdir -p database storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data database storage bootstrap/cache

ENV APP_ENV=production \
    APP_DEBUG=false \
    LOG_CHANNEL=stderr \
    DB_CONNECTION=sqlite \
    DB_DATABASE=/var/www/html/database/database.sqlite \
    SESSION_DRIVER=file \
    CACHE_STORE=file \
    QUEUE_CONNECTION=sync

EXPOSE 10000

CMD ["start-laravel"]
