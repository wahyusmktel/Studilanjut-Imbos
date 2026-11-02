#!/usr/bin/env bash
# ==============================================================================
# SCRIPT DEPLOYMENT OTOMATIS - STUDI LANJUT IMBOS
# Domain: https://studi.imbospringsewu.com/
# ==============================================================================
set -e

APP_DIR="/var/www/studilanjutimbos"

echo "======================================================"
echo "🚀 [$(date '+%Y-%m-%d %H:%M:%S')] Memulai Deployment Studi Lanjut IMBOS..."
echo "📂 Target: $APP_DIR"
echo "======================================================"

cd "$APP_DIR" || { echo "❌ Direktori $APP_DIR tidak ditemukan!"; exit 1; }

# Pastikan git safe directory
git config --global --add safe.directory "$APP_DIR" || true

# 1. Pastikan hak akses folder .git, storage framework & cache sebelum eksekusi
echo "🔒 Menyiapkan permission awal..."
sudo chown -R wahyurah55:wahyurah55 .git
sudo chmod -R 775 .git
sudo chown -R www-data:www-data storage/framework storage/logs bootstrap/cache
sudo chmod -R 775 storage/framework storage/logs bootstrap/cache

# 2. Aktifkan Maintenance Mode
echo "⏸️  Mengaktifkan maintenance mode..."
php artisan down || true

# 3. Ambil perubahan terbaru dari Git
echo "📥 Melakukan git fetch and reset origin main..."
git fetch origin main
git reset --hard origin/main

# 4. Install / Update Composer dependencies (Production)
echo "📦 Menginstall dependency Composer (No Dev)..."
composer install --no-dev --optimize-autoloader --no-interaction

# 5. Jalankan migrasi database
echo "🗄️  Menjalankan migrasi database..."
php artisan migrate --force

# 6. Storage Link & Optimasi Cache Laravel
echo "🧹 Membersihkan and mengoptimasi cache Laravel..."
php artisan storage:link || true
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 7. Nonaktifkan Maintenance Mode
echo "▶️  Menonaktifkan maintenance mode..."
php artisan up || true

# 8. Set hak akses permission direktori
echo "🔒 Memperbarui permission direktori storage and cache..."
sudo chown -R www-data:www-data storage/framework storage/logs bootstrap/cache
sudo chmod -R 775 storage/framework storage/logs bootstrap/cache

# 9. Reload PHP-FPM
echo "🔄 Mereload PHP-FPM..."
sudo systemctl reload php8.4-fpm || true

echo "======================================================"
echo "✅ [$(date '+%Y-%m-%d %H:%M:%S')] DEPLOYMENT STUDI LANJUT IMBOS SUKSES!"
echo "🌐 URL: https://studi.imbospringsewu.com/"
echo "======================================================
