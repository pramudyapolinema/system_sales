#!/bin/bash

docker exec -it system_sales bash -c "chmod -R 777 /var/www/html/storage/; \
composer install; \
php artisan key:generate; \
php artisan migrate; \
php artisan laravolt:indonesia:seed; \
php artisan db:seed --class=AdminSeeder"
