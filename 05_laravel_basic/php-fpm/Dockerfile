FROM php:8.1.1-fpm

#
# php:7.3-fpm 
#

# 拡張 phpなど
RUN apt update && apt install -y zlib1g-dev g++ libicu-dev zip libzip-dev zip libpq-dev \
    && docker-php-ext-install intl opcache pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# memo
#RUN apt update && apt install -y procps
#
# laravel アプリのソースをコンテナイメージにコピー
# .envに秘匿情報がはいっている場合は .dockerignore で除外します。
COPY my-laravel-basic/ /var/www/html/
RUN composer install