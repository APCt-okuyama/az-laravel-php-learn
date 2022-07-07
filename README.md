# az-laravel-php-learn

Azure でのphp, laravel についての調査

# Azure env
```
export RG_NAME=az-laravel-example-rg
export LOCATION=japaneast
az group create -n $RG_NAME -l $LOCATION
```

# 使わないリソースは削除!
```
az group delete -n $RG_NAME -y --no-wait
```