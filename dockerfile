FROM php:8.2-cli

WORKDIR /app

# Install tools
RUN apt-get update && apt-get install -y unzip git curl

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install Laravel dependencies
RUN composer install

EXPOSE 8000

# Start Laravel
CMD ["php","artisan","serve","--host=0.0.0.0","--port=8000"]