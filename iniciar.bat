@echo off
echo Iniciando servidor Laravel...
start "Laravel" cmd /k "php artisan serve --host=127.0.0.1 --port=8000"

echo Iniciando Vite (frontend)...
start "Vite" cmd /k "npm run dev"

echo.
echo Servidores iniciados:
echo   App:      http://127.0.0.1:8000
echo   Vite:     http://127.0.0.1:5173
echo.
echo Abre http://127.0.0.1:8000 en el navegador
pause
