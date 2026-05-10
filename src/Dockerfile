FROM php:8.2-cli

# Set working directory
WORKDIR /var/www

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl unzip libpq-dev libonig-dev libzip-dev \
    nodejs npm \
    && docker-php-ext-install pdo pdo_mysql pdo_pgsql mbstring zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy project files
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Install Node dependencies and build frontend (Vite)
RUN npm install
RUN npm run build

# Generate Laravel app key (safe fallback)
RUN php artisan key:generate || true

# Set correct permissions (important for Laravel)
RUN chmod -R 775 storage bootstrap/cache

# Expose port (Render requires this)
EXPOSE 10000

# Start Laravel server
CMD php artisan serve --host=0.0.0.0 --port=10000