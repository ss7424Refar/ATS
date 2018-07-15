#!/bin/bash
#for ((COUNT = 1; COUNT <= 10; COUNT++)); do
 # echo $COUNT
 # sleep 1
#done

#tail -f log.txt

for COUNT in $(seq 1 10); do
  echo $COUNT
  sleep 1
done