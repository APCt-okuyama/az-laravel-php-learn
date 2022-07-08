# Laravel Framework (8.83.18)

Laravelをつかってみる

(link)[https://biz.addisteria.com/category/laravel/]


## 検証環境 (wsl ubuntu 20.04.4 LTS)

```
$ cat /etc/os-release 
NAME="Ubuntu"
VERSION="20.04.4 LTS (Focal Fossa)"

$ php -v
PHP 7.4.3 (cli) (built: Jun 13 2022 13:43:30) ( NTS )

$ composer -V
Composer version 2.3.9 2022-07-05 16:52:11
```
ComposerとはLaravelのライブラリ管理ツール (mavenやnpmのようなもの)

## install laravel

composerでlaravelの新規プロジェクトの作成
```
composer create-project --prefer-dist laravel/laravel my-first-laravel
cd my-first-laravel
```

バージョンの確認
```
php artisan --version
Laravel Framework 8.83.18
```
artisanとは Laravelのルーツ、Laravelのバージョン確認やコントローラー、モデル、マイグレーションの作成などなどをおこなう。

実行
```
php artisan serve
```
http://127.0.0.1:8000/ にアクセスできる。

## dbマイグレーション

db(sampledb)を作成しておく
```
mysql> show databases;
+--------------------+
| Database           |
+--------------------+
| information_schema |
| defaultdb          |
| mysql              |
| performance_schema |
| sampledb           |
| sampledb1          |
| sampledb2          |
| sys                |
+--------------------+
8 rows in set (0.01 sec)
```

```
        'mysql' => [
            'driver' => 'mysql',
            'url' => env('DATABASE_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                //
                // ★ Azure Database for MySQL に接続するために以下を変更 ★
                //
                //PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
                PDO::MYSQL_ATTR_SSL_KEY    => '/ssl/BaltimoreCyberTrustRoot.crt.pem',                
            ]) : [],
        ],
```
.env
```
DB_CONNECTION=mysql
DB_HOST=example-mysql-server.mysql.database.azure.com
DB_PORT=3306
DB_DATABASE=sampledb
DB_USERNAME=apcuser1@example-mysql-server
DB_PASSWORD=password
```
マイグレーション実行
```
php artisan migrate
```

確認
```
mysql> show tables;
+------------------------+
| Tables_in_sampledb     |
+------------------------+
| failed_jobs            |
| migrations             |
| password_resets        |
| personal_access_tokens |
| users                  |
+------------------------+
5 rows in set (0.04 sec)
```
## CSS Tailwind/Bootstrap 
ログイン画面にCSSを適応

※ node が必要
```
node -v
v14.18.1
```

この２つを試す
| --- | css |
| --- | --- |
| Laravel Breeze | Tailwind |
| Laravel/ui | Bootstrap |

```
composer require laravel/breeze --dev
php artisan breeze:install
npm install
npm run
```

```
composer require laravel/ui
php artisan ui bootstrap --auth
npm install
npm run
```

vue,reactも追加できる（ちょっとよくわからない？）
```
php artisan ui vue
php artisan ui react
```

# まとめ
フルスタックすぎてはじめるまでに時間がかかる。
XAMPとか必要かのか不明。。。
(他のフレームワークも同様だけど。)
js,cssの知識も必要※都度しらべる必要がある。


