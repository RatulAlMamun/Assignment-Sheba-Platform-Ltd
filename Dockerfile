FROM php:8.2-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl zip unzip supervisor libonig-dev libzip-dev libpq-dev libpng-dev libxml2-dev libssl-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring xml

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create app directory
WORKDIR /var/www

# Copy Laravel files
COPY . .

# Install Laravel dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Permissions
RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www/storage

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]

