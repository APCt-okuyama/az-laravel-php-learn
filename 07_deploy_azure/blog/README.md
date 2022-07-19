# Laravel(コンテナ)をAzureへのデプロイする

![image](./Azure_Laravel.png)

LaravelアプリケーションをAzureへデプロイする方法について調査した結果をブログとして纏めておきます。

Laraveにはdocker-composeを利用したSailと呼ばれる環境構築ツールがありますが、こちらはあくまで開発環境向けということで今回は本番・運用環境はどうするのかという観点での検証です。

## (簡単に) Laravel とは

Javaの`SpringBoot` や NodeJSの`express` などと同じようにWEBのフルスタックのフレームワーク。フルスタックのWEBアプリとしてだけでなく、APIサーバーとしても利用可能。

(良いとこ)
WEB開発で必要なものが一通りそろっており日本語のドキュメントも非常に充実しています。
よく利用されるRDB(MySQL,Postgres,SQLServer)やCache(Redis)を利用する仕組みが整っている。
認証・認可の仕組みや並列処理を行うためのQueueの仕組みが整っている。

(悪いとこ)
特別悪いところは見当たらないが、ネットを検索していると他の言語に比べると処理が遅いという評価があるので、性能要件が極端に厳しいシステムには向いてなさそうですね(リアルタイム処理を求められる処理やIoTには向かない)。一般的なWEBのシステムでは問題ではないでしょう。

## コンテナ化
コンテナ化は必須ではないですが、スケーリングや開発環境の保守という観点で今回はコンテナ化します。

本番・運用環境のLaravelにはWEB Serverが必要になり
1. Apapche
1. Nginx
がよく利用されます。これらを含めたイメージを作成する必要があります。

作成方法はいろいろありますが、今回は2パターン（公式イメージを使った方法）を試しました。

### FROM php:x.x.x-apache の利用

Apacheを含めたイメージ(FROM php:8.1.1-apache)をベースにして、
Laravelのソースコード全体をコンテナに含めます。  
コンテナに composer(PHPのライブラリ管理ツール) を含めてLaravel自体のインストールをコンテナ内で行います。  

Clientからのリクエスト(http)を受け取った Apache は `php_module` を介してLaravelにアクセスします。

![image](./laravel_apache_cont_image.png)

dockerfile の例 (`php:8.1.1-apache` を利用)
```
FROM php:8.1.1-apache
# 拡張 phpなど
RUN apt update && apt install -y zlib1g-dev g++ libicu-dev zip libzip-dev zip libpq-dev \
    && docker-php-ext-install intl opcache pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# laravel アプリのソースをコンテナイメージにコピー
# .envに秘匿情報がはいっている場合は .dockerignore で除外します。
COPY ./ /var/www/html/

# laravel等のライブラリーのインストール
RUN composer install
# .htaccess
RUN a2enmod rewrite
```

### FROM php:x.x.x-fpm の利用
Nginx と php:x.x.x-fpm を利用します。
( FPM とは FastCGI Process Manager の略。Laravelアプリとの高速なプロセス間通信実現します。 )
Nginxを含めたイメージと php-fpmを含めたイメージの２つを用意する。  

![image](./nginx_php-fpm.png)
Clientからのリクエスト(http)を受け取った Nginx は `fpm (TCP通信)` を介してLaravelにアクセスします。

Nginxイメージ  
dockerfile の例 (`nginx:1.22-alpine` を利用)
```
FROM nginx:1.22-alpine
COPY default.conf /etc/nginx/conf.d/default.conf
```

nginxの設定の例  
fastcgi_pass に php-fpm-server を指定
```
server {
:
    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }
:
    # pass the PHP scripts to FastCGI server listening on 127.0.0.1:9000
    #
    location ~ \.php$ {
        #rootをphp-fpmのroot
        root           /var/www/html/public; ★ 
        fastcgi_pass   php-fpm-server:9000;　★
        fastcgi_index  index.php;
        # $document_root を追加しています
        fastcgi_param  SCRIPT_FILENAME  $document_root$fastcgi_script_name;
        include        fastcgi_params;
    }
}
```

php-fpmイメージ  
dockerfile の例 (`php:8.1.1-fpm` を利用)
```
FROM php:8.1.1-fpm

# 拡張 phpなど
RUN apt update && apt install -y zlib1g-dev g++ libicu-dev zip libzip-dev zip libpq-dev \
    && docker-php-ext-install intl opcache pdo_mysql \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# laravel アプリのソースをコンテナイメージにコピー
# .envに秘匿情報がはいっている場合は .dockerignore で除外します。
COPY my-laravel-basic/ /var/www/html/
RUN composer install
```

## アプリケーション概要

アプリケーションはRedisとMySQLにアクセスする単純なアプリを作成しました。


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

