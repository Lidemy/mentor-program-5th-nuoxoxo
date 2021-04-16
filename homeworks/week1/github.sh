#!/bin/bash

curl -s "https://api.github.com/users/$1" \
| grep -e blog -e '\"name' -e bio -e location \
| awk -F ': ' '{ print $2 }' \
| sed 's/"//;s/"//;s/,$//g' \
| sort