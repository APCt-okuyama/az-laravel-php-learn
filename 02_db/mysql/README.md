# Azure Database Server for mysql

サーバーの作成
```
az mysql server create --resource-group $RG_NAME \
--name example-mysql-server --location $LOCATION \
--sku-name GP_Gen5_2 \
--admin-user <USERNAME> --admin-password <PASSWORD>
```
sku = GP_Gen5_2 (192.17USD/月)


ローカルからの接続許可 (必要であれば)
```
az mysql server firewall-rule create --resource-group $RG_NAME \
--server example-mysql-server \
--name AllowMyIP \
--start-ip-address 192.168.198.75 \
--end-ip-address 192.168.198.75
```

DBの作成 (適当に3つくらい作成)
```
az mysql db create --resource-group $RG_NAME --server-name example-mysql-server --name sampledb1
az mysql db create --resource-group $RG_NAME --server-name example-mysql-server --name sampledb2
az mysql db create --resource-group $RG_NAME --server-name example-mysql-server --name sampledb3
```

# mysql

接続
```
mysql -h example-mysql-server.mysql.database.azure.com -u myadmin@example-mysql-server -p
mysql> 
```

dbの一覧
```
show databases;
```

dbの作成
```
create database exampledb1;
```

dbの切り替え
```
use exampledb1;
```

現在のdbの確認
```
select database();
```

table
```
create table user (
id int auto_increment not null primary key,
name varchar(256) not null 
);
desc user;

show tables;
show full tables;

insert into user (name) values ("aaa");
insert into user (name) values ("bbb");
insert into user (name) values ("ccc");
```

コンソール画面のクリア
```
system clear
```

ユーザーの作成と権限付与 (アプリ用のユーザーなど必要に応じて作成, 権限も必要なモノを与える)
```
create user 'apcuser1' identified BY 'password';
grant all privileges on sampledb.* to apcuser1;
flush privileges;

(例 apcuser2 に sampledb の参照(SELECT)権限のみを与える)
create user 'apcuser2' identified by 'password';
grant SELECT on sampledb.* to apcuser2;
flush privileges;
```

終了
```
exit
```

# (備考) 利用する観点でのoracle, postgresとの違い
基本的に利用する Table, View, Trigger, Index 基本的な機能はほぼ同じと思ってよい。
Materialized View をサポートしていないので、利用したい場合は tirggerを利用して疑似的に作成する必要がある。

参考サイト (比較しているブログは多数ある)
[db-engines ranking](https://db-engines.com/en/ranking)

[db-engines azureでの比較](https://db-engines.com/en/system/Microsoft+Azure+SQL+Database%3BMySQL%3BPostgreSQL)

[ibm blog](https://www.ibm.com/cloud/blog/postgresql-vs-mysql-whats-the-difference)
