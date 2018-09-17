FROM php:7.2.0-fpm

MAINTAINER Alejandro Abraham <alejandro_abraham@me.com>

RUN apt-get update
RUN apt-get install -y \
            ssl-cert \
            autoconf \
            pkg-config \
            libssl-dev \
            libfreetype6-dev \
            libjpeg62-turbo-dev \
            libmcrypt-dev

RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN pecl install mongodb

RUN docker-php-ext-install bcmath
RUN docker-php-ext-install pcntl 
RUN docker-php-ext-install mbstring
RUN docker-php-ext-install zip 
RUN docker-php-ext-install gd

RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer \
   && composer global require "hirak/prestissimo:^0.3"

RUN rm -rf /var/lib/apt/lists/*
