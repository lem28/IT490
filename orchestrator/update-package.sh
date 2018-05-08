#!/bin/bash
## credentials
backend_user="jnisbet"
backend_pass="asohail20"
mysql_user="jnisbet"
mysql_pass="Jonathan723"
mysql_accounts="accounts"
mysql_userdata="userdata"
rmq_user="ubuntu"
rmq_pass="ubuntu64"
## directories
dir_deploy_home="/home/deploy/"
dir_deploy_base="/home/deploy/git/IT490/"
## src / backup
dir_bak_mysql="bak_mysql/"
dir_bak_backend="bak_backend/"
dir_dest_backend="/var/www/"
dir_dest_mysql="/home/$mysql_user/mysql/"
## dev cluster
dev_backend="192.168.43.18"
dev_mysql="192.168.43.15"
dev_rmq="192.168.43.12"
## qa cluster
qa_backend="192.168.43.19"
qa_mysql="192.168.43.16"
qa_rmq="192.168.43.13"
## production cluster
prod_backend="192.168.43.20"
prod_mysql_master_host="192.168.43.17"
prod_mysql_slave_host="192.168.43.25"
prod_rmq="192.168.43.14"
## assign servers with user input
if [[ "$1" == "prod" ]]; then
	backend_server=$backend_user@$prod_backend
	mysql_server=$mysql_user@$prod_mysql
	rmq_server=$rmq_user@$prod_rmq
elif [[ "$1" == "qa" ]]; then
	backend_server=$backend_user@$qa_backend
	mysql_server=$mysql_user@$qa_mysql
	rmq_server=$rmq_user@$qa_rmq
elif [[ "$1" == "dev" ]]; then
	backend_server=$baacckend_user@$dev_backend
	mysql_server=$mysql_user@$dev_mysql
	rmq_server=$rmq_user@$dev_rmq
else
	echo "Please input a cluster. Available clusters: prod (Production), qa (Quality Assurance) or dev (Development)."
	exit 0
fi

if [[ "$2" == "good" || "$2" == "bad" || "$2" == "WIP" ]]; then
	version=$(mysql -uroot -pubuntu64 -s -N -e "use packages;select curr_ver from cluster_info where cluster_id = '$1';")
	mysql -uroot -pubuntu64 -s -N -e "use packages;update versions set status = '$2' where vid = $version;"
	echo "Updating status of package version $version"
else
	echo "Please input a valid status. Available status: good, bad or WIP."
	exit 0
fi
