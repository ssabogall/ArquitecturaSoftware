FROM php:8.3.11-apache

# 1. System dependencies
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    && rm -rf /var/lib/apt/lists/*

# 2. PHP extensions
RUN docker-php-ext-install pdo_mysql

# 3. Composer
RUN curl -sS https://getcomposer.org/installer \
    | php -- --install-dir=/usr/local/bin --filename=composer

# 4. Working dir del proyecto
WORKDIR /var/www/html

# 5. Copiar el proyecto Laravel
COPY . /var/www/html

# 6. Instalar dependencias PHP
RUN composer install \
    --ignore-platform-reqs \
    --no-interaction \
    --no-plugins \
    --no-scripts \
    --prefer-dist

# 7. Generar APP_KEY si no existe (en build). 
#    En runtime, si pasas APP_KEY por .env/--env-file, ese valor será el que manda.
RUN php artisan key:generate --force || true

# 8. Crear symlink de storage (public/storage -> storage/app/public)
RUN php artisan storage:link || true

# 9. Preparar directorios de escritura y permisos
RUN mkdir -p \
      storage \
      bootstrap/cache \
      public/images \
      storage/app/public/reports \
    && chown -R www-data:www-data \
      storage \
      bootstrap/cache \
      public \
    && chmod -R 775 \
      storage \
      bootstrap/cache \
      public

# 10. Habilitar mod_rewrite
RUN a2enmod rewrite

# 11. Cambiar DocumentRoot a /var/www/html/public
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/000-default.conf

# 12. Arranque de Apache
CMD ["apache2-foreground"]