# Azure Database Server for mysql

サーバーの作成
```
az mysql server create --resource-group $RG_NAME --name my-example-dbserver --location $LOCATION --admin-user myadmin --admin-password password@123 --sku-name GP_Gen5_2
```

DBの作成
```
az mysql db create --resource-group $RG_NAME --server-name my-example-dbserver --name sampledb
```

# mysql

接続
```
mysql -h my-example-dbserver.mysql.database.azure.com -u myadmin@my-example-dbserver -p
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

終了
```
quit
```
```
exit
```