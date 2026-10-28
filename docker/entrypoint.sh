#!/bin/sh
set -e

# Configuration comes from the container's environment, so it is cached at
# startup rather than at build time.
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"
