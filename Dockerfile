FROM php:7.4-cli

# Instala dependencias del sistema
RUN apt-get update && apt-get install -y \
    libpng-dev libjpeg-dev libfreetype6-dev unzip git curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Instala Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Establece directorio de trabajo
WORKDIR /var/www/html

# Copia tu proyecto Laravel
COPY . .

# Instala dependencias de Laravel
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Genera la APP_KEY
RUN php artisan key:generate

# Corre migraciones y seeders
RUN php artisan migrate --force && php artisan db:seed --force

# Expone el puerto
EXPOSE 8000

# Arranca el servidor
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]
