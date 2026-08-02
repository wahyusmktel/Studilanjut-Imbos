#!/bin/bash

# ==============================================================================
# Script Deployment Otomatis Studi Lanjut IMBOS
# Domain: https://studi.imbospringsewu.com/
# ==============================================================================

set -e

# Warna Log Output
GREEN='\033[0;32m'
BLUE='\033[0;34m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

echo -e "${BLUE}====================================================${NC}"
echo -e "${BLUE}  MEMULAI DEPLOYMENT STUDI LANJUT IMBOS             ${NC}"
echo -e "${BLUE}====================================================${NC}"

# 1. Aktifkan Maintenance Mode
echo -e "${YELLOW}[1/8] Mengaktifkan Maintenance Mode...${NC}"
php artisan down || true

# 2. Pull Update Terbaru dari Repository Git
echo -e "${YELLOW}[2/8] Menarik update dari Git (git pull)...${NC}"
git pull origin main

# 3. Install / Update Dependensi Composer
echo -e "${YELLOW}[3/8] Memasang dependensi Composer...${NC}"
composer install --no-dev --optimize-autoloader

# 4. Menjalankan Migrasi Database
echo -e "${YELLOW}[4/8] Menjalankan migrasi database...${NC}"
php artisan migrate --force

# 5. Menghubungkan Storage Symlink
echo -e "${YELLOW}[5/8] Memeriksa storage link...${NC}"
php artisan storage:link || true

# 6. Mengosongkan dan Mengoptimalkan Cache Laravel
echo -e "${YELLOW}[6/8] Memperbarui dan mengoptimalkan cache Laravel...${NC}"
php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear

php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 7. Mematikan Maintenance Mode
echo -e "${YELLOW}[7/8] Mematikan Maintenance Mode (Aplikasi Online)...${NC}"
php artisan up || sudo php artisan up

# 8. Memperbaiki Hak Akses Permisi Folder Storage & Cache
echo -e "${YELLOW}[8/8] Memperbaiki izin direktori (permissions)...${NC}"
CURRENT_USER=${SUDO_USER:-$USER}
sudo chown -R $CURRENT_USER:www-data storage bootstrap/cache
sudo chmod -R 775 storage bootstrap/cache

echo -e "${GREEN}====================================================${NC}"
echo -e "${GREEN}  DEPLOYMENT SESELESAI & APLIKASI SIAP BEROPERASI!  ${NC}"
echo -e "${GREEN}  Domain: https://studi.imbospringsewu.com/         ${NC}"
echo -e "${GREEN}====================================================${NC}"
