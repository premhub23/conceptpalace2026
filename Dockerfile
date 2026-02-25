
FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy project files into Apache directory
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

RUN apt-get update && apt-get install -y libpq-dev
RUN docker-php-ext-install pdo_pgsql
