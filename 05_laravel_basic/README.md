# Laravel webアプリ開発 (基礎)

このページの `基礎` のところの解説です。
https://readouble.com/laravel/8.x/ja/

画面遷移を含む web ui を作成してみる。

## 基礎
| 用語 | 概要 | 備考 |
| --- | --- | --- |
| ルーティング| | |
| ミドルウェア| | |
| CSRF保護| | |
| コントローラ| | |
| リクエスト| | |
| レスポンス| | |
| ビュー| | |
| Bladeテンプレート | テンプレートエンジン<br>resources/views/xxx.blade.php | | |
| URL生成| | |
| セッション| | |
| バリデーション| | |
| エラー処理| | |
| ログ| | |

## 環境
windows WSL2(Ubuntu) を利用しています。

```
$ cat /etc/os-release 
NAME="Ubuntu"
VERSION="20.04.4 LTS (Focal Fossa)"

$ php -v
PHP 7.4.3 (cli) (built: Jun 13 2022 13:43:30) ( NTS )

$ composer -V
Composer version 2.3.9 2022-07-05 16:52:11
```

## Laravelプロジェクトの作成

作成とバージョン
```
composer create-project --prefer-dist laravel/laravel my-laravel-basic
cd my-laravel-basic
php artisan --version
```

確認
```
tree -L 1
.
├── README.md
├── app
├── artisan
├── bootstrap
├── composer.json
├── composer.lock
├── config
├── database
├── package.json
├── phpunit.xml
├── public
├── resources
├── routes
├── server.php
├── storage
├── tests
├── vendor
└── webpack.mix.js
```

起動
```
php artisan serve
```

## ルーティング
## ミドルウェア 
## CSRF保護
## コントローラ
## リクエスト
## レスポンス
## ビュー
## Bladeテンプレート
## URL生成
## セッション 
## バリデーション
## エラー処理 
## ログ
