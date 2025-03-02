#!/bin/bash

cd /home/php/app

if [ $# -eq 0 ]; then
    echo "Running default setup: composer install and serve"
    composer install --no-interaction
    exec php artisan serve --host=0.0.0.0 --port=8080
else
    echo "Executing command: $@"
    exec "$@"
fi