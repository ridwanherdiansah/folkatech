Instalasi

1. Clone Repositori:
git clone https://github.com/ridwanherdiansah/folkatech.git
cd admin-panel

2. Instal Dependensi
composer install

3. Siapkan File Lingkungan
cp .env.example .env

4. Hasilkan Kunci Aplikasi
php artisan key:generate

5. Jalankan Migrasi
php artisan migrate

6. Seed Database (Opsional)
php artisan db:seed

Konfigurasi Emai
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=your_mailtrap_username
MAIL_PASSWORD=your_mailtrap_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=your_email@example.com
MAIL_FROM_NAME="${APP_NAME}"

Menjalankan Aplikasi
php artisan serve
npm run dev

Menjalankan Unit Test
php artisan test