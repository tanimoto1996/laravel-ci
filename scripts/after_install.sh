#!/bin/bash

set -eux

cd ~/study
php artisan migrate --force
php artisan config:cache
