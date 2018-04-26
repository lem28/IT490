#!/bin/bash
#some initial vars
$baseDir="/home/deploy/dbBackup/"
$dbUser="usr"
$dbPassword="password"
$dbAccounts="accounts"
$dbUserdata="userdata"
$dbHost="192.168.43.15"
#mysql cmd
mysql1="mysqldump -h$dbHost -u$dbUser -p$dbPassword $dbAccounts > $baseDir$(date +%F)_full_$dbAccounts.sql"
mysql2="find $baseDir/$dbAccounts -type f -mtime +7 -exec rm {} +"
mysql3="mysqldump -h$dbHost -u$dbUser -p$dbPassword $dbUserdata > $baseDir$(date +%F)_full_$dbUserdata.sql"
mysql4="find $baseDir/$dbUserdata -type f -mtime +7 -exec rm {} +"
#write out current crontab
crontab -l > mycron
#echo new cron into cron file
echo "30 04 * * * $mysql1;$mysql2;$mysql3;$mysql4;" >> mycron
#install new cron file
crontab mycron
rm mycron
