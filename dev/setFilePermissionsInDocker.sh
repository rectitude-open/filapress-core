#!/bin/sh
set -e
cd /home/wwwroot/filapress-core || exit
chown -R www-data:www-data /home/wwwroot/filapress-core && \
find /home/wwwroot/filapress-core -type f -exec chmod 644 {} \; && \
find /home/wwwroot/filapress-core -type d -exec chmod 755 {} \; && \
chmod -R +x /home/wwwroot/filapress-core/vendor/bin/ && \
chmod -R +x /home/wwwroot/filapress-core/dev/
