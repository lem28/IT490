#!/bin/bash
curr_time=$(date "+%m-%d-%y|%h-%m-%s")
git_src="https://github.com/JonathanNisbet/IT490.git"
## credentials
backend_user="asohail"
backend_pass="asohail20"
db_user="jnisbet"
db_pass="jonathan723"
db_accounts="accounts"
db_userdata="userdata"
rmq_user="ubuntu"
rmq_pass="ubuntu64"
## initial directories
dir_base="/home/deploy/orchestrator/"
dir_bak_db="bak_db/"
dir_bak_backend="bak_backend/"
dir_src_backend="backend/"
dir_src_sql="sql/"
dir_src_rmq="rmq/"
dir_dest_backend="/var/www/"
dir_dest_sql="/home/$db_user/"
## dev cluster
dev_backend="192.168.43.18"
dev_db="192.168.43.15"
dev_rmq="192.168.43.12"
## qa cluster
qa_backend="192.168.43.19"
qa_db="192.168.43.16"
qa_rmq="192.168.43.13"
## production cluster
prod_backend="192.168.43.20"
prod_db_master_host="192.168.43.17"
prod_db_slave_host="192.168.43.25"
prod_rmq="192.168.43.14"
## assign servers with user input
if [[ "$1" == "prod" || "$1" == "production" ]]; then
	backend_server=$backend_user@$prod_backend
	db_server=$db_user@$prod_db
	rmq_server=$rmq_user@$prod_rmq
elif [[ "$1" == "qa" || "$1" == "staging" ]]; then
	backend_server=$backend_user@$qa_backend
	db_server=$db_user@$qa_db
	rmq_server=$rmq_user@$qa_rmq
else
	backend_server=$backend_user@$dev_backend
	db_server=$db_user@$dev_db
	rmq_server=$rmq_user@$dev_rmq
fi
## commence jiggling
## scp-ing shit
sshpass -p "$backend_pass" scp -r $src_backend_dir $backend_server:$dest_backend_dir
sshpass -p "$db_pass" scp -r $src_backend_dir $backend_server:$dest_backend_dir
sshpass -p "$rmq_pass" scp -r $src_backend_dir $backend_server:$dest_backend_dir
## mysql cmd
find_1="find $dir_base$dir_bak_db$db_accounts.sql -type f -mtime +10 -exec rm {} +"
find_2="find $dir_base$dir_bak_db$db_userdata.sql -type f -mtime +10 -exec rm {} +"
dump_1="mysqldump -h$prod_db_slave_host -u$db_user -p$db_pass $db_accounts > $dir_base$dir_bak_db$curr_time-$db_accounts.sql"
dump_2="mysqldump -h$prod_db_slave_host -u$db_user -p$db_pass $db_userdata > $dir_base$dir_bak_db$curr_time-$db_userdata.sql"
load_1="mysqldump -h$prod_db_master_host -u$db_user -p$db_pass $db_accounts < $dir_base$dir_bak_db$curr_time-$db_accounts.sql"
load_2="mysqldump -h$prod_db_master_host -u$db_user -p$db_pass $db_userdata < $dir_base$dir_bak_db$curr_time-$db_userdata.sql"
## write out current crontab
crontab -l > mycron
## echo new cron into cron file
echo "30 12 * * * $find_1;$find_2;$dump_1;$dump_2;$load_1;$load_1;" >> mycron
## install new cron file
crontab mycron
## clean up
rm mycron

