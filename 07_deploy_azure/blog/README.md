# Laravel(コンテナ)をAzureへのデプロイする

![image](./Azure_Laravel.png)

LaravelアプリをAzureへのデプロイします。
コンテナ化することでデプロイ先を選択




## Laravelのコンテナイメージについて
LaravelにはWEB Serverが必要になります。
1. Apapche
1. Nginx
がよく利用されます。

イメージの作成方法はいろいろありますが、今回は2パターン試しました。

### FROM php:7.4-apache の利用
![image](./laravel_apache_cont_image.png)

今回はApache含めたイメージ(FROM php:7.4-apache)をベースにしました。Apacheは php_module を介してLaravelにアクセスします。

### FROM php:7.4.3-fpm の利用
![image](./nginx_php-fpm.png)

アプリケーションはRedisとMySQLにアクセスする単純なアプリを作成しました。

php:7.4-apache を利用した dockerfile の例
```
FROM php:7.4-apache

# 拡張 phpなど
RUN apt update && apt install -y zlib1g-dev g++ libicu-dev zip libzip-dev zip libpq-dev \
    && docker-php-ext-install intl opcache pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#laravel アプリのソースをコンテナイメージにコピー
COPY ./ /var/www/html/
RUN composer install
# .htaccess
RUN a2enmod rewrite
```
## Laravelアプリのデプロイ先

以下にデプロイしてみました。

1. Azure Virtual Machine
1. Azure App Service
1. Azure Kubernetes Service
1. Azure Container Instance
1. Azure Container Apps

※ 手順をすべて書くと長くなるので簡単に記載します。
### 1. Azure Virtual Machine
手順を簡単に記載。

### 2. Azure App Service
手順を簡単に記載。

### 3. Azure Kubernetes Service
手順を簡単に記載。

### 4. Azure Container Instance
手順を簡単に記載。

### 5. Azure Container Apps

手順を簡単に記載。

### 6. Application Gatewayでロードバランシング
Application Gatewayでロードバランシングしてモニタリングしてみる。

ここまでを図にすると

![image](./workingOnAzure.png)

