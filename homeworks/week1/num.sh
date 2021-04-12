#!/bin/sh

i=0

while [[ "$i" -lt "$1" ]]
do
  touch "${i}.js"
  i=`expr $i + 1`
done

echo "檔案建立完成"
