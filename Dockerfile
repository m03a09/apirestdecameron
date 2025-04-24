FROM php:7.4-cli

# Instala dependencias del sistema y Composer
RUN apt-get update && apt-get install -y \
    curl \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
 && docker-php-ext-configure gd --with-freetype --with-jpeg \
 && docker-php-ext-install gd

# Instala Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de tu app
COPY . .

# Expón el puerto que usás
EXPOSE 8000

# Comando por defecto
CMD ["php", "-S", "0.0.0.0:8000", "-t", "/var/www/html"]
