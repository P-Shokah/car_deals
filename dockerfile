FROM php:8.2-cli

WORKDIR /app

# Install tools and PHP extensions
RUN apt-get update && apt-get install -y unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring xml

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install --no-dev --optimize-autoloader

EXPOSE 8000

# Start Laravel
CMD ["php","artisan","serve","--host=0.0.0.0","--port=8000"]