#!/bin/bash

if grep -q CRON_ENABLED=1 /opt/elasticbeanstalk/deployment/env.list; then
  echo "Installing crontab"
  mkdir -p /var/log/app-cron
  crontab /tmp/crontab -u root
else
  echo "Making sure that the crontab is empty"
  crontab -r -u root || true
fi
