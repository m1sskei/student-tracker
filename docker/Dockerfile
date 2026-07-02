# Gamitin ang PHP 8.2 base image
FROM php:8.2-fpm

# Mag-install ng system dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# I-install ang PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# I-copy ang code mo
COPY . /var/www

# I-set ang working directory
WORKDIR /var/www

# I-install ang composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install

CMD php artisan serve --host=0.0.0.0 --port=$PORT