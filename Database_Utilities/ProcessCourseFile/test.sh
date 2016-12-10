#!/bin/bash
#Author: William Gillespie
# example run ./test.sh out5.txt
input = "$1"
counter = 0
limit = 5
read -r firstline < "$1"
while IFS=';' read -r CRN title courseNO coursePrefix timeEnd timeStart capacity actual credits hours
do
    printf 'CRN: %s, Title: %s\n' "$CRN" "$title"
done < $(tail -n +2 <"$1")
