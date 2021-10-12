FROM php:7.4-fpm

COPY composer.lock composer.json /var/www/


COPY database /var/www/database


WORKDIR /var/www


RUN apt-get update && apt-get -y install git && apt-get -y install zip


RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"\
&& php -r  "if (hash_file('sha384', 'composer-setup.php') === '906a84df04cea2aa72f40b5f787e49f22d4c2f19492ac310e8cba5b96ac8b64115ac402c8cd292b8a03482574915d1a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"\
&& php composer-setup.php \
&& php -r "unlink('composer-setup.php');" \
&& mv /var/www/composer.phar /usr/local/bin/composer  \
&& composer install --no-dev --no-scripts

COPY . /var/www


RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

RUN php artisan cache:clear

#dependescias de php 
RUN  apt-get install -y libmcrypt-dev  libmagickwand-dev --no-install-recommends \
&& pecl install mcrypt-1.0.4 \
&& docker-php-ext-install mysqli pdo pdo_mysql \
&& docker-php-ext-enable mcrypt 

RUN mv .env.dev .env
RUN php artisan storage:link 
#php comandos de laravel php
