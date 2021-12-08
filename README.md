Kelompok 5 Proyek TI 3D
===

SISTEM INFORMASI  PENJUALAN PADA BILLIE BEANS SUPPLY COFFE.CO BERBASIS WEB

### Daftar Anggota Kelompok

| No |         Nama        |     NIM    |
|:--:|:-------------------:|:----------:|
|  1 | Abdur Rozak Junaidi | 1941720094 |
|  2 | Dwi Nur Oktaviani   | 1941720239 |
|  3 | Mochammad Dimasqi   |            |
|  4 | Noor Afiad          |            |
|  5 | Pramudya Wibowo     | 1941720054 |

Build
=====
### Clone repository
```
git clone https://github.com/pramudyapolinema/system_sales.git
```
### NPM & composer Setup
```
npm install
composer install
```
### Environtment Setting
* Copy .env.example to .env
* Make sure all parameter has been filled with valid data
```
php artisan key:generate
```
### Migrating
* Make sure your MySQL Database is running
```
php artisan migrate
```
### Seeding
```
php artisan db:seed --class=LocationSeeder
php artisan db:seed --class=UserSeeder
```
### Run Laravel
```
php artisan serve
```
* Open your browser and type
```
localhost:8000
```
* Use email : admin@proyek.com and password : admin
* Use email : user@proyek.com and password : user

## Dockerized
### Build
```
git clone https://github.com/pramudyapolinema/system_sales.git
cd system_sales
```
### Environtment Setting
* Copy .env.example to .env
```
sudo cp .env.example .env
```
* Make sure all parameter has been filled with valid data
### Run Docker Compose
```
sudo docker-compose up -d
```
### Laravel initialization
```
sudo ./laravel.sh
```
### Testing
* Open your browser, type your Public IP Address or use localhost
* If it show login page use email : admin@proyek.com and password : admin or email : user@proyek.com and password : user
