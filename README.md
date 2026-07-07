# Authentication Server API

Authentication Server API adalah REST API yang dibangun menggunakan Laravel 12 dan Laravel Sanctum. API ini menyediakan fitur autentikasi pengguna, manajemen profil, role (Admin & User), serta CRUD User yang hanya dapat diakses oleh Admin.

---

## Fitur

- Register
- Login
- Logout
- User Profile
- Update Profile
- Role (Admin & User)
- CRUD User (Admin Only)
- Authentication menggunakan Laravel Sanctum
- Validasi Request
- Response API Konsisten
- Pagination
- Search
- Sorting

---

## Teknologi

- PHP 8.2+
- Laravel 12
- MySQL
- Laravel Sanctum
- Postman

---

## Instalasi

### 1. Clone Repository

```bash
git clone <repository-url>
```

### 2. Masuk ke Folder Project

```bash
cd authentication-api
```

### 3. Install Dependency

```bash
composer install
```

### 4. Copy File Environment

```bash
cp .env.example .env
```

Atau di Windows:

```bash
copy .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=authentication_api
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan dengan database yang digunakan.

---

## Migrasi Database

```bash
php artisan migrate
```

---

## Seeder Admin

```bash
php artisan db:seed
```

Seeder akan membuat akun admin:

Email:

```text
admin@example.com
```

Password:

```text
password
```

---

## Menjalankan Server

```bash
php artisan serve
```

Server berjalan pada:

```text
http://127.0.0.1:8000
```

---

## Authentication

API menggunakan Laravel Sanctum.

Login terlebih dahulu untuk mendapatkan Bearer Token.

Masukkan token pada Header:

```
Authorization: Bearer {token}
```

---

## Endpoint

### Authentication

| Method | Endpoint | Keterangan |
|---------|----------|------------|
| POST | /api/register | Register |
| POST | /api/login | Login |
| GET | /api/profile | Profile |
| PUT | /api/profile | Update Profile |
| POST | /api/logout | Logout |

---

### User (Admin)

| Method | Endpoint | Keterangan |
|---------|----------|------------|
| GET | /api/users | List User |
| GET | /api/users/{id} | Detail User |
| POST | /api/users | Tambah User |
| PUT | /api/users/{id} | Update User |
| DELETE | /api/users/{id} | Hapus User |

---

## Search

Contoh:

```text
GET /api/users?search=admin
```

---

## Sorting

Contoh:

```text
GET /api/users?sort=name&order=asc
```

atau

```text
GET /api/users?sort=name&order=desc
```

---

## Pagination

Contoh:

```text
GET /api/users?page=1
```

---

## Dokumentasi API

Import file Postman Collection:

```
Authentication Server API.postman_collection.json
```

menggunakan aplikasi Postman.

---

## Author

Dibuat sebagai project PKL di PT Dahana menggunakan Laravel 12.