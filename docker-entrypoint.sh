#!/bin/bash
set -e

# Limpiar cachés anteriores
php artisan config:clear || true
php artisan route:clear || true
php artisan view:clear || true

# Optimizar para producción
php artisan config:cache || true
php artisan route:cache || true
php artisan view:cache || true

# Ejecutar migraciones
php artisan migrate --force || true

# Iniciar Apache
exec "$@"
