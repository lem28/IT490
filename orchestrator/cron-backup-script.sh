#!/bin/bash
## some initial vars
current_time=$(date "+%m.%d.%Y-%H.%M.%S")
DBBAKDIR="./db_backups/"
BACKENDBAKDIR="./backend_backups/"
MASTERHOST="192.168.43.17"
SLAVEHOST="192.168.43.25"
DBUSERNAME="jnisbet"
DBPASSWORD="Jonathan723"
DBACCOUNTS="accounts"
DBUSERDATA="userdata"
## 
echo "Current Time : $current_time"
mysqldump -u$USERNAME -p$PASSWORD -h$RHOST -f accounts > $DBBAKDIR.$current_time.accounts.sql
mysqldump -u$USERNAME -p$PASSWORD -h$RHOST -f userdata > $DBBAKDIR.$current_time.userdata.sql
mysql -u$USERNAME -p$PASSWORD -h$LHOST -f accounts < $DBBAKDIR.$current_time.accounts.sql
mysql -u$USERNAME -p$PASSWORD -h$LHOST -f userdata < $DBBAKDIR.$current_time.userdata.sql
## mysql cmd
mysql1="mysqldump -h$dbHost -u$dbUser -p$dbPassword $dbAccounts > $baseDir$(date +%F)_full_$dbAccounts.sql"
mysql2="find $baseDir/$dbAccounts -type f -mtime +7 -exec rm {} +"
mysql3="mysqldump -h$dbHost -u$dbUser -p$dbPassword $dbUserdata > $baseDir$(date +%F)_full_$dbUserdata.sql"
mysql4="find $baseDir/$dbUserdata -type f -mtime +7 -exec rm {} +"
## write out current crontab
crontab -l > mycron
## echo new cron into cron file
echo "30 04 * * * $mysql1;$mysql2;$mysql3;$mysql4;" >> mycron
## install new cron file
crontab mycron
## clean up
rm mycron
