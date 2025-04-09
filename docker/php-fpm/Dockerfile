#FROM php:8.0.6-fpm
#FROM php:8.2.11-fpm
FROM php:8.3.8-fpm

RUN mkdir -p /usr/src/php/ext/redis \
    && curl -L https://github.com/phpredis/phpredis/archive/5.3.7.tar.gz | tar xvz -C /usr/src/php/ext/redis --strip 1 \
    && echo 'redis' >> /usr/src/php-available-exts

COPY ./php.ini /usr/local/etc/php

RUN apt-get update && apt-get install -y \
    libmemcached-dev \
    zlib1g-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libxml2-dev \
    libpng-dev \
    libssl-dev \
    zip \
    unzip \
    libzip-dev \
    git \
    curl \
    default-mysql-client \
    librdkafka-dev

RUN pecl install memcached \
    && docker-php-ext-enable memcached \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd \
    && docker-php-ext-install mysqli pdo pdo_mysql zip pcntl redis

RUN pecl install rdkafka \
    && docker-php-ext-enable rdkafka

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer global require "laravel/envoy=~1.0"

COPY . /var/www/app

RUN sed -i -e 's/pm.max_children = 5/pm.max_children=50/g' -e 's/;pm.max_requests = 500/pm.max_requests = 500/g' /usr/local/etc/php-fpm.d/www.conf


RUN usermod -u 1000 www-data
