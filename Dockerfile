FROM php:7.4-cli

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de tu aplicación
COPY . .

# Instala las dependencias necesarias
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev && docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd

# Expón el puerto
EXPOSE 8080

CMD ["php", "-S", "0.0.0.0:8080", "-t", "/var/www/html"]
