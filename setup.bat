@echo off
echo ==============================================
echo Installing missing Laravel files...
echo ==============================================

cd /d "%~dp0"

echo [1/4] Creating a fresh Laravel project...
call composer create-project laravel/laravel backend-fresh

echo [2/4] Installing Sanctum API...
cd backend-fresh
call php artisan install:api --yes
cd ..

echo [3/4] Copying custom code...
xcopy /s /e /y "backend\app\*" "backend-fresh\app\" >nul
xcopy /s /e /y "backend\database\*" "backend-fresh\database\" >nul
xcopy /s /e /y "backend\routes\*" "backend-fresh\routes\" >nul
copy /y "backend\.env" "backend-fresh\" >nul

echo [4/4] Swapping directories...
ren backend backend-backup
ren backend-fresh backend

echo ==============================================
echo Setup Complete! Starting the server now...
echo ==============================================
cd backend
call php artisan migrate:fresh --seed
call php artisan serve
pause
