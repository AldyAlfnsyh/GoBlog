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

### 1. Clone Repository

```bash
git clone https://github.com/username/goblog.git
cd goblog
```

### 2. Install Dependency

```bash
composer install
npm install
```

### 3. Salin File .env

```bash
cp .env.example .env
```

### 4. Generate App Key

```bash
php artisan key:generate
```

### 5. Setup Database

buka file .env lalu cocokkan seperti ini

```
DB_DATABASE=goblog
DB_USERNAME=root
DB_PASSWORD=
```

lalu buat databse di MySQL menggunakan query berikut

```
create database goblog
```

### 7. Run Migrate

```bash
php artisan migrate
```

### 8. Run The Application

run build frontend

```bash
npm run dev
```

run server

```bash
php artisan serve
```

lalu copy [htttp://127.0.0.1:8000] ke browser

### 9. Akun Admin (Akses Panel Admin)

```bash
php artisan db:seed --class=AdminSeeder
```

email: admin@gmail.com
password: admin1234
