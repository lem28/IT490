#!/bin/bash
curr_time=$(date "+%m-%d-%y | %h-%m-%s")
dir_dest_mysql="/home/$mysql_user/"
dir_bak_mysql="bak_mysql/"
mysql_user="jnisbet"
mysql_pass="jonathan723"
mysql_accounts="accounts"
mysql_userdata="userdata"
prod_mysql_master_host="192.168.43.17"
prod_mysql_slave_host="192.168.43.25"
## mysql cmd
find_1="find $dir_base$dir_bak_mysql$mysql_accounts.mysql -type f -mtime +10 -exec rm {} +"
find_2="find $dir_base$dir_bak_mysql$mysql_userdata.mysql -type f -mtime +10 -exec rm {} +"
dump_1="mysqldump -h$prod_mysql_slave_host -u$mysql_user -p$mysql_pass $mysql_accounts > $dir_dest_mysql$dir_bak_mysql$curr_time-$mysql_accounts.mysql"
dump_2="mysqldump -h$prod_mysql_slave_host -u$mysql_user -p$mysql_pass $mysql_userdata > $dir_dest_mysql$dir_bak_mysql$curr_time-$mysql_userdata.mysql"
load_1="mysqldump -h$prod_mysql_master_host -u$mysql_user -p$mysql_pass $mysql_accounts < $dir_dest_mysql$dir_bak_mysql$curr_time-$mysql_accounts.mysql"
load_2="mysqldump -h$prod_mysql_master_host -u$mysql_user -p$mysql_pass $mysql_userdata < $dir_dest_mysql$dir_bak_mysql$curr_time-$mysql_userdata.mysql"
## write out current crontab
crontab -l > mycron
## echo new cron into cron file
echo "30 12 * * * $find_1;$find_2;$dump_1;$dump_2;$load_1;$load_1;" >> mycron
## install new cron file
crontab mycron
## clean up
rm mycron
