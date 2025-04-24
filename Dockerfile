FROM php:7.4-cli

# Actualizar repositorios
RUN apt-get update

# Instalar dependencias comunes
RUN apt-get install -y --no-install-recommends \
    git unzip curl libpq-dev

# Instalar extensiones PHP 7.4 necesarias
RUN apt-get install -y --no-install-recommends \
    php7.4-mbstring \
    php7.4-xml \
    php7.4-curl \
    php7.4-pgsql

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . .

# Instalar dependencias PHP de Composer
RUN composer install --no-interaction --prefer-dist --optimize-autoloader

# Generar key de Laravel
RUN php artisan key:generate

# Correr migraciones y seeders
RUN php artisan migrate --force --seed

EXPOSE 80

CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]