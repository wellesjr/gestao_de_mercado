# Build React app
FROM node:21 as react

WORKDIR /usr/src/app
COPY frontend/package*.json ./
RUN npm install
COPY frontend/ .
RUN npm run build 

CMD ["npm", "start"]

# Setup PHP Backend
FROM php:8.2-fpm as php

ARG user=appuser
ARG uid=1000

RUN apt-get update && apt-get install -y \
        libpq-dev \
        libpng-dev \
        libonig-dev \
        $PHPIZE_DEPS \
        && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install pdo pdo_pgsql mbstring gd
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

RUN { \
        echo "zend_extension=xdebug.so"; \
        echo "xdebug.mode=debug"; \
        echo "xdebug.start_with_request=yes"; \
        echo "xdebug.client_host=host.docker.internal"; \
        echo "xdebug.client_port=9003"; \
        echo "xdebug.log=/var/www/backend/xdebug.log"; \
        echo "xdebug.idekey=VSCODE"; \
    } > /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apt-get purge -y $PHPIZE_DEPS && apt-get autoremove -y

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/backend
COPY backend/ /var/www/backend/
RUN composer install --no-dev --optimize-autoloader --no-cache --verbose
RUN composer require vlucas/phpdotenv

RUN useradd -G www-data,root -u ${uid} -d /home/${user} ${user} \
    && chown -R www-data:www-data /var/www/backend \
    && chmod -R 755 /var/www/backend

# Setup Nginx
FROM nginx:latest as nginx

RUN rm /etc/nginx/conf.d/default.conf

COPY --from=react /usr/src/app/build /usr/share/nginx/html
COPY --from=php /var/www/backend /var/www/backend

RUN ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log
