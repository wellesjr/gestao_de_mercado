# Build React app
FROM node:21-alpine as react

WORKDIR /app
COPY frontend/package*.json ./
RUN npm install

COPY frontend/ .
ENV NODE_OPTIONS=--openssl-legacy-provider
RUN npm run build

CMD ["npm", "start"]

# Setup PHP Backend
FROM php:8.2-fpm-alpine as php

RUN apk add --no-cache $PHPIZE_DEPS postgresql-dev libpng-dev oniguruma-dev autoconf g++ make
RUN docker-php-ext-install pdo pdo_pgsql mbstring gd 

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Configurações do Xdebug
RUN echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log=/var/www/html/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN apk del --purge postgresql-dev libpng-dev oniguruma-dev

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY backend/ /var/www/html/
RUN composer install --no-dev --optimize-autoloader --no-cache --verbose
RUN composer require vlucas/phpdotenv
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html

# Setup Nginx
FROM nginx:alpine as nginx

RUN rm /etc/nginx/conf.d/default.conf
COPY nginx/conf.d/default.conf /etc/nginx/conf.d/

COPY --from=react /app/build /usr/share/nginx/html
COPY --from=php /var/www/html /var/www/html

RUN ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

EXPOSE 80 3000 9000

CMD ["nginx", "-g", "daemon off;"]
