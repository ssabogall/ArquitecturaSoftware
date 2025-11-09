FROM php:8.3.11-apache

RUN apt-get update -y && apt-get install -y openssl zip unzip git
RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

# Working dir del proyecto
WORKDIR /var/www/html

# Copiamos todo el proyecto Laravel
COPY . /var/www/html

# Instalamos dependencias
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# Generamos APP_KEY
RUN php artisan key:generate

# Permisos
RUN chmod -R 777 storage bootstrap/cache

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Cambiar DocumentRoot a /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# Arranque de Apache
CMD ["apache2-foreground"]