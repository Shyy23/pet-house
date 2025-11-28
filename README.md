## 🛠️ Cara Instalasi (Clone dari GitHub)

Buka terminal di folder tujuan, lalu jalankan perintah berurutan:

### 1. Clone & Install Dependensi

Jalankan perintah ini karena folder `vendor` dan `node_modules` tidak disertakan di GitHub:

# 1. Clone Repository

git clone https://github.com/Shyy23/pet-house.git

# 2. Masuk ke folder project

cd pet-house

# 3. Install Backend Dependencies

composer install

# 4. Install Frontend Dependencies (Wajib untuk Vite/Tailwind)

npm install

### 2. Setup Environment

Pada tahap ini, kita perlu membuat file konfigurasi lingkungan (.env) yang berisi pengaturan khusus untuk aplikasi kita. File .env sangat penting karena berisi informasi sensitif seperti koneksi database, kunci aplikasi, dan konfigurasi email yang tidak boleh dibagikan ke publik.

Di dalam repository pet-house, terdapat file bernama `.env.example` yang berfungsi sebagai template atau contoh struktur file konfigurasi. Kita perlu menyalin file ini menjadi `.env` yang akan digunakan oleh aplikasi:

salin file `.env.example` dan ubah menjadi `.env`

Setelah file `.env` berhasil dibuat, langkah selanjutnya adalah menghasilkan kunci aplikasi unik yang akan digunakan untuk enkripsi data:

php artisan key:generate

Perintah ini akan secara otomatis mengisi nilai `APP_KEY` di dalam file `.env` dengan string acak yang panjang dan aman. Kunci ini sangat penting untuk keamanan aplikasi Laravel Anda.

### 3. Konfigurasi Database

Buat database kosong di phpMyAdmin bernama: `db_pet_house`.

Buka file .env, sesuaikan konfigurasi berikut:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_pet_house
DB_USERNAME=root
DB_PASSWORD=

```

### 4. Migrasi Data

Pilih salah satu cara di bawah ini untuk mengisi tabel:

Cara A (Recommended - via Terminal): Mengisi tabel dan data dummy otomatis.
`php artisan migrate:fresh --seed`

Cara B (Alternatif - via Import SQL): Import file `db_pet_house.sql` (tersedia di folder root) ke database `db_pet_house` melalui phpMyAdmin.

### 5. Setup Storage Link

Agar foto hewan yang diupload dapat tampil:
`php artisan storage:link`

🚀 Menjalankan Aplikasi
Aplikasi ini membutuhkan dua terminal yang berjalan bersamaan.

Terminal 1 (Vite - Untuk Tampilan/CSS):
`npm run dev`
(Biarkan terminal ini tetap terbuka)

Terminal 2 (Server Laravel):
`php artisan serve`

Akses aplikasi di browser: http://127.0.0.1:8000

🛠️ Troubleshooting (Jika Error)

-   Jika tampilan berantakan / CSS tidak load:
    • Hapus folder node_modules.
    • Jalankan npm install.
    • Jalankan npm run dev kembali.

-   Jika error PHP / Class not found:
    composer dump-autoload

```

```
