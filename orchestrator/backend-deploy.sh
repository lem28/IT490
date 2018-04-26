#!/bin/bash
## Dev Server
dev_server=192.168.43.18
dev_user=asohail
dev_pass=asohail20
## QA Server
qa_server=192.168.43.19
qa_user=asohail
qa_pass=asohail20
## Production Server
prod_server=192.168.43.20
prod_user=asohail
prod_pass=asohail20

if [[ "$1" == "prod" ]]; then
    server=$prod_user.$prod_server
elif [[ "$1" == "qa" ]]; then
    server=$qa_user.$qa_server
else
    server=$dev_user.$dev_server
fi

zip -r -j ~/pack/test.zip ~/test
echo "File zipped and moved"

unzip ~/test2/test.zip -d ~/test2

rm -rf ~/test2/test.zip

