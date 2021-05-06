#!/bin/bash
set -e

cd /apps/appOne && composer install
cd /apps/appTwo && composer install
cd /apps/appThree && composer install

cd /apps/appOne && vendor/bin/phinx migrate -e development
cd /apps/appTwo && vendor/bin/phinx migrate -e development
cd /apps/appThree && vendor/bin/phinx migrate -e development

exec /usr/local/sbin/php-fpm