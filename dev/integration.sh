#!/bin/bash
set -e

cd /home/wwwroot/filapress

if [ $# -gt 0 ]; then
  APP_ENV=core-testing ./vendor/bin/pest ../filapress-core/tests/Integration --filter "$*"
else
  APP_ENV=core-testing ./vendor/bin/pest ../filapress-core/tests/Integration
fi
