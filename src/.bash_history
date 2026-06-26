id
chown -R 1000:1000 storage bootstrap/cache
chmod -R 775 storage bootstrap/cache
php artisan optimize:clear
exit
