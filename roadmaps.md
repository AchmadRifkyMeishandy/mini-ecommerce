# Mini E-Commerce PHP — Roadmap Utama

> **Tujuan dokumen:** menjadi sumber acuan utama selama membangun Mini E-Commerce dengan PHP native, OOP, MVC sederhana, MySQL, Web API, Git, pengujian, keamanan, performa, dan deployment. Baca bagian **Status Saat Ini** dan **Langkah Berikutnya** sebelum melanjutkan sesi belajar. Jangan melompat ke fase berikutnya sebelum checkpoint fase aktif berhasil.

## 1. Aturan belajar dan cara menggunakan roadmap

1. Kerjakan fase secara berurutan. Jika ada error, berhenti di sana dan selesaikan dulu; jangan menambah fitur baru sebelum alur yang sedang dikerjakan stabil.
2. Gunakan pendekatan **build → run/test → inspect → explain → commit**. Jangan hanya menyalin kode.
3. Untuk setiap potongan kode/perintah, jelaskan:
   - fungsi tiap baris dan simbol penting;
   - mengapa cara tersebut digunakan;
   - kapan pola/perintah itu berguna di proyek lain;
   - risiko umum dan cara memeriksanya.
4. Gunakan bahasa Indonesia yang santai, analogi sederhana, tetapi istilah teknis tetap tepat.
5. Berikan kode secukupnya untuk langkah aktif. Hindari mengganti seluruh file jika patch kecil cukup, kecuali memang lebih aman dan jelas untuk menggantinya.
6. Setelah perubahan kode, jalankan pemeriksaan yang relevan sebelum lanjut. Contoh: `php -l`, tes endpoint dengan `curl`, query verifikasi database, lalu `git diff`.
7. Sebelum commit: tinjau `git status`, `git diff --cached`, pastikan tidak ada rahasia, file sampah, atau file yang tidak berkaitan.
8. Jangan mengklaim pengujian berhasil sebelum pengguna menjalankannya atau output hasilnya benar-benar terlihat.
9. **Jangan menganggap API yang mengembalikan JSON otomatis aman.** Semua endpoint yang mengubah data harus divalidasi, menggunakan prepared statements, dan dilindungi autentikasi/otorisasi sebelum dibuka ke publik.
10. Catat progres dengan mencentang item yang benar-benar sudah berhasil dan perbarui bagian **Status Saat Ini** serta **Langkah Berikutnya**.

## 2. Tujuan akhir proyek

Membangun Mini E-Commerce sederhana tetapi memakai kebiasaan yang dapat dibawa ke pekerjaan profesional:

- Halaman katalog HTML yang mengambil data dari MySQL.
- Web API HTTP/JSON untuk membaca dan mengelola produk.
- CRUD yang benar: GET, POST, PUT/PATCH, DELETE.
- Database relasional dan SQL JOIN.
- PHP OOP Level 1, Level 2, dan Level 3 dipelajari melalui kebutuhan nyata.
- Struktur MVC sederhana dan pemisahan tanggung jawab.
- Validasi input, prepared statements, escaping output, error handling, autentikasi/otorisasi, dan perlindungan endpoint tulis.
- Git lokal dan GitHub/remote dengan commit yang jelas.
- Pengukuran performa dasar, index yang masuk akal, pagination, dan penghindaran query berulang.
- Pengujian alur penting.
- Deployment ke lingkungan produksi PHP/MySQL dengan document root ke `public`, konfigurasi rahasia di environment, HTTPS, backup, dan langkah rilis yang dapat diulang.

**Batas lingkup:** bangun fitur minimum yang berfungsi dan aman terlebih dahulu. Tidak perlu membuat sistem enterprise, microservices, repository pattern generik, atau abstraksi berlebihan demi terlihat canggih. Fitur pesanan/checkout dibangun setelah katalog, CRUD, keamanan, dan API stabil.

## 3. Teknologi dan lingkungan

- OS pengguna: Windows.
- Local development: Laragon.
- Terminal: VS Code integrated terminal, Git Bash.
- PHP yang terlihat di output server: PHP 8.3.25.
- Database: MySQL/MariaDB lokal melalui Laragon.
- Database proyek: `mini_ecommerce`.
- Kode: PHP native, PDO, HTML, SQL.
- Versi kontrol: Git lokal.
- Pengujian HTTP: `curl` dan browser.
- Framework: belum memakai Laravel; proyek ini sengaja memakai PHP native untuk memahami fondasi MVC dan OOP.

## 4. Status Saat Ini — fakta terakhir yang sudah berhasil

### Berhasil

- [x] Laragon/MySQL berjalan dan database `mini_ecommerce` berhasil dibuat.
- [x] File `database/schema.sql` membuat tabel `categories` dan `products`.
- [x] File `database/seed.sql` menyiapkan data awal.
- [x] Tabel `categories` berisi kategori ID `1` = `Sepatu` dan ID `2` = `Kaos`.
- [x] Tabel `products` memiliki tiga produk aktif:
  - ID `1`: Sneakers Hitam, kategori Sepatu, harga 350000, stok 10.
  - ID `2`: Sepatu Lari, kategori Sepatu, harga 425000, stok 8.
  - ID `4`: Kaos Polos, kategori Kaos, harga 85000, stok 25.
- [x] Kesalahan awal kategori sudah diperbaiki: `Sepatu Lari` menggunakan `category_id = 1`, `Kaos Polos` menggunakan `category_id = 2`.
- [x] SQL `JOIN` untuk menggabungkan produk dan nama kategori berhasil.
- [x] `app/Models/Product.php` memiliki class `App\Models\Product`, constructor dengan PDO, dan method `allActive()`.
- [x] Pemeriksaan `php -l app/Models/Product.php` berhasil.
- [x] `config/database.php` berhasil membuat koneksi PDO; tes terminal menampilkan `Connected to: mysql`.
- [x] Objek Model berhasil diuji langsung lewat `php -r` dan mengembalikan array tiga produk.
- [x] Halaman HTML `/products` pernah berhasil menampilkan tiga produk di browser.
- [x] Git diinisialisasi. Commit pertama: `55f469d chore: add database schema and seed files`.
- [x] `curl -i http://127.0.0.1:8000/api/products` berhasil mengembalikan `HTTP/1.1 200 OK`, `Content-Type: application/json; charset=utf-8`, dan tiga produk dengan `category_name`.
- [x] API saat ini menggunakan PHP native, routing manual, Controller, Model, PDO, dan `json_encode()`.

### Perhatian / belum terverifikasi

- [ ] Periksa `git status` saat ini. Commit `55f469d` hanya mencatat `.gitignore`, `database/schema.sql`, dan `database/seed.sql`; file PHP yang dibuat setelahnya mungkin masih untracked atau modified.
- [ ] Pastikan kapitalisasi dan lokasi file konsisten sebelum deployment. Target standar yang disepakati:
  - `app/Controllers/ProductController.php`
  - `app/Models/Product.php`
  - `app/Views/products/index.php`
  - `config/database.php`
  - `database/schema.sql`
  - `database/seed.sql`
  - `public/index.php`
  Windows sering tidak membedakan huruf besar/kecil dalam path, sedangkan Linux biasanya membedakannya. Pastikan `ProductController.php` memakai `require __DIR__ . '/../Views/products/index.php';` jika lokasi View memang `app/Views/products/index.php`.
- [ ] Pastikan `public/index.php` memuat class, menentukan `$path` dan `$method`, kemudian menangani `GET /api/products` dan `GET /products` sebelum fallback 404.
- [ ] Pastikan server dev masih berjalan sebelum menguji `curl`; bila `curl` mengatakan connection refused, jalankan server lagi.
- [ ] Belum ada endpoint API detail, POST, PUT/PATCH, atau DELETE.
- [ ] Belum ada autentikasi/otorisasi untuk operasi yang mengubah data.
- [ ] Belum ada konfigurasi `.env` yang benar-benar dimuat; `getenv()` di `config/database.php` hanya membaca environment variable proses. Jangan menganggapnya otomatis membaca file `.env`.
- [ ] Belum ada proses deploy; server bawaan `php -S` hanya untuk pengembangan lokal.

## 5. Struktur folder target

Gunakan struktur sederhana berikut; tidak harus membuat semua file/folder sekaligus. Buat saat fase terkait membutuhkannya.

```text
mini-ecommerce/
├── app/
│   ├── Controllers/
│   │   └── ProductController.php
│   ├── Models/
│   │   └── Product.php
│   ├── Services/                 # tambah bila logika bisnis perlu dipisah
│   └── Views/
│       └── products/
│           └── index.php
├── config/
│   └── database.php
├── database/
│   ├── schema.sql
│   └── seed.sql
├── public/
│   └── index.php                 # front controller; satu pintu masuk HTTP
├── tests/                        # ditambahkan bertahap bila diperlukan
├── .gitignore
└── roadmaps.md
```

## 6. Roadmap berurutan sampai deployment

### Fase 0 — Stabilkan baseline proyek

- [ ] Jalankan `git status --short --untracked-files=all` dan pahami setiap file yang belum dilacak.
- [ ] Periksa isi `.gitignore`; rahasia, `.env`, log, dependensi, dan file lokal tidak boleh masuk repo.
- [ ] Pastikan nama folder/file serta path `require` konsisten, terutama `Views/products/index.php`.
- [ ] Jalankan `php -l` pada semua file PHP yang dibuat.
- [ ] Uji `GET /products` dan `GET /api/products`.
- [ ] Catat baseline Git yang bersih dan commit pekerjaan PHP jika aman.

**Checkpoint:** halaman HTML dan API daftar produk sama-sama bekerja; tidak ada rahasia di Git; path konsisten.

### Fase 1 — SQL dan endpoint detail produk

- [ ] Pelajari ulang SQL `SELECT`, `WHERE`, alias tabel, `INNER JOIN`, `ORDER BY`, dan cara membaca hasil.
- [ ] Tambahkan `findActiveById(int $id): ?array` ke Model.
- [ ] Gunakan PDO prepared statement (`prepare`, `execute`, `fetch`) untuk ID dari URL.
- [ ] Tambahkan route `GET /api/products/{id}` dengan pencocokan path yang jelas.
- [ ] Kembalikan JSON dan status `200` jika ada; `404` bila produk aktif tidak ditemukan; `400` bila format ID invalid sesuai desain route.
- [ ] Cek input ID dan jangan menyusun SQL dengan menggabungkan input mentah.
- [ ] Uji ID valid, ID yang tidak ada, ID nonangka, dan path yang tidak cocok dengan `curl`.

**Checkpoint:** endpoint daftar dan detail berjalan; input route tidak langsung ditempel ke SQL.

### Fase 2 — OOP Level 1 diperkuat lewat kode

- [x] Class dan object telah dipakai (`Product`, `ProductController`).
- [x] Property dan method telah dipakai (`$db`, `$productModel`, `allActive()`, `index()`, `apiIndex()`).
- [x] Constructor, `public`, `private`, `final`, namespace, dan type declaration telah diperkenalkan.
- [x] `return`, `$this`, operator `->`, dan objek PDO/PDOStatement telah dibahas.
- [ ] Ulangi secara praktis: bedakan class dengan object, property dengan local variable, dan method dengan function biasa.
- [ ] Praktikkan constructor, visibility, return type, nullable return (`?array`), dan exception handling dalam endpoint detail.

**Checkpoint:** pengguna mampu menjelaskan alur satu object dan mengapa Model menerima PDO lewat constructor.

### Fase 3 — CRUD Web API

- [ ] Standarkan respons JSON: bentuk success/error, `Content-Type`, dan status HTTP.
- [ ] **GET** `/api/products` — sudah ada; pertahankan agar tidak rusak.
- [ ] **GET** `/api/products/{id}` — fase sebelumnya.
- [ ] **POST** `/api/products` — baca JSON request, validasi `name`, `slug`, `price`, `stock`, dan `category_id`; gunakan prepared statement; tangani slug duplikat; kembalikan `201 Created` dengan data yang relevan.
- [ ] **PUT** `/api/products/{id}` — buat aturan penggantian representasi data yang konsisten dan validasi field yang diwajibkan.
- [ ] **PATCH** `/api/products/{id}` — opsional setelah PUT; ubah hanya field yang dikirim dan validasi tiap field.
- [ ] **DELETE** `/api/products/{id}` — pastikan ID valid, tangani data yang tidak ada, dan tetapkan respons yang konsisten.
- [ ] Batasi nilai harga/stok yang tidak masuk akal dan pastikan `category_id` memang merujuk kategori yang ada.
- [ ] Jangan mengaktifkan endpoint tulis secara publik sebelum autentikasi/otorisasi ditambahkan.
- [ ] Uji request sukses, input invalid, slug duplikat, ID tidak ada, JSON malformed, dan metode HTTP yang salah.

**Checkpoint:** semua operasi CRUD bekerja melalui API, menggunakan prepared statements, validasi server-side, dan output/error yang konsisten.

### Fase 4 — OOP Level 2 di kebutuhan nyata

- [x] Composition dan dependency injection telah dipakai antara PDO → Model → Controller.
- [ ] Jelaskan perbedaan composition, dependency injection, dan inheritance dengan contoh proyek kita.
- [ ] Tambahkan layer service hanya bila ada aturan bisnis yang perlu dipisahkan dari Controller/Model.
- [ ] Buat contoh `interface` yang punya tujuan nyata, misalnya kontrak untuk strategi diskon atau layanan pembayaran simulasi; jangan mengintegrasikan gateway pembayaran sungguhan hanya untuk latihan.
- [ ] Buat dua implementasi sederhana dari interface dan gunakan polymorphism melalui kontrak yang sama.
- [ ] Pelajari prinsip SOLID secukupnya melalui contoh dan refactor kecil; hindari abstraksi yang belum dibutuhkan.

**Checkpoint:** pengguna dapat menjelaskan kapan interface/DI/composition mengurangi coupling, dan dapat menunjuk bagian kode yang menggunakannya.

### Fase 5 — OOP Level 3 tanpa overengineering

- [ ] **Inheritance:** contoh singkat dengan hubungan “is-a” yang benar; bandingkan dengan composition.
- [ ] **Abstract class:** gunakan bila class turunan memang berbagi dasar implementasi dan abstract class tidak perlu dibuat sebagai objek langsung.
- [ ] **Static method/property:** pahami perbedaan state objek dan state/method milik class; gunakan hanya saat tepat.
- [ ] **Traits:** pahami penggunaan ulang method pada class yang tidak memiliki hubungan inheritance; hindari traits hanya untuk memecah satu class secara asal.
- [ ] Untuk tiap konsep, buat contoh kecil terpisah atau gunakan pada fitur bila ada kebutuhan; jangan memaksa semua fitur proyek menggunakannya.

**Checkpoint:** mampu menjelaskan kapan konsep bermanfaat dan kapan lebih baik tidak menggunakannya.

### Fase 6 — Keamanan dan error handling

- [ ] Prepared statements untuk semua SQL yang memakai input eksternal.
- [ ] Validasi data pada server; jangan hanya mengandalkan validasi JavaScript/browser.
- [ ] `htmlspecialchars()` saat menampilkan data tidak tepercaya di konteks HTML teks; jangan mencampur konteks HTML, atribut, URL, dan JavaScript tanpa encoding yang sesuai.
- [ ] Tangani `PDOException`, `JsonException`, dan error tak terduga; log detail internal tetapi kirim pesan aman ke client.
- [ ] Jangan menampilkan stack trace, password, DSN sensitif, atau query rinci ke pengguna produksi.
- [ ] Siapkan konfigurasi environment nyata; bila memilih `.env`, pasang dan konfigurasi loader yang sesuai, lalu pastikan `.env` diabaikan Git dan `.env.example` hanya berisi placeholder.
- [ ] Buat autentikasi untuk admin dan otorisasi per operasi sebelum endpoint POST/PUT/PATCH/DELETE dibuka.
- [ ] Bila menggunakan sesi/cookie pada UI admin, tambahkan proteksi CSRF, pengaturan cookie yang sesuai, dan `password_hash()` / `password_verify()` untuk password.
- [ ] Tetapkan metode HTTP dan status error secara konsisten.
- [ ] Jangan membocorkan versi PHP melalui header produksi bila tidak diperlukan.

**Checkpoint:** endpoint tulis tidak bisa dipakai tanpa izin yang sesuai; data input diuji dan rahasia tidak ada di repository/respons.

### Fase 7 — Browser, form, dan UX katalog

- [ ] Rapikan halaman produk dan tampilkan kategori.
- [ ] Tambahkan detail produk serta pagination untuk katalog.
- [ ] Buat form admin untuk tambah/edit produk jika diperlukan; validasi server-side tetap wajib.
- [ ] Tampilkan feedback sukses/error tanpa menampilkan detail internal.
- [ ] Pertimbangkan pola Post/Redirect/Get untuk pengiriman form HTML agar refresh tidak mengirim ulang form.

**Checkpoint:** pengguna dapat melihat katalog dengan baik, admin yang terautentikasi dapat mengelola data melalui antarmuka, dan error dipresentasikan dengan aman.

### Fase 8 — Performa dan observability

- [ ] Pilih kolom yang diperlukan; hindari `SELECT *` tanpa alasan.
- [ ] Pahami index yang sudah ada (`idx_products_active_id`, `category_id`) dan cek query plan dengan `EXPLAIN` sebelum menambah index baru.
- [ ] Ukur query dan response time sebelum mengoptimasi; jangan menebak bottleneck.
- [ ] Tambahkan pagination pada katalog/API list untuk mencegah mengirim terlalu banyak data sekaligus.
- [ ] Pahami N+1 query dan eager loading sebagai konsep; gunakan JOIN/strategi yang tepat dengan jumlah query terukur.
- [ ] Cache hanya bila ada kebutuhan terukur dan aturan invalidasi jelas.
- [ ] Tambahkan logging yang berguna tanpa merekam password, token, atau data sensitif.

**Checkpoint:** ada bukti dasar pengukuran sebelum/sesudah dan query/result set tidak tumbuh tanpa batas.

### Fase 9 — Orders dan checkout sederhana (setelah katalog stabil)

- [ ] Rancang dan tinjau skema `users`, `orders`, dan `order_items` sebelum mengeksekusi migration/SQL.
- [ ] `orders` menyimpan informasi utama pesanan, sedangkan `order_items` menyimpan produk, kuantitas, dan snapshot harga per unit.
- [ ] Gunakan foreign key, tipe data uang `DECIMAL`, validasi quantity, dan status order yang jelas.
- [ ] Proses checkout dalam transaksi database: periksa stok, buat order dan item, kurangi stok, lalu commit; rollback jika ada kegagalan.
- [ ] Cegah stok menjadi negatif dan pahami kondisi race/concurrency pada pembelian bersamaan.
- [ ] Jangan percaya total harga dari client; hitung ulang harga dan total di server berdasarkan data database.
- [ ] Uji checkout sukses, stok tidak cukup, produk tidak aktif, input tidak valid, dan rollback.

**Checkpoint:** order dan item konsisten, harga diambil/dihitung di server, dan kegagalan tidak meninggalkan perubahan sebagian.

### Fase 10 — Git dan kerja tim

- [x] Repo lokal diinisialisasi.
- [x] Commit awal `55f469d` dibuat dengan pesan `chore: add database schema and seed files`.
- [ ] Periksa status dan commit semua file PHP yang layak setelah review.
- [ ] Pelajari `git status`, `git diff`, `git diff --cached`, `git add`, `git commit`, `git log`, `git restore`, dan cara membatalkan commit secara aman.
- [ ] Gunakan branch fitur saat perubahan mulai lebih besar; pelajari merge dan konflik sederhana.
- [ ] Buat Git remote/GitHub hanya setelah memeriksa `.gitignore` dan memastikan tidak ada rahasia. Jangan pernah mengunggah `.env` nyata atau kredensial.
- [ ] Tulis README: tujuan proyek, kebutuhan, setup lokal, database, menjalankan aplikasi, endpoint, pengujian, dan catatan keamanan.

**Checkpoint:** repo dapat dikloning/di-setup ulang mengikuti dokumentasi tanpa bergantung pada catatan pribadi yang tidak tersimpan.

### Fase 11 — Pengujian akhir sebelum rilis

- [ ] Jalankan `php -l` pada seluruh file PHP yang relevan.
- [ ] Uji halaman `/products` dan endpoint API dengan `curl`.
- [ ] Uji semua CRUD, validasi, otorisasi, status code, dan kasus error.
- [ ] Uji database dari skema kosong menggunakan file setup/seed yang telah diperbaiki atau prosedur migration yang disepakati.
- [ ] Pastikan URL/path dan kapitalisasi file bekerja pada filesystem case-sensitive.
- [ ] Tinjau `git status`, `.gitignore`, rahasia, logging, error display, dan konfigurasi produksi.
- [ ] Pastikan backup/restore database direncanakan.

### Fase 12 — Deployment produksi

- [ ] Pilih target hosting sesuai akses/kebutuhan pengguna (misalnya shared hosting PHP/MySQL atau VPS). Pilihan final baru ditetapkan saat kondisi hosting diketahui.
- [ ] Pisahkan konfigurasi development dan production; rahasia diberikan lewat environment/config server, tidak disimpan di Git.
- [ ] Pastikan document root menunjuk ke `public/`, bukan root repository yang berisi `app/`, `config/`, dan file internal.
- [ ] Konfigurasikan PHP yang didukung hosting dan ekstensi PDO MySQL.
- [ ] Siapkan database dan akun produksi dengan hak minimum yang diperlukan; hindari akun `root` untuk aplikasi.
- [ ] Upload/deploy versi yang sudah ditinjau melalui Git atau mekanisme hosting yang aman.
- [ ] Jalankan skema/migration dan seed yang sesuai secara hati-hati; jangan menjalankan seed demo di atas data produksi tanpa pemeriksaan.
- [ ] Aktifkan HTTPS, redirect HTTP→HTTPS, dan pengaturan cookie/security yang sesuai.
- [ ] Matikan display error kepada publik; aktifkan logging yang aksesnya dibatasi.
- [ ] Uji smoke test di domain produksi: halaman katalog, API GET, autentikasi, operasi admin yang diizinkan, dan koneksi database.
- [ ] Buat backup awal dan dokumentasikan prosedur rollback.
- [ ] Catat alamat deployment, versi/commit yang dirilis, dan langkah pembaruan berikutnya.

**Checkpoint akhir:** aplikasi dapat dibangun dari repo, dikonfigurasi untuk server, diuji, dirilis, dipantau, dan dipulihkan bila ada masalah. Jangan menyebut aplikasi “siap produksi” sebelum checklist keamanan dan pengujian yang relevan selesai.

## 7. Status konsep OOP

| Konsep | Status | Rencana penerapan |
|---|---|---|
| Class/object | Sudah dipakai | `Product`, `ProductController` |
| Property/method | Sudah dipakai | `$db`, `$productModel`, `allActive()`, `index()`, `apiIndex()` |
| Constructor/visibility | Sudah dipakai | Constructor injection dan `private` |
| Namespace | Sudah dipakai | `App\Models`, `App\Controllers` |
| Type declarations | Sudah dipakai | `PDO`, `: array`, `: void`, `strict_types` |
| Encapsulation | Sudah dikenalkan | Properti koneksi `private` |
| Composition | Sudah dipakai | Controller menggunakan Model |
| Dependency injection | Sudah dipakai | PDO diberikan ke Model; Model diberikan ke Controller |
| Interface | Belum diterapkan | Contoh strategi diskon/pembayaran simulasi jika cocok |
| Polymorphism | Belum diterapkan | Beberapa implementasi dengan kontrak yang sama |
| Inheritance | Belum dipraktikkan | Contoh terbatas; bandingkan dengan composition |
| Abstract class | Belum dipraktikkan | Hanya jika ada abstraksi dasar yang nyata |
| Static | Belum dibahas tuntas | Jelaskan kapan tepat dan kapan hindari |
| Traits | Belum dipraktikkan | Demo kecil dan aturan menghindari penggunaan berlebihan |
| Exception handling | Belum lengkap | PDO/JSON errors, logging, respons aman |
| SOLID | Pengenalan saja | Hubungkan ke refactor nyata, tidak dihafal terpisah |

## 8. Aturan teknis penting

- Nama file/folder konsisten dan gunakan kapitalisasi yang akan bekerja pada Linux.
- Jangan memasukkan input pengguna langsung ke SQL; gunakan prepared statements.
- Gunakan `htmlspecialchars()` untuk teks tidak tepercaya dalam konteks HTML yang sesuai.
- Validasi dan otorisasi adalah dua hal berbeda: validasi memeriksa data; otorisasi memeriksa apakah peminta boleh melakukan tindakan.
- `GET` tidak boleh mengubah data. POST/PUT/PATCH/DELETE mengubah state dan harus dilindungi jika sensitif.
- Jangan melakukan checkout dengan total harga yang dikirim client tanpa menghitung ulang di server.
- Jangan memakai server bawaan `php -S` sebagai web server produksi.
- Jangan menyimpan rahasia dalam kode, file SQL demo, commit, atau repository publik.
- Setiap index harus punya alasan berdasarkan query dan pengukuran; index menolong pembacaan tertentu tetapi menambah biaya penulisan/penyimpanan.
- Cache bukan obat universal; ukur dulu dan tentukan cara invalidasi.
- Hindari membuat class/interface/abstract class/trait tanpa tujuan yang jelas.

## 9. Perintah sehari-hari yang kita gunakan

```bash
# Periksa status repo dan file untracked
 git status --short --untracked-files=all

# Lihat perubahan yang belum di-stage
 git diff

# Lihat perubahan yang sudah di-stage
 git diff --cached

# Periksa sintaks file PHP
 php -l app/Models/Product.php

# Tes daftar API ketika server lokal sedang berjalan
 curl -i http://127.0.0.1:8000/api/products

# Tes detail produk setelah endpoint dibuat
 curl -i http://127.0.0.1:8000/api/products/1
```

Perintah di atas adalah referensi; jalankan hanya pada fase yang sesuai. Jangan menambahkan spasi sebelum `git` saat menyalin jika terminal/lingkungan tidak menerimanya.

## 10. Status sesi dan langkah berikutnya

**Status terakhir yang telah dikonfirmasi:** `GET /api/products` sudah membalas `200 OK` dan JSON berisi tiga produk, termasuk `category_name`. Pengguna memahami dasar `json_encode()` secara konseptual. Pengguna meminta pembelajaran tetap lambat dan jelas, tetapi ingin pengerjaan efisien dan tidak melompat-lompat. Semua kode dan perintah harus diterangkan baris demi baris, fungsi, alasan, kapan dipakai lagi, dan kesalahan yang perlu dihindari.

**Langkah aktif berikutnya: Fase 0 — baseline dan konsistensi repo, kemudian Fase 1 — `GET /api/products/{id}`.**

1. Minta/cek output `git status --short --untracked-files=all`.
2. Periksa file tree/path `app/Views/products/index.php` dan sesuaikan kapitalisasi pada `ProductController`.
3. Periksa sintaks untuk file PHP yang sudah dibuat dan uji `/products` serta `/api/products`.
4. Jangan membuat POST/PUT/DELETE sebelum endpoint GET by ID, prepared statement, respons 404, dan pola error dipahami.
5. Setelah endpoint detail stabil, lanjutkan CRUD, keamanan, OOP sesuai kebutuhan, dan fase-fase berikutnya.

> Saat memulai sesi baru, gunakan dokumen ini untuk melanjutkan dari status terakhir. Jika status repository atau kode aktual berbeda dari roadmap, verifikasi output terbaru dan perbarui dokumen alih-alih berasumsi.
