#!/bin/bash
set -e

# Optimizar Laravel para producción
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Ejecutar migraciones
php artisan migrate --force

# Iniciar Apache
exec "$@"
