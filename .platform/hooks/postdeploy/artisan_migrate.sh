#!/bin/bash

if [ -f /tmp/leader_only ]; then
  echo "Running migrations"
  docker exec -w /var/www $(docker ps -q) ./artisan migrate --force
  rm /tmp/leader_only
fi
