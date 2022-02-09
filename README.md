# MileApp Backend Test

[![N|MileApp](https://mile.app/wp-content/uploads/2021/07/HDPI.png)](https://mile.app/)

This is repositories for API MileApp Backend Test

# Development Setup
* [php] - base language (PHP Version 8.0)
* [laravel] - framework for code 
* [laravel-mongodb] - ORM MongoDB for Laravel
* [mongodb] - Driver database yang digunakan 

# Installation
Berikut merupakan langah-langkah untuk instalasinya
```bash
git clone https://github.com/khaizbt/mileapp-test.git
cd mileapp-test
```

*karena authentikasi memakai sanctum dan defaultnya tidak menggunakan MongoDB maka kamu harus mengubah

```bash
 /vendor/laravel/sanctum/src/SanctumServiceProvider.php
 ```

Ubah dari
```bash
use Illuminate\Database\Eloquent\Model;
```
ke 
```bash
use Jenssegers\Mongodb\Eloquent\Model;

```

Restore file binary Database yang sudah dikirimkan melalui email atau bisa diakses pada [link ini](https://github.com/khaizbt/mileapp-test/blob/main/mileapp-db) kemudian jalankan perintah berikut(Untuk Windows), Jika OS bukan Windows bisa lihat dokumentasi [disini](https://docs.mongodb.com/database-tools/mongorestore/)

```
mongorestore.exe --archive="mileapp-db" --nsFrom="mileapp.*" --nsTo="mileAppBackup.*" 
```


*ganti .env sesuai dengan credential mongodb kamu lalu jalankan perintah berikut(disini saya memakai nama database mileAppBackup dari hasil restore database*
```bash
composer install
php artisan key:generate

```

Untuk dapat mengakses resource packages, kamu harus login terlebih dahulu pada postman (Login Request)
```bash
email: user@mailtrap.io
password: password123
```

## Endpoint Access
Untuk mengakses Endpointnya kamu bisa melakukannya di link berikut [POSTMAN](https://documenter.getpostman.com/view/12945074/UVeJM5yf#6e3e22fb-7101-44ce-8b1b-2f3c172b5437)
atau mengimport manual file dengan nama "Mileapp.postman_collection.json" yang sudah dikirimkan via email

## Unit Testing
Sebelum menjalankan Unit Testing, Diharapkan untuk menyiapkan data valid(karena Unit Testing datanya masih Hard Code) seperti token beserta Package ID, Customer ID, Location ID, Connote ID untuk dijalankan pada File Unit Testing([PackageCRUDTest](https://github.com/khaizbt/mileapp-test/blob/main/tests/Feature/PackageCRUDTest.php)) ketika sudah selesai, jalankan :
```bash
php artisan test
```


### Thanks a lot
terimakasih team mileapp yang sudah mau membaca dokumentasi singkat ini, mohon maaf jika masih banyak kekurangan.


[php]: <https://php.net/> 
[laravel]: <https://laravel.com>
[laravel-mongodb]: <https://github.com/jenssegers/laravel-mongodb/>
[mongodb]: <https://www.mongodb.com/> 


