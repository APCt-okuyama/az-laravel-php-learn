# az-laravel-php-learn

Laravel (PHP)の基本的な利用方法とAzureで利用するときのトピックを纏めておきます。

![image](./new-php-logo.png)

# Azure env
```
export RG_NAME=az-laravel-example-rg
export LOCATION=japaneast
az group create -n $RG_NAME -l $LOCATION
```

## 使わないリソースは削除しましょう
```
az group delete -n $RG_NAME -y
```