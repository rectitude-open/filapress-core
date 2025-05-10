#!/bin/bash
set -e

/home/wwwroot/filapress-core/vendor/bin/pest
/home/wwwroot/filapress-core/vendor/bin/pint
/home/wwwroot/filapress-core/vendor/bin/phpstan analyse
