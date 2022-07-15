# LaravelアプリをAzureへのデプロイ

コンテナとしていろいろな場所へデプロイしてみる。

Azure Virtual Machine
Azure App Service
Azure Kubernetes Service
Azure Container Instance

## アプリの概要
簡単なWEBアプリ

## いろいろな場所へデプロイしてみる

![image](./workingOnAzure.png)

### 1. Azure Virtual Machine
※手順は省略

### 2. Azure App Service
※手順は省略

### 3. Azure Kubernetes Service
※手順は省略

### 4. Azure Container Instance

ACRアクセス用のサービスプリンシパルを作成して Container Instance を作成します。

以下手順
```
export AKV_NAME=my-example-laravel-key
az keyvault create -g $RG_NAME -n $AKV_NAME

サービスプリンシパルの作成
ACR_NAME=acr001example
# Create service principal
az ad sp create-for-rbac \
  --name http://$ACR_NAME-pull \
  --scopes $(az acr show --name $ACR_NAME --query id --output tsv) \
  --role acrpull

SP_ID=d8df7acd-4486-4fd4-8512-3c808ef2500c # Replace with your service principal's appId

# Store the registry *password* in the vault
az keyvault secret set \
  --vault-name $AKV_NAME \
  --name $ACR_NAME-pull-pwd \
  --value "q7n8Q~0yH29rZJWtV-4ehXYCQKJ~d_D0enrq2dxY"
  
# Store service principal ID in vault (the registry *username*)
az keyvault secret set \
    --vault-name $AKV_NAME \
    --name $ACR_NAME-pull-usr \
    --value $(az ad sp show --id $SP_ID --query appId --output tsv)

{
  "appId": "d8df7acd-4486-4fd4-8512-3c808ef2500c",
  "displayName": "http://acr001example-pull",
  "password": "q7n8Q~0yH29rZJWtV-4ehXYCQKJ~d_D0enrq2dxY",
  "tenant": "4029eb38-8689-465c-92e1-9464066c814c"
}

az container create \
--resource-group $RG_NAME \
--name my-example-container \
--image acr001example.azurecr.io/my-laravel-apache-app \
--dns-name-label my-laravel-apache-app \
--ports 80

ACR_LOGIN_SERVER=$(az acr show --name $ACR_NAME --resource-group b-team-acr --query "loginServer" --output tsv)

az container create \
    --name my-example-aci-demo \
    --resource-group $RG_NAME \
    --image acr001example.azurecr.io/my-laravel-apache-app:v1 \
    --registry-login-server acr001example.azurecr.io \
    --registry-username $(az keyvault secret show --vault-name $AKV_NAME -n $ACR_NAME-pull-usr --query value -o tsv) \
    --registry-password $(az keyvault secret show --vault-name $AKV_NAME -n $ACR_NAME-pull-pwd --query value -o tsv) \
    --dns-name-label my-example-aci-demo \
    --query ipAddress.fqdn
```
#### 確認
```
curl http://my-example-aci-demo.japaneast.azurecontainer.io
:
    <p>これはテスト用のページです。</p>
:
```
5. Azure Container Apps

ACRアクセス用のサービスプリンシパルを利用して Container Instance を作成します。

拡張機能が必要
```
az extension add --name containerapp --upgrade

RESOURCE_GROUP=az-laravel-example-rg
LOCATION=japaneast
CONTAINERAPPS_ENVIRONMENT="my-example-environment"

az containerapp env create \
  --name $CONTAINERAPPS_ENVIRONMENT \
  --resource-group $RESOURCE_GROUP \
  --location $LOCATION

az acr login --name 

CONTAINER_IMAGE_NAME=acr001example.azurecr.io/my-laravel-apache-app:v1
REGISTRY_SERVER=acr001example.azurecr.io
REGISTRY_USERNAME=d8df7acd-4486-4fd4-8512-3c808ef2500c
REGISTRY_PASSWORD=q7n8Q~0yH29rZJWtV-4ehXYCQKJ~d_D0enrq2dxY

az containerapp create \
  --name my-container-app \
  --resource-group $RESOURCE_GROUP \
  --image $CONTAINER_IMAGE_NAME \
  --environment $CONTAINERAPPS_ENVIRONMENT \
  --registry-server $REGISTRY_SERVER \
  --registry-username $REGISTRY_USERNAME \
  --registry-password $REGISTRY_PASSWORD
```

#### 確認
```
curl https://my-container-app.agreeablepond-0d5a3947.japaneast.azurecontainerapps.io/api/myapi2
{"message":"myapi2 is working."}
```

6. Gateway