#!/bin/bash
set -e

php artisan test
/home/wwwroot/filapress-core/vendor/bin/pint
/home/wwwroot/filapress-core/vendor/bin/phpstan analyse
