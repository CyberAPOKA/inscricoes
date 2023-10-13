#!/bin/bash

docker exec $(docker ps -q) chown -R www-data:www-data /var/www/storage
