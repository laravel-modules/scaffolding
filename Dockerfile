FROM php:8.0-fpm-alpine

ARG SERVER_USER=laravel
ARG SERVER_GROUP=laravel

WORKDIR /app

RUN adduser -g $SERVER_GROUP -s /bin/sh -D $SERVER_USER

RUN sed -i "s/user = www-data/user = $SERVER_USER/g" /usr/local/etc/php-fpm.d/www.conf
RUN sed -i "s/group = www-data/group = $SERVER_GROUP/g" /usr/local/etc/php-fpm.d/www.conf

RUN apk add --no-cache --update \
    && apk add build-base \
    git grep curl bash \
    zlib-dev libzip-dev \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libxml2-dev \
    bzip2-dev \
    libmcrypt-dev \
    zip unzip \
    autoconf pcre-dev \
    gmp gmp-dev

# Install PHP Intl Extention
RUN set -xe \
    && apk add --update \
        icu \
    && apk add --no-cache --virtual .php-deps \
        make \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        zlib-dev \
        icu-dev \
        g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        intl \
    && docker-php-ext-enable intl \
    && { find /usr/local/lib -type f -print0 | xargs -0r strip --strip-all -p 2>/dev/null || true; } \
    && apk del .build-deps \
    && rm -rf /tmp/* /usr/local/lib/php/doc/* /var/cache/apk/*

RUN docker-php-ext-install mysqli pdo pdo_mysql tokenizer zip exif pcntl xml bcmath gmp

RUN docker-php-ext-configure gd --with-freetype --with-jpeg

RUN docker-php-ext-install gd

RUN pecl channel-update pecl.php.net \
    && pecl install mcrypt-1.0.4 \
    && docker-php-ext-enable mcrypt bcmath

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="~/.composer/vendor/bin:./vendor/bin:${PATH}"

RUN set -eux; \
    mkdir -p storage/logs storage/framework bootstrap/cache; \
    composer install --prefer-dist --no-progress --no-suggest --optimize-autoloader; \
    composer clear-cache

ENV PATH="/usr/local/bin:${PATH}"

RUN apk add nginx supervisor ffmpeg

RUN mkdir -p /run/nginx

COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY docker/nginx/default.conf /etc/nginx/http.d/default.conf

RUN sed -i "s/user nginx;/user $SERVER_USER;/g" /etc/nginx/nginx.conf

COPY docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

ENTRYPOINT ["/app/docker/entrypoint.sh"]

CMD ["/usr/bin/supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]
