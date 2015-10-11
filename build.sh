#!/bin/bash

git pull
composer update
npm install
bower update
gulp
composer dumpautoload
php artisan migrate