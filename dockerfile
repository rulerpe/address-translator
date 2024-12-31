# Use PHP 8.4 FPM Alpine as base
FROM php:8.4-fpm-alpine

# Install system dependencies
RUN apk add --no-cache \
    nginx \
    mysql-client \
    nodejs \
    npm \
    git \
    zip \
    unzip \
    libpng-dev \
    libzip-dev \
    jpeg-dev \
    oniguruma-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install composer
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy application files
COPY . .

# Install composer dependencies
RUN composer install --optimize-autoloader --no-dev

# Install and build npm dependencies
RUN npm install && npm run build

# Copy Nginx configuration
COPY docker/nginx.conf /etc/nginx/http.d/default.conf

# Set appropriate permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Configure PHP-FPM
RUN echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf && \
    echo "php_admin_value[error_log] = /dev/stderr" >> /usr/local/etc/php-fpm.d/www.conf

# Optimize Laravel
RUN php artisan optimize

# Clean up
RUN rm -rf node_modules

# Expose port 8080 (Cloud Run requirement)
EXPOSE 8080

# Create startup script
RUN echo '#!/bin/sh' > /start.sh && \
    echo 'php artisan config:cache' >> /start.sh && \
    echo 'php artisan route:cache' >> /start.sh && \
    echo 'php artisan view:cache' >> /start.sh && \
    echo 'php artisan migrate --force' >> /start.sh && \
    echo 'php-fpm -D' >> /start.sh && \
    echo 'nginx -g "daemon off;"' >> /start.sh && \
    chmod +x /start.sh

# Start services
CMD ["/start.sh"]