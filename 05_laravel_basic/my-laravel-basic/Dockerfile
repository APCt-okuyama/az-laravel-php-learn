#FROM php:7.4-apache
FROM php:8.1.1-apache

#
#
# php:7.4-apache に laravel をインストールして１つのイメージにまとめます。
#
#

# 拡張 phpなど
RUN apt update && apt install -y zlib1g-dev g++ libicu-dev zip libzip-dev zip libpq-dev \
    && docker-php-ext-install intl opcache pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# RUN apt update && apt install -y procps
# RUN apt-get install -y vim

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# laravel アプリのソースをコンテナイメージにコピー
# .envに秘匿情報がはいっている場合は .dockerignore で除外します。
COPY ./ /var/www/html/
RUN composer install

# .htaccess
RUN a2enmod rewrite

# APACHE_DOCUMENT_ROOT を変更
#ENV APACHE_DOCUMENT_ROOT /var/www/html/public
#RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
#RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf




