# Taman Dayu Sales & Marketing — versi Laravel (overlay)

Berisi file aplikasi yang ditempel ke proyek Laravel 11/12 baru (PHP 8.2+, Composer, MySQL, ekstensi GD aktif).

## Pasang
1. `composer create-project laravel/laravel taman-dayu` lalu `cd taman-dayu`
2. Salin SELURUH isi folder overlay ini ke proyek tadi (timpa file yang sama: `routes/web.php`, `app/Providers/AppServiceProvider.php`, `database/seeders/DatabaseSeeder.php`).
3. Edit `.env`: `APP_URL`, `APP_LOCALE=id`, dan database: `DB_CONNECTION=mysql DB_HOST=127.0.0.1 DB_DATABASE=taman_dayu_sales DB_USERNAME=root DB_PASSWORD=` (buat database kosong dulu di phpMyAdmin).
   Opsional (kontak default; bisa juga lewat admin): `MAIN_WHATSAPP=`, `MAIN_EMAIL=`, `APP_DOMAIN=https://domain-resmi`.
4. `php artisan migrate --seed`
5. `php artisan admin:create emailanda@contoh.com PasswordMinimal10`
6. `php artisan serve`, lalu buka http://127.0.0.1:8000 (admin: `/admin/login`).
Folder `public/assets/images/*` harus bisa ditulis web server (upload foto otomatis jadi WebP).

## Peta file
- Halaman: `routes/web.php` -> `PageController` -> `resources/views/pages/*` + `partials/*` + `layouts/*`.
- Inquiry: `InquiryController` (validasi, CSRF Laravel, throttle, simpan ke DB; sukses hanya jika tersimpan).
- Admin: `AdminController` (login, inquiry, tim, event, galeri, pengaturan); akun: `php artisan admin:create`.
- Default & 4 kartu layanan (PIC WhatsApp per layanan): `config/tamandayu.php`. Foto kartu layanan: `public/assets/images/placeholders/service-1..4.jpg`.
- Helper (tombol aman, link WhatsApp, WebP): `app/helpers.php`. CSS/JS: `public/assets/` (sama dengan versi native).

## Status
Belum diuji (sandbox pembuatan tanpa PHP/Composer). Belum ada: email notifikasi inquiry (menyusul; Laravel Mail + SMTP resmi).
