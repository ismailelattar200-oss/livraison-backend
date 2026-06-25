@echo off
echo Creation du dossier frontend\public\images...
mkdir "c:\Users\user\Desktop\Marea\frontend\public\images" 2>nul

echo Copie des images...
copy /Y "C:\Users\user\.gemini\antigravity-ide\brain\04e8c99a-9c1f-4f15-90c3-14b2824caf63\falafel_with_hummus_1781641273358.png" "c:\Users\user\Desktop\Marea\frontend\public\images\falafel.png"
copy /Y "C:\Users\user\.gemini\antigravity-ide\brain\04e8c99a-9c1f-4f15-90c3-14b2824caf63\lamb_tagine_1781641329105.png" "c:\Users\user\Desktop\Marea\frontend\public\images\tagine.png"
copy /Y "C:\Users\user\.gemini\antigravity-ide\brain\04e8c99a-9c1f-4f15-90c3-14b2824caf63\chicken_pastilla_1781641423449.png" "c:\Users\user\Desktop\Marea\frontend\public\images\pastilla.png"
copy /Y "C:\Users\user\.gemini\antigravity-ide\brain\04e8c99a-9c1f-4f15-90c3-14b2824caf63\vegan_burger_1781641447265.png" "c:\Users\user\Desktop\Marea\frontend\public\images\vegan_burger.png"

echo Mise a jour de la base de donnees...
cd c:\Users\user\Desktop\Marea\backend
php artisan db:seed --class=MenuItemSeeder

echo Termine! Les images ont ete ajoutees au site.
pause
