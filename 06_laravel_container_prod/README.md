# 本番環境向けのコンテナイメージについて

`php artisan serve`コマンド(PHPの Built-in web server) はあくまで開発環境向け。
本番環境には `nginx` や `Apache` などを利用する。

(余談) Built-in サーバーの起動は以下のコマンド
```
cd public
php -S localhost:8000
```
## サーバ要件
https://readouble.com/laravel/8.x/ja/deployment.html

