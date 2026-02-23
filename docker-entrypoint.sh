#!/bin/bash
set -e

# Usar el puerto asignado por Railway (default 80)
PORT=${PORT:-80}

# Configurar Apache para escuchar en el puerto correcto
sed -i "s/Listen 80/Listen $PORT/" /etc/apache2/ports.conf
sed -i "s/<VirtualHost \*:80>/<VirtualHost *:$PORT>/" /etc/apache2/sites-enabled/*.conf

# Limpiar y optimizar Laravel
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Ejecutar migraciones
php artisan migrate --force || true

# Iniciar Apache
exec apache2-foreground
