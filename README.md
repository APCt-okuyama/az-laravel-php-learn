# az-laravel-php-learn

Laravel (PHP)の基本的な利用方法とAzureで利用するときのトピックを纏めておきます。

![image](./new-php-logo.png)
![image](./laravel.png)

# Laravelに関する情報
ネット上に膨大な情報がありますが、基本的には公式のページを参照する。
https://readouble.com/laravel/
日本語でのドキュメントもしっかりと整備されている。

# Azure env
```
export RG_NAME=az-laravel-example-rg
export LOCATION=japaneast
az group create -n $RG_NAME -l $LOCATION
```

## 使わないリソースは削除しましょう
```
echo $RG_NAME
az group delete -n $RG_NAME -y
```