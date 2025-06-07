#!/bin/bash
set -e

cd /home/wwwroot/filapress
APP_ENV=core-testing ./vendor/bin/pest ../filapress-core/tests/Feature
