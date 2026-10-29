
# Mini E-Commerce API

Aplikasi backend sederhana untuk mengelola data produk pada sistem mini e-commerce menggunakan PHP Native dan MySQL.

Project ini dikembangkan sebagai sarana pembelajaran pengembangan REST API, validasi data, pengelolaan database, penanganan error, serta penerapan alur kerja Git dan GitHub yang terstruktur.

## Fitur

- Menampilkan daftar produk yang aktif.
- Menampilkan detail produk berdasarkan ID.
- Menambahkan produk baru dengan validasi data.
- Memperbarui data produk yang masih aktif.
- Memvalidasi format dan isi permintaan JSON.
- Menggunakan PDO Prepared Statements untuk menjalankan query database.
- Menangani error menggunakan kode status HTTP yang sesuai.
- Memeriksa konflik slug dan kategori yang tidak ditemukan.
- Memisahkan kode berdasarkan tanggung jawab model, controller, validator, dan support.

## Teknologi yang Digunakan

- **PHP 8.3** — bahasa pemrograman backend.
- **MySQL** — sistem manajemen basis data.
- **PDO** — penghubung aplikasi PHP dengan database.
- **JSON** — format pertukaran data API.
- **Git** — pengelolaan versi kode.
- **GitHub** — penyimpanan repository dan kolaborasi melalui Pull Request.
- **Visual Studio Code** — editor kode.

## Struktur Proyek

```text
mini-ecommerce/
├── app/
│   ├── Controllers/
│   │   └── ProductController.php
│   ├── Models/
│   │   └── Product.php
│   ├── Support/
│   │   ├── HttpException.php
│   │   ├── JsonRequest.php
│   │   └── JsonResponse.php
│   └── Validators/
│       └── ProductValidator.php
├── config/
│   └── database.php
├── public/
│   └── index.php
└── README.md
```

## Persyaratan

Pastikan perangkat sudah memiliki:

- PHP 8.3 atau versi kompatibel.
- MySQL.
- Laragon atau lingkungan pengembangan PHP lainnya.
- Git.
- Terminal seperti Git Bash.

## Cara Menjalankan Proyek

### 1. Unduh repository

```bash
git clone https://github.com/AchmadRifkyMeishandy/mini-ecommerce.git
cd mini-ecommerce
```

### 2. Siapkan database

Jalankan MySQL melalui Laragon, kemudian buat database:

```sql
CREATE DATABASE mini_ecommerce;
```

Buat tabel `categories` dan `products` sesuai struktur database yang digunakan proyek ini. Tabel produk membutuhkan relasi ke tabel kategori.

Pastikan terdapat data kategori dan produk untuk pengujian API.

### 3. Atur koneksi database

Periksa file `config/database.php` dan sesuaikan konfigurasi koneksi dengan lingkungan lokal:

- Host database.
- Nama database.
- Username.
- Password.

Jangan menyimpan password atau kredensial database yang sensitif ke repository publik.

### 4. Jalankan server PHP

Dari direktori utama proyek, jalankan:

```bash
php -S 127.0.0.1:8000 -t public public/index.php
```

Server lokal dapat diakses melalui:

`http://127.0.0.1:8000`

Biarkan terminal tetap berjalan selama pengujian.

## Dokumentasi API

Alamat dasar API:

`http://127.0.0.1:8000`

| Metode | Endpoint | Fungsi |
|---|---|---|
| GET | `/api/products` | Menampilkan daftar produk aktif |
| GET | `/api/products/{id}` | Menampilkan detail produk |
| POST | `/api/products` | Menambahkan produk baru |
| PUT | `/api/products/{id}` | Memperbarui produk aktif |

### 1. Menampilkan daftar produk

```http
GET /api/products
```

Mengambil daftar produk yang berstatus aktif.

### 2. Menampilkan detail produk

```http
GET /api/products/13
```

Mengambil detail produk berdasarkan ID.

### 3. Menambahkan produk

```http
POST /api/products
Content-Type: application/json
```

Contoh isi permintaan:

```json
{
  "category_id": 2,
  "name": "Tas Baru",
  "slug": "tas-baru",
  "price": "150000.00",
  "stock": 10
}
```

### 4. Memperbarui produk

```http
PUT /api/products/13
Content-Type: application/json
```

Contoh menggunakan cURL:

```bash
curl -X PUT http://127.0.0.1:8000/api/products/13 \
  -H "Content-Type: application/json" \
  -d '{"category_id":2,"name":"Tas Terbaru","slug":"tas-terbaru","price":"155000.00","stock":12}'
```

Permintaan tersebut memperbarui kategori, nama, slug, harga, dan stok produk dengan ID `13`.

## Kode Status HTTP

| Kode | Arti |
|---|---|
| 200 | Permintaan berhasil |
| 201 | Data berhasil dibuat |
| 400 | Format permintaan tidak valid atau isi permintaan kosong |
| 404 | Endpoint atau produk tidak ditemukan |
| 409 | Terjadi konflik data, misalnya slug duplikat |
| 415 | Format Content-Type tidak didukung |
| 422 | Data tidak memenuhi validasi |
| 500 | Terjadi kesalahan internal server |

Kode status yang dikembalikan bergantung pada jenis permintaan dan hasil pemrosesan server.

## Struktur Kode

- **Models** — menangani interaksi dengan database.
- **Controllers** — mengatur alur permintaan dan respons API.
- **Validators** — memeriksa dan memvalidasi data masukan.
- **Support** — menyediakan fungsi pendukung, seperti membaca JSON, mengirim respons, dan menangani error.
- **Config** — menyimpan konfigurasi aplikasi, termasuk koneksi database.
- **Public** — menjadi titik masuk aplikasi dan menangani routing HTTP.

## Pengujian

Pengujian API dilakukan menggunakan cURL melalui terminal.

Beberapa skenario yang telah diuji:

- Mengambil detail produk berdasarkan ID.
- Memperbarui produk dengan data yang valid.
- Memastikan perubahan tersimpan dan dapat dibaca kembali.
- Menangani produk yang tidak ditemukan.
- Menolak harga negatif.
- Menangani slug yang duplikat.
- Menolak permintaan yang tidak menyertakan stok saat memperbarui produk.

## Alur Pengembangan

Pengembangan fitur menggunakan alur kerja Git dan GitHub:

1. Membuat issue untuk mendefinisikan pekerjaan.
2. Membuat branch khusus untuk fitur.
3. Mengimplementasikan perubahan kode.
4. Menguji fitur secara manual.
5. Melakukan commit dan push.
6. Membuat Pull Request untuk meninjau perubahan.
7. Menggabungkan perubahan ke branch utama setelah review.

## Tujuan Pembelajaran

Project ini dibuat untuk mempelajari:

- Dasar pengembangan REST API menggunakan PHP.
- Operasi CRUD pada database MySQL.
- Validasi input dan penanganan error.
- Penggunaan PDO Prepared Statements.
- Pemisahan tanggung jawab kode.
- Pengujian endpoint menggunakan cURL.
- Penggunaan Git dan GitHub dalam alur kerja pengembangan fitur.

## Pengembangan Selanjutnya

Beberapa pengembangan yang dapat dipertimbangkan:

- Autentikasi dan otorisasi API.
- Pengujian otomatis.
- Pagination dan pencarian produk.
- Dokumentasi API menggunakan OpenAPI.
- Konfigurasi environment yang lebih aman.
- Integrasi Continuous Integration (CI).

## Pengembang

**Achmad Rifky Meishandy**

GitHub: [AchmadRifkyMeishandy](https://github.com/AchmadRifkyMeishandy)
