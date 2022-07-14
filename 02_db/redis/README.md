# redis

インメモリ型の KVS です。インメモリなので高速に動きます。

KVSとしてセッション情報など高頻度にアクセスされる情報の保持によく利用します。
Queue,PubSub機能も備えています。  

Laravelでもsessionの管理やqueueにredisを利用することができるようになっています。


## Azureでは
Azure Cache for Redis として フル マネージドのサービスとして提供されています。

作成
```
# Create a Basic C0 (256 MB) Redis Cache
echo "Creating $cache"
az redis create --name $cache --resource-group $resourceGroup --location "$location" --sku $sku --vm-size $size

# Get details of an Azure Cache for Redis
echo "Showing details of $cache"
az redis show --name $cache --resource-group $resourceGroup 

# Retrieve the hostname and ports for an Azure Redis Cache instance
redis=($(az redis show --name $resourceGroup --resource-group $resourceGroup --query [hostName,enableNonSslPort,port,sslPort] --output tsv))

# Retrieve the keys for an Azure Redis Cache instance
keys=($(az redis list-keys --name contosoCache --resource-group contosoGroup --query [primaryKey,secondaryKey] --output tsv))

# Display the retrieved hostname, keys, and ports
echo "Hostname:" ${redis[0]}
echo "Non SSL Port:" ${redis[2]}
echo "Non SSL Port Enabled:" ${redis[1]}
echo "SSL Port:" ${redis[3]}
echo "Primary Key:" ${keys[0]}
echo "Secondary Key:" ${keys[1]}
```

削除
```
echo "Deleting $cache"
az redis delete --name $resourceGroup --resource-group $resourceGroup -y
```
