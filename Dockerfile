FROM php:8.2-apache

# Install PostgreSQL dependencies
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql mysqli \
    && apt-get clean

# Copy project files
COPY . /var/www/html/

EXPOSE 80
