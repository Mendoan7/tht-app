#!/bin/bash

#
composer install --optimize-autoloader --no-dev

#install package
npm i
# Build assets using NPM
php artisan storage:link
npm run build

# Clear cache
php artisan optimize:clear

# Cache the various components of the Laravel application
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

# Run any database migrations
php artisan migrate --force

# Check if the environment variable is set to "false" or not set at all
if [[ "${!ENV_VAR_NAME}" = "false" ]] || [[ -z "${!ENV_VAR_NAME}" ]]; then
  echo "Exiting maintenance mode..."
  php artisan up
fi
