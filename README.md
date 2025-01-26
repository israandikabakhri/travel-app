# Travel App
_By: Isra Andika Bakhri_

### Instalation Travel App

Hal wajib dipastikan sebelum cloning adalah memastikan telah menistall PHP Versi >= 8 dan PostgreSql


Buka terminal anda lalu masukkan perintah
```
git clone https://github.com/israandikabakhri/travel-app 
```
masuk ke project dengan mengetik
```
cd travel-app
```
kemudian, masukkan dalam terminal untuk menginstall `dependency`
```
composer install
```
generete ``.env`` dengan cara:
```
cp .env.example .env
```
lalu membuat ``key`` didalam ``.env``
```
php artisan key:generate
```
buat, database bernama `travel-app`

buka ``.env`` kemudia menyetel ``.env`` untuk konfigurasi PostgreSQl
```
DB_CONNECTION=pgsql   --> pastikan ini pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=travel-app --> nama DB
DB_USERNAME=postgres   --> pastikan username pgsql
DB_PASSWORD=YOUR_PASSWORD --> pastikan password pgsql benar
.
.
.
FILESYSTEM_DISK=local --> ubah menjadi public
```
jalankan perintah `migration` seperti dibawah ini
```
php artisan migrate
```
terakhir jalankan aplikasi di `port 9000` dengan mengetikkan perintah
```
php artisan serve --port=9000
```
buka browser dan masukkan link
```
http://localhost:9000
```

# Penjelasan Struktur Project

Struktur folder dibuat modular berdasarkan role yang ada dalam aplikasi yakni `admin` dan `penumpang`
maka kita bisa melihat adanya pemisahan urusan per role tersebut. Kemudia dalan pembagian tersebut dibagilah 
menjadi beberapa urusan yang melibatkan masing-masing role, sehingga diharapkan prinsip `Maintable` dan `Keterbacaan kode` dalam berjalan dengan baik.

## Controller
```sh
travel-app/
└── app/
    └── Controllers/
        ├── Admin/
        │   ├── PemesananController.php
        │   ├── TravelController.php
        ├── Penumpang/
        │   ├── PemesananController.php
        │   ├── TravelController.php
        └── AuthController.php
```


## Service
```sh
travel-app/
└── app/
    └── Services/
        ├── Admin/
        │   ├── PemesananService.php
        │   ├── TravelService.php
        ├── Penumpang/
        │   └── PemesananService.php
        └── GlobalService.php
```


## View
```sh
travel-app/
└── resources/
    └── views/
        ├── Admin/
        │   ├── Pemesanan/
        │   │   └── *  (Semua file terkait Pemesanan Admin)
        │   ├── Travel/
        │       └── *  (Semua file terkait Travel Admin)
        ├── Penumpang/
        │   ├── Pemesanan/
        │   │   └── *  (Semua file terkait Pemesanan Penumpang)
        │   ├── Travel/
        │       └── *  (Semua file terkait Travel Penumpang)
        └── Auth/
            └── *  (File terkait autentikasi)

```

Buat registrasi sebagai pelanggan terlebih dahulu
pada Halaman Register untuk membaut akun `penumpang` / user
```
http://localhost:9000/register
```

Secara default akun dari admin sudah bisa langsung digunakan, silahkan akses halaman `Login`
```
http://localhost:9000/
```

Dan masukkan username dan password berikut:
- Username: admin@example.com
- Password: 12345678
- Role `[admin]`