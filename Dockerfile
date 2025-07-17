FROM php:8.2-apache

# System dependencies
RUN apt-get update && apt-get install -y \
    zip unzip git curl libpng-dev libjpeg-dev libfreetype6-dev libzip-dev libonig-dev nodejs npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo_mysql mbstring zip bcmath gd opcache

# Enable Apache rewrite
RUN a2enmod rewrite

# Change Apache port to 8080 (Cloud Run requirement)
RUN sed -i 's/Listen 80/Listen 8080/' /etc/apache2/ports.conf \
 && sed -i 's/:80/:8080/' /etc/apache2/sites-available/000-default.conf

# Set working directory
WORKDIR /var/www/html

# Copy composer and npm-related files
COPY composer.json composer.lock package.json package-lock.json ./

# Install PHP and JS dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
 && composer install --no-dev --optimize-autoloader \
 && npm install \
 && npm run build

# Copy rest of the app
COPY . .

# Fix permissions
RUN chmod -R 775 storage bootstrap/cache

# Laravel pre-optimization
RUN php artisan config:cache \
 && php artisan route:cache \
 && php artisan view:cache

# Expose correct port
EXPOSE 8080

# Start Apache
CMD ["apache2-foreground"]
