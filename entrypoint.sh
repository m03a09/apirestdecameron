#!/bin/bash

# Generar la clave de la app
php artisan key:generate --force

# Ejecutar migraciones
php artisan migrate --force

# Verificar si la tabla tipos_habitacion está vacía
count=$(php artisan db:query "SELECT COUNT(*) FROM tipos_habitacion;" | grep -o '[0-9]*')

if [ "$count" -eq 0 ]; then
    echo "Seeders ejecutándose porque tipos_habitacion está vacía..."
    php artisan db:seed --force
else
    echo "Saltando seeding porque ya existen datos en tipos_habitacion."
fi

# Iniciar el servidor
php -S 0.0.0.0:8000 -t public
