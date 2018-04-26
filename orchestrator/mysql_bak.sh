#!/bin/sh
USERNAME="jnisbet"
PASSWORD="Jonathan723"
RHOST="192.168.43.25"
LHOST="192.168.43.17"
mysqldump -u$USERNAME -p$PASSWORD -h$RHOST -f accounts > accounts.sql
mysqldump -u$USERNAME -p$PASSWORD -h$RHOST -f userdata > userdata.sql
mysql -u$USERNAME -p$PASSWORD -h$LHOST -f accounts < accounts.sql
mysql -u$USERNAME -p$PASSWORD -h$LHOST -f userdata < userdata.sql
