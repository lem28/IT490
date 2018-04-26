#!/bin/bash

zip -r -j ~/test2/test.zip ~/test
echo "File zipped and moved"

unzip ~/test2/test.zip -d ~/test2

rm -rf ~/test2/test.zip
