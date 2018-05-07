#!/bin/bash
curr_time=$(date "+%m-%d-%y | %h-%m-%s")
## directories
dir_deploy_home="/home/deploy/"
dir_deploy_base="/home/deploy/git/IT490/"
dir_bak_mysql="bak_mysql/"
dir_bak_backend="bak_backend/"
dir_src_backend="/var/www/IT490/"
## credentials
mysql_user="jnisbet"
backend_user="jnisbet"
backend_pass="asohail20"
mysql_pass="Jonathan723"
mysql_accounts="accounts"
mysql_userdata="userdata"
## servers
prod_backend_server="192.168.43.20"
prod_mysql_master_host="192.168.43.17"
prod_mysql_slave_host="192.168.43.25"
## mysql cmd
find_db_1="find $dir_deploy_base$dir_bak_mysql-*-$mysql_accounts.mysql.bak -type f -mtime +10 -exec rm {} +"
find_db_2="find $dir_deploy_base$dir_bak_mysql-*-$mysql_userdata.mysql.bak -type f -mtime +10 -exec rm {} +"
find_db_3="find $dir_deploy_base$dir_bak_mysql-*-$mysql_forum.mysql.bak -type f -mtime +10 -exec rm {} +"
find_backend="find $dir_deploy_base$dir_bak_backend-*-$backend.tar.gz -type f -mtime +10 -exec rm {} +"
bak_db_1="mysqldump -h$prod_mysql_slave_host -u$mysql_user -p$mysql_pass $mysql_accounts > ${dir_dest_mysql}${dir_bak_mysql}-$curr_time-$mysql_accounts.mysql.bak"
bak_db_2="mysqldump -h$prod_mysql_slave_host -u$mysql_user -p$mysql_pass $mysql_userdata > ${dir_dest_mysql}${dir_bak_mysql}-$curr_time-$mysql_userdata.mysql.bak"
bak_db_3="mysqldump -h$prod_mysql_slave_host -u$mysql_user -p$mysql_pass $mysql_userdata > ${dir_dest_mysql}${dir_bak_mysql}-$curr_time-$mysql_forum.mysql.bak"
bak_backend="sshpass -p$backend_pass ssh -o StrictHostKeyChecking=no ${backend_user}@${backend_server} 'tar czpf - $dir_src_backend' > ${dir_deploy_base}${dir_bak_backend}-$curr_time-backend.tar.gz"
## echo into full_bak.sh
echo "$find_db_1;$find_db_2;$find_db_3;$find_backend;$bak_db_1;$find$bak_db_2;$bak_db_3;$bak_backend" > ${dir_deploy_base}full_bak.sh
## write out current crontab
crontab -l > mycron
## echo new cron into cron file
echo "* * * * * \" /bin/bash ${dir_deploy_base}full_bak.sh\"" >> mycron
## install new cron file
crontab mycron
## clean up
rm mycron
