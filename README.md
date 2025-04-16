# GoBlog

GoBlog adalah project Laravel sederhana untuk membuat dan mengelola postingan blog.

## Fitur

-   CRUD
-   Panel admin menggunakan Filament
-   Role user & admin
-   Forum discussion (Komentar dan Reply)
-   Like dan Dislike untuk setiap Post
-   Fitur Report Post, Komentar, dan Reply

## Dibuat dengan

-   Laravel 11
-   Tailwind CSS
-   Filament
-   MySQL

## Cara Instalasi

### Clone Repository

```bash
git clone https://github.com/username/goblog.git
cd goblog
```

### Install Dependency

```bash
composer install
npm install
```

### Salin File .env

```bash
cp .env.example .env
```

### Generate App Key

```bash
php artisan key:generate
```

### Setup Database

DB_DATABASE=goblog
DB_USERNAME=root
DB_PASSWORD=

### Buat Database di MySQL

create database goblog

### Run Migrate

```bash
php artisan migrate --seed
```

### Run The Application

run build frontend

```bash
npm run dev
```

run server

```bash
php artisan serve
```

lalu copy [htttp://127.0.0.1:8000] ke browser

### Akun Admin (Akses Panel Admin)

```bash
php artisan db:seed --class=AdminSeeder
```

email: admin@gmail.com
password: admin1234
