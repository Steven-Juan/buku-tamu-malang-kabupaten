#!/bin/sh
set -e

cd /var/www/html

# Pastikan folder storage ada (volume baru bisa kosong)
mkdir -p storage/app/public storage/framework/cache/data storage/framework/sessions \
         storage/framework/views storage/logs bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache

if [ -z "$APP_KEY" ]; then
    echo "ERROR: APP_KEY kosong. Isi APP_KEY di file .env (php artisan key:generate --show)." >&2
    exit 1
fi

php artisan package:discover --ansi
php artisan storage:link --force || true

echo "Menjalankan migrasi database..."
php artisan migrate --force

# Seed hanya saat database masih kosong (belum ada user)
USER_COUNT=$(php artisan tinker --execute='echo \App\Models\User::count();' 2>/dev/null | tail -n 1)
if [ "$USER_COUNT" = "0" ]; then
    echo "Database kosong, menjalankan seeder..."
    php artisan db:seed --force
fi

if [ "$APP_ENV" = "production" ]; then
    php artisan optimize
else
    php artisan optimize:clear
fi

chown -R www-data:www-data storage bootstrap/cache

exec "$@"
