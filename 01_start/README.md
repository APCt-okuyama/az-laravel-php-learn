# PHP Laravel の基礎を抑えておく

とりあえずPHPを動かしてみる

```
チュートリアル:Azure App Service で PHP および MySQL アプリを構築する
https://docs.microsoft.com/ja-jp/azure/app-service/tutorial-php-mysql-app?pivots=platform-linux
```
このチュートリアルを進めてみる。

## Git をインストールする
## PHP 7.4 をインストールする 
```
sudo apt update
sudo apt install -y php
php -v
PHP 7.4.3 (cli) (built: Jun 13 2022 13:43:30) ( NTS )
```
## Composer をインストールする
```
composer -V
Composer version 2.3.9 2022-07-05 16:52:11
```
## ローカル環境 に MySQL をインストールする
```
sudo apt update
sudo apt install mysql-server
```

secureの設定を適当に。
```
sudo mysql_secure_installation
Mynewpassword@12345
```
※ Failed! Error: SET PASSWORD has no significance for user 'root'@'localhost' となったのでsqlで変更(?)する
```
sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password by 'mynewpassword';
```

※やはり自分でインストールするのは面倒。。。

### Azure Database for MySQL サーバーを利用する
https://docs.microsoft.com/ja-jp/azure/mysql/single-server/quickstart-create-mysql-server-database-using-azure-cli

サーバーの作成
```
az mysql server create --resource-group $RG_NAME --name my-example-dbserver --location $LOCATION --admin-user myadmin --admin-password password@123 --sku-name GP_Gen5_2
```

DBの作成
```
az mysql db create --resource-group $RG_NAME --server-name my-example-dbserver --name sampledb
```
ファイアウォールの設定（option）
```
az mysql server firewall-rule create --resource-group myresourcegroup --server mydemoserver --name AllowMyIP --start-ip-address 192.168.0.1 --end-ip-address 192.168.0.1
```

```
az mysql server show --resource-group $RG_NAME --name my-example-dbserver
```

mysql コマンド
```
mysql -h my-example-dbserver.mysql.database.azure.com -u myadmin@my-example-dbserver -p
```


# サンプルのlaravel-tasksについて

composer install で以下の２つが不足していたので追加
```
sudo apt-get install php7.4-dom
sudo apt-get install php-curl
```

mysqlのドライバが必要
```
sudo apt-get install php-common php-mysql php-cli
```

インストールされているモジュールの一覧
```
php -m
```

phpのコマンド多数あるので覚える
```
php -r "echo phpinfo();" | grep "php.ini"
php --ini
```

ローカルでのサンプル(laravel-tasks)の実行
```
php artisan migrate (db作成)
php artisan key:generate (Laravel アプリケーション キーを生成)
php artisan serve (アプリケーションを実行)
```
ブラウザーで http://localhost:8000 にアクセスして確認できる。

## artisanって？
Laravelの管理ツールです。プロジェクトを作成したり、プロジェクトに関数を追加したりします。
cacheのクリアもこのツールを利用します。


# App Service にデプロイ へ デプロイ

(重要) App Service の既定の PHP Docker イメージでは Apache が使用される。

## App Serviceを作成
デプロイ（リソースグループの作成、AppServiceプランの作成、アプリの作成が行われる）
```
az webapp up --resource-group $RG_NAME --name my-example-laravel-app --location $LOCATION --sku P1V2 --runtime "php|7.4" --os-type=linux
```
sku=B1(13.87USD/月)
sku=P1V2 (89.79USD/月)

Laravel アプリケーション キーを生成
```
php artisan key:generate --show
```

"Laravel\SerializableClosure\Exceptions\InvalidSignatureException"
高度なツールからキャッシュをクリアしてみる
```
php artisan route:clear
```


App Serviceの設定変更
```
az webapp config appsettings set \
-n my-example-laravel-app \
-g $RG_NAME \
--settings APP_KEY="base64:md09yEhsxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx" APP_DEBUG="true"
```
※ APP_DEBUG="true" 運用環境ではfalseが推奨

# Service Connector
これは必要なのか不明？

```
az webapp connection create mysql --resource-group $RG_NAME --name my-example-laravel-app --target-resource-group $RG_NAME --server my-example-dbserver --database sampledb --connection my_laravel_db
```

ブラウザでアクセスして確認できる
```
https://my-example-laravel-app.azurewebsites.net
```

# まとめ・その他

とりあえず、LaravelのアプリをAppServiceにデプロイして動作することは確認できた。App ServiceにはPHPとしてデプロイ

AppServicePHP
 PHP8を利用する場合はLinux OSを選択する必要がある。
 windowsの場合は PHP7までしかサポートしない。


# php コマンド
php artisan

## composer
PHP 5.3.2以上
PHPのパッケージ管理ツール　
設定ファイルは `composer.json` `composer.lock`
カレントディレクトリ直下の、vendor というディレクトリ
```
composer init
composer install
composer update
```

