#!/bin/sh

STATUS=$(curl -s -I $(docker-machine ip):8080 | head -n 1 | cut -d' ' -f2)
if [[ $STATUS != '200' ]]; then
    echo 'invalid'
    exit 1
fi
