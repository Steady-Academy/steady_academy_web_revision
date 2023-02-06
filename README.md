# Guide Cara Menjalankan Aplikasi Steady Academy
Disini kami menggunakan microservice firebase firestore jadi dibutuhkan GRPC untuk 
komunikasi antara laravel dengan database firebase firestore. 
#### catatan: Membutuhkan koneksi internet 

## Requirement
  - Composer
  - Laravel versi 8 atau lebih tinggi
  - PHP versi 8 atau lebih tinggi
  - GRPC
  - NGROK

## Cara setting PHP GRPC
  - Silahkan download GRPC 
    - http://pecl.php.net/package/gRPC/1.43.0/windows
      pastikan download versi PHP yang sesuai dengan sistem anda
      kami menrekomendasikan untuk mendownload yang versi 8 
      https://windows.php.net/downloads/pecl/releases/grpc/1.43.0/php_grpc-1.43.0-8.0-ts-vs16-x64.zip
   - Setelah selesai di download silahkan extract
   - Setelah diextract nanti akan ada beberapa file didalamnya
   - Cari dan pilihlah file yang bernama `php_grpc.dll`
   - Copy dan paste file `php_grpc.dll` ke dalam folder `xampp/php/ext`
   - Lalu buka file `php.ini` di `xampp/php` dan tambahkan `extension=grpc` kemudian save
   - Setelah itu coba untuk restart server XAMPP
   - Untuk memastikan gRPC sudah terinstall kedalam sistem PHP
     Buka `http://localhost/dashboard/phpinfo.php`
     Cari dan temukan grpc dengan cara `ctrl + f`

## Cara menjalankan aplikasi
  - Jika PHP gRPC sudah terinstall buka folder aplikasi dan jalankan `composer install`
  - Jika terjadi error coba menggunakan `composer install --ignore-platform-reqs`
  - Lalu jika file `.env` tidak ada silahkan copy `.env.example` menjadi `.env`
  - Setelah itu silahkan buka terminal dan ketika `php artisan key:generate`
  - Jika telah selesai, jalankan `php artisan serve --port 8080`

## Cara login Admin
  - Silahkan ketikan url `http://localhost:8080/steadyacademy/admin/login`
  - untuk emailnya adalah `refi.ahmad.fauzn@gmail.com`
  - untuk passwordnya adalah `password`

## Cara login instructur menggunakan Google
  - Untuk login menggunakan google kita harus menggunakan proxy server NGROK
  - Silahkan install NGROK di https://ngrok.com/download
  - Setelah selesai jalankan `ngrok http 8080`
  - buka file `.env` diaplikasi steady academy
  - tambahkan url forwarding pada ngrok yang dijalankan contoh `https://dc28-125-164-19-108.ap.ngrok.io`
    ke `APP_URL` dan ke `URL_NGROK`
  - jika sudah, kemudian buka firebase console -> authentication -> settings -> Authorized Domain copy url tadi dan pastekan disini.
    note: untuk melakukannya silahkan kontak ke Farrel Rafiardi Kusmana karena firebase consolenya menggunakan akun pribadi.
 

Jika ada kendala silahkan tanyakan ke Farrel Rafiardi Kusmana XII RPL 1

# Fitur yang tersedia
- Login & Register
- Authentication menggunakan Google
- Group Chatting Admin
- CRUD Kategori Kursus
- CRUD Level Kursus
- CRUD Tipe Harga Kursus
- Membuat kursus dengan stepper
- CRUD Tags
