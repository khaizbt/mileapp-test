# MileApp Backend Test

[![N|MileApp](https://mile.app/wp-content/uploads/2021/07/HDPI.png)](https://mile.app/)

This is repositories for API MileApp Backend Test

# Development Setup
* [php] - base language
* [laravel] - framework for code 
* [laravel-mongodb] - ORM MongoDB for Laravel
* [mongodb] - Driver database yang digunakan 

# Installation
Berikut merupakan langah-langkah untuk instalasinya
```bash
git clone https://github.com/khaizbt/mileapp-test.git
cd mileapp-test
```
*ganti .env sesuai dengan credential mongodb kamu lalu jalankan perintah berikut*
```bash
composer install
php artisan key:generate
php artisan migrate:fresh --seed

```

Untuk dapat mengakses resource packages, kamu harus login terlebih dahulu
```bash
email: user@mailtrap.io
password: password123
```

## Endpoint Access
Untuk mengakses Endpointnya kamu bisa melakukannya di link berikut [POSTMAN](https://documenter.getpostman.com/view/12945074/UVeJM5yf#6e3e22fb-7101-44ce-8b1b-2f3c172b5437)
atau mengimport manual file dengan nama "Mileapp.postman_collection.json" yang ada di file directory dari program

### Thanks a lot
terimakasih team mileapp yang sudah mau membaca dokumentasi singkat ini, mohon maaf jika masih banyak kekurangan.


[php]: <https://php.net/> 
[laravel]: <https://laravel.com>
[laravel-mongodb]: <https://github.com/jenssegers/laravel-mongodb/>
[mongodb]: <https://www.mongodb.com/> 


