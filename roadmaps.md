
# Mini E-Commerce PHP — Roadmap Utama (Versi Diperbarui)

> **Fungsi dokumen:** sumber acuan utama untuk melanjutkan project Mini E-Commerce dan proses belajar bersama AI sebagai mentor senior programmer. Baca bagian **Status Proyek Saat Ini** dan **Langkah Aktif Berikutnya** sebelum mulai bekerja. Roadmap ini menggantikan catatan fase lama yang sudah tidak sesuai dengan progres project.
>
> **Aturan inti:** selesaikan satu langkah, periksa hasilnya, pahami penyebabnya, baru lanjut. Jangan melompat ke fase lain hanya karena ada ide fitur baru.

---

## 1. Cara kerja mentor dan cara belajar

Asisten bertindak sebagai senior programmer yang membimbing developer junior: membantu membuat keputusan teknis, menjelaskan alasannya, memeriksa risiko, dan mengajari cara menemukan akar masalah — bukan sekadar memberikan kode.

Untuk setiap langkah:

1. **Jelaskan tujuan terlebih dahulu.** Terangkan masalah yang sedang diselesaikan dan kenapa langkah itu diperlukan.
2. **Satu langkah aktif dalam satu waktu.** Berikan satu perintah atau satu perubahan kecil terlebih dahulu, kecuali pengguna secara khusus meminta paket lengkap.
3. **Jelaskan kode dengan bahasa sederhana.** Jelaskan fungsi setiap baris atau kelompok baris, simbol penting (`$`, `->`, `::`, `=>`, `?`, `:`, `[]`, `{}`), alasan pemilihan pola, dan kesalahan umum yang perlu diwaspadai.
4. **Gunakan siklus kerja:** `pahami → ubah → jalankan → uji → periksa diff → jelaskan → commit`.
5. **Baca output sebelum melanjutkan.** Jangan menganggap perintah berhasil jika pengguna belum menunjukkan hasil atau hasilnya belum diverifikasi dengan alat yang tersedia.
6. **Cari akar masalah.** Jika error muncul, periksa pesan error, sintaks, alur data, database, dan konfigurasi. Jangan menambal gejala atau menambahkan kode duplikat hanya untuk menghilangkan garis merah editor.
7. **Utamakan perubahan kecil.** Jangan mengganti seluruh file jika patch kecil sudah cukup dan aman. Saat mengganti file penuh memang diperlukan, jelaskan alasannya.
8. **Jangan overengineering.** Jangan menambahkan framework, repository pattern, interface, service layer, cache, atau abstraksi hanya supaya terlihat canggih. Terapkan saat ada kebutuhan yang nyata.
9. **Bedakan validasi, keamanan, dan otorisasi.** Input yang valid belum tentu boleh dijalankan oleh semua orang.
10. **Verifikasi sebelum commit.** Tinjau `git status`, diff, hasil lint, dan tes relevan. Pastikan tidak ada kredensial atau file lokal yang ikut ter-commit.
11. **Perbarui roadmap.** Centang hanya pekerjaan yang benar-benar selesai dan terverifikasi. Catat keputusan, blocker, dan langkah berikutnya.
12. **Bahasa:** Indonesia santai dan mudah dimengerti; istilah teknis tetap akurat. Langsung ke inti tanpa menghilangkan penjelasan yang dibutuhkan pemula.

### Standar jawaban untuk perubahan kode

Setiap perubahan kode sebaiknya disertai:

- file dan bagian yang diubah;
- kode lengkap atau patch yang perlu diterapkan;
- penjelasan sederhana mengenai alur dan setiap bagian penting;
- perintah pemeriksaan yang relevan;
- kasus uji yang perlu dijalankan;
- hasil yang diharapkan;
- kapan perubahan aman untuk di-commit.

### Aturan klaim

- Jangan mengatakan “aman”, “lulus tes”, atau “siap produksi” hanya karena satu request berhasil.
- Jelaskan apakah hasilnya **sudah diverifikasi**, **belum diuji**, atau **baru berupa rencana**.
- HTTP `200` bukan bukti semua logika benar; periksa data akhir dan kasus gagal.
- Garis merah Intelephense tidak otomatis berarti sintaks PHP salah. Periksa `php -l`, pesan hover, namespace, tipe properti, dan cache editor.

---

## 2. Tujuan akhir project

Membangun mini e-commerce dengan PHP native yang cukup sederhana untuk dipahami, tetapi menerapkan kebiasaan yang berguna di pekerjaan profesional:

- katalog produk berbasis HTML;
- API HTTP/JSON untuk produk;
- operasi CRUD yang jelas dan konsisten;
- database relasional, foreign key, index, dan SQL JOIN;
- PHP OOP dengan pemisahan Model, Controller, Validator, dan Support;
- validasi server-side, prepared statements, escaping output, dan error handling;
- autentikasi dan otorisasi sebelum endpoint tulis digunakan oleh pihak lain;
- pengujian manual dan otomatis;
- workflow Git/GitHub berbasis issue, branch, commit, Pull Request, review, dan merge;
- CI untuk menjalankan pemeriksaan otomatis;
- pemahaman dasar performa, logging, backup, dan deployment.

### Batas lingkup

Bangun fondasi yang benar terlebih dahulu. Checkout, pembayaran, microservices, queue, cache kompleks, dan abstraksi generik bukan prioritas sampai katalog, API, validasi, keamanan, dan pengujian stabil. Pembayaran sungguhan tidak diperlukan untuk latihan dasar.

---

## 3. Lingkungan dan teknologi

- Sistem operasi: Windows.
- Lingkungan lokal: Laragon.
- Terminal: Git Bash atau terminal terintegrasi VS Code.
- PHP yang pernah terkonfirmasi: PHP 8.3.25.
- Database: MySQL/MariaDB lokal.
- Nama database: `mini_ecommerce`.
- Backend: PHP native, PDO, JSON, SQL.
- Struktur: routing manual, front controller, Model, Controller, Validator, Support.
- Pengujian HTTP manual: `curl`.
- Version control: Git dan GitHub.
- Framework: belum memakai framework; project ini bertujuan menguatkan fondasi PHP/OOP sebelum beralih ke framework.
- Composer/autoload: belum menjadi bagian inti workflow saat ini; pertimbangkan setelah struktur dan pengujian stabil, bukan secara otomatis.

### Perintah lokal yang sering digunakan

Jalankan perintah dari direktori utama repository, kecuali dijelaskan lain.

```bash
# Status seluruh perubahan, termasuk file yang belum dilacak
git status --short --untracked-files=all

# Melihat perubahan file yang belum masuk staging
git diff

# Melihat perubahan yang sudah masuk staging
git diff --cached

# Memeriksa sintaks satu file PHP
php -l app/Models/Product.php

# Menjalankan server pengembangan lokal
php -S 127.0.0.1:8000 -t public public/index.php

# Menguji daftar produk saat server aktif
curl -i http://127.0.0.1:8000/api/products

# Menguji satu produk saat endpoint tersedia
curl -i http://127.0.0.1:8000/api/products/13
```

Jalankan hanya perintah yang relevan dengan langkah aktif. Server `php -S` adalah server pengembangan, bukan pilihan untuk deployment produksi.

---

## 4. Status proyek saat ini

Bagian ini membedakan pekerjaan yang telah terkonfirmasi dari hal yang masih perlu diperiksa.

### Telah dibuat atau terkonfirmasi

- [x] Database `mini_ecommerce` digunakan dalam lingkungan lokal.
- [x] File SQL tersedia di repository: `database/schema.sql` dan `database/seed.sql`.
- [x] Tabel `categories` dan `products` terhubung melalui foreign key kategori.
- [x] `config/database.php` menyediakan koneksi PDO; `getenv()` membaca environment proses dan tidak otomatis memuat file `.env`.
- [x] `app/Models/Product.php` berisi akses data menggunakan PDO dan prepared statements.
- [x] Ada halaman katalog HTML `/products`.
- [x] API menggunakan front controller `public/index.php` dan routing manual.
- [x] Endpoint `GET /api/products` tersedia.
- [x] Endpoint `GET /api/products/{id}` tersedia.
- [x] Endpoint `POST /api/products` tersedia.
- [x] Endpoint `PUT /api/products/{id}` tersedia.
- [x] File pendukung tersedia: `app/Support/JsonRequest.php`, `JsonResponse.php`, dan `HttpException.php`.
- [x] `app/Validators/ProductValidator.php` memvalidasi data produk.
- [x] Fitur update memeriksa produk aktif, memvalidasi input, menangani slug duplikat dan kategori yang tidak ditemukan, lalu mengembalikan data terbaru.
- [x] Pembacaan JSON memeriksa content type dan menangani body kosong, JSON tidak valid, serta JSON yang bukan objek sesuai aturan implementasi.
- [x] Manual test sebelumnya telah mencakup update valid, ID tidak ditemukan, harga negatif, slug duplikat, stok wajib pada update, dan verifikasi bahwa data tidak berubah setelah request invalid.
- [x] Setelah PR fitur update di-merge, `GET /api/products/13` berhasil, `PUT /api/products/13` berhasil, dan GET ulang menunjukkan perubahan tersimpan.
- [x] Pull Request fitur update sudah di-merge ke `main`.
- [x] `README.md` sudah ditambahkan ke repository dan `main` telah diverifikasi sebagai default branch GitHub.

### Kondisi data pengujian yang pernah terlihat

Pada sesi uji lokal, produk ID `13` berhasil diperbarui menjadi `Tas Tes Main Branch`, harga `135000.00`, stok `9`, kategori `Kaos`. Ini adalah data uji lokal dan tidak boleh diasumsikan ada pada database baru yang dibuat dari seed.

### Belum selesai atau perlu diverifikasi ulang

- [ ] DELETE belum ditambahkan/terkonfirmasi.
- [ ] PATCH bersifat opsional dan belum menjadi bagian endpoint yang terkonfirmasi.
- [ ] Belum ada autentikasi/otorisasi yang melindungi endpoint tulis.
- [ ] Belum ada test suite otomatis yang terkonfirmasi.
- [ ] Belum ada CI workflow yang terkonfirmasi.
- [ ] `config/database.php` belum otomatis memuat `.env`; konfigurasi deployment belum selesai.
- [ ] Instruksi setup database di README perlu ditinjau agar mencerminkan file `database/schema.sql` dan `database/seed.sql` yang benar-benar tersedia.
- [ ] Struktur folder dan instruksi di README perlu dicocokkan sekali lagi dengan isi repository aktual, termasuk folder `Support`, `Validators`, `Views`, dan `database`.
- [ ] Status lokal setelah pekerjaan terakhir perlu diperiksa lewat `git status`; jangan menganggap working tree bersih tanpa hasil terbaru.
- [ ] Semua file PHP perlu diperiksa ulang dengan lint setelah perubahan berikutnya.
- [ ] Belum ada deployment produksi.
- [ ] Tambahkan endpoint `DELETE /api/products/{id}` menggunakan soft delete.
- [ ] Tambahkan method Model untuk menonaktifkan produk aktif.
- [ ] Produk yang tidak ditemukan atau sudah nonaktif harus ditangani secara konsisten.
- [ ] Pastikan produk nonaktif tidak muncul di GET daftar produk.
- [ ] Pastikan GET detail produk nonaktif menghasilkan 404.
- [ ] Pastikan record masih tersimpan di database dengan `is_active = 0`.
- [ ] Uji seluruh skenario DELETE menggunakan cURL.

### Struktur repository saat ini

```text
mini-ecommerce/
├── app/
│   ├── Controllers/
│   ├── Models/
│   ├── Support/
│   ├── Validators/
│   └── Views/
├── config/
│   └── database.php
├── database/
│   ├── schema.sql
│   └── seed.sql
├── public/
│   └── index.php
├── .gitignore
├── README.md
└── roadmaps.md
```

Daftar file di setiap subfolder `app/` harus diperiksa dari repository saat mengerjakan tugas yang menyangkut path tertentu; jangan mengandalkan diagram ini untuk nama file yang tidak ditampilkan.

---

## 5. Fase aktif dan langkah berikutnya

### Fase A — Menyelaraskan dokumen dan keadaan project

**Status: sedang berlangsung.** README sudah dipasang di GitHub, dan roadmap ini memperbarui catatan progres lama.

- [ ] Simpan versi roadmap ini sebagai `roadmaps.md` menggantikan roadmap lama setelah ditinjau.
- [ ] Periksa `git status --short --untracked-files=all` sebelum perubahan berikutnya.
- [ ] Cocokkan README dengan struktur repository aktual.
- [ ] Perbaiki bagian setup database README agar menyebut cara memakai `database/schema.sql` dan `database/seed.sql`; jelaskan urutan import yang tepat setelah memeriksa isi kedua file.
- [ ] Pastikan contoh payload dan endpoint dalam README sesuai dengan validator dan controller aktual.
- [ ] Pastikan README tidak menjanjikan fitur yang belum ada.
- [ ] Jalankan `git diff --check`, lalu tinjau diff sebelum commit.

**Checkpoint:** README dan roadmap menyatakan kondisi yang sama dengan kode, skema SQL, dan route saat ini.

### Fase B — Baseline teknis dan pengecekan kualitas

- [ ] Jalankan status Git dan periksa apakah ada file lokal yang belum di-commit.
- [ ] Pastikan `.gitignore` mengecualikan rahasia, file lokal, log, dan file sampah.
- [ ] Jalankan `php -l` pada seluruh file PHP yang relevan.
- [ ] Uji `GET /products` di browser.
- [ ] Uji `GET /api/products` menggunakan `curl`.
- [ ] Uji `GET /api/products/{id}` untuk ID ada dan tidak ada.
- [ ] Tinjau keseragaman nama file dan path `require`; perhatikan perbedaan kapitalisasi ketika project dijalankan di Linux.
- [ ] Pastikan kredensial dan informasi sensitif tidak ada dalam Git.

**Checkpoint:** aplikasi lokal masih berjalan, daftar produk dan halaman HTML tidak rusak, lint bersih, serta tidak ada perubahan tak disengaja.

### Fase C — Lengkapi dan tetapkan kontrak CRUD

**Yang sudah tersedia:** GET list, GET detail, POST, PUT.

- [ ] Tinjau setiap route dan pastikan metode HTTP serta pola URL tidak saling bertabrakan.
- [ ] Dokumentasikan request body, respons sukses, status error, dan field wajib setiap endpoint.
- [ ] Pastikan POST menggunakan status `201 Created` bila pembuatan berhasil dan menghasilkan identitas/data yang relevan.
- [ ] Tetapkan makna PUT secara konsisten: field apa yang wajib dikirim dan apakah PUT mengganti semua field yang dapat diedit.
- [ ] Pastikan validasi Controller dan Validator tidak saling bertentangan.
- [ ] Pastikan tipe/format data sesuai skema DB: kategori harus ada, harga tidak negatif, stok bilangan bulat nonnegatif, slug unik, panjang nama/slug tidak melebihi kolom.
- [ ] Tambahkan endpoint DELETE hanya setelah kontrak respons disepakati; pertimbangkan perbedaan penghapusan fisik dan penonaktifan produk (`is_active`).
- [ ] Tunda PATCH sampai perilaku PUT dipahami dan stabil. Jika ditambahkan, PATCH hanya mengubah field yang dikirim dan memvalidasi setiap field tersebut.
- [ ] Jangan membuka endpoint tulis ke publik sebelum autentikasi/otorisasi selesai.

**Checkpoint:** perilaku setiap metode HTTP jelas, konsisten, tervalidasi, dan terdokumentasi.

### Fase D — Pengujian API secara menyeluruh

Mulai dari pengujian manual terstruktur, kemudian otomatis.

#### Skenario GET

- [ ] GET list saat terdapat produk aktif.
- [ ] GET list jika tidak ada produk aktif.
- [ ] GET detail untuk ID valid.
- [ ] GET detail untuk produk yang tidak ada atau tidak aktif.
- [ ] ID URL bukan bilangan bulat yang valid.
- [ ] URL/method tidak dikenal menghasilkan status yang tepat.

#### Skenario POST

- [ ] Payload valid menghasilkan produk baru.
- [ ] Field wajib hilang.
- [ ] Nama kosong atau terlalu panjang.
- [ ] Slug tidak sesuai format atau duplikat.
- [ ] Harga negatif, bukan angka, atau presisi melewati aturan.
- [ ] Stok negatif atau bukan bilangan bulat.
- [ ] `category_id` tidak valid atau kategori tidak ada.
- [ ] Content-Type salah, body kosong, JSON rusak, dan JSON bukan objek.

#### Skenario PUT

- [x] Update valid diuji dan perubahan dibaca kembali.
- [x] ID tidak ditemukan pernah diuji.
- [x] Harga negatif pernah ditolak.
- [x] Slug duplikat pernah ditangani.
- [x] Stok wajib pada update pernah diverifikasi.
- [ ] Field wajib lain diuji secara terpisah.
- [ ] Kategori tidak ada diuji kembali setelah perubahan apa pun.
- [ ] Data sebelum dan sesudah request invalid dibandingkan untuk memastikan tidak berubah.
- [ ] Perilaku PUT terhadap field yang tidak dikirim dijelaskan dan konsisten.

#### Skenario DELETE jika endpoint dibuat

- [ ] ID valid mengembalikan respons yang disepakati.
- [ ] ID tidak ada tidak menghapus data lain.
- [ ] Penghapusan/penonaktifan mempertahankan integritas foreign key.
- [ ] Pengguna tanpa izin tidak dapat menghapus produk.

**Checkpoint:** kasus sukses dan gagal memiliki hasil yang dapat diprediksi. Tes tidak sekadar memeriksa adanya JSON; tes juga memeriksa status HTTP dan efek pada database.

### Fase E — OOP dan alur request yang dikuasai

Materi dipelajari langsung dari project, bukan menghafal definisi.

- [x] Class/object: `Product`, `ProductController`.
- [x] Property/method, constructor, visibility, namespace, dan type declaration sudah digunakan.
- [x] Composition/dependency injection: Controller menggunakan Model, Model menerima PDO.
- [ ] Mampu menjelaskan alur request dari `public/index.php` → Controller → Validator/Request helper → Model → database → JsonResponse.
- [ ] Bedakan function biasa dengan method; property dengan local variable; object dengan class.
- [ ] Pahami `public`, `private`, `protected`, `final`, `static`, `readonly`, serta kapan masing-masing berguna.
- [ ] Pahami nullable type seperti `?array`, return type, parameter type, dan `declare(strict_types=1)`.
- [ ] Pahami exception: kapan dilempar, siapa yang menangani, dan perbedaan exception dengan respons HTTP.
- [ ] Pelajari interface dan polymorphism menggunakan contoh kecil dengan alasan nyata; tidak perlu memaksakan interface ke Model saat belum ada kebutuhan.
- [ ] Pelajari inheritance, abstract class, dan traits secara perbandingan dengan composition; jangan membuat hierarki yang tidak diperlukan.
- [ ] Kenali SOLID lewat refactor kecil saat ada masalah coupling atau tanggung jawab yang bercampur.

**Checkpoint:** pengguna dapat menjelaskan alur satu request dan alasan struktur kode tanpa hanya membaca nama file.

### Fase F — Keamanan aplikasi

- [ ] Prepared statements dipakai untuk semua query yang memuat input dari request.
- [ ] Validasi dilakukan di server, bukan hanya di browser.
- [ ] Otorisasi memeriksa apakah peminta boleh menjalankan tindakan; jangan menyamakan otorisasi dengan validasi input.
- [ ] Lindungi POST, PUT, PATCH, DELETE dengan autentikasi dan otorisasi sebelum aplikasi dipublikasikan.
- [ ] Jika membuat login, gunakan `password_hash()` dan `password_verify()`; jangan menyimpan password mentah.
- [ ] Jika memakai sesi/cookie untuk panel admin, atur cookie dengan benar dan tambahkan perlindungan CSRF.
- [ ] Escape output HTML yang tidak tepercaya dengan `htmlspecialchars()` pada konteks yang sesuai.
- [ ] Jangan tampilkan stack trace, query, DSN, password, atau pesan internal mentah ke client.
- [ ] Log detail error di sisi server tanpa mencatat password, token, atau data sensitif.
- [ ] Gunakan akun database dengan izin minimum; jangan menggunakan user `root` untuk aplikasi produksi.
- [ ] Tentukan konfigurasi environment. `getenv()` tidak otomatis membaca `.env`; jika memilih file `.env`, gunakan loader yang benar dan pastikan `.env` di-ignore Git.
- [ ] Sediakan `.env.example` hanya jika mekanisme `.env` benar-benar digunakan; isinya harus berupa placeholder, bukan kredensial nyata.
- [ ] Jangan mengandalkan CORS sebagai pengganti autentikasi/otorisasi.

**Checkpoint:** semua endpoint tulis dilindungi, input tidak langsung dipercaya, dan error/rahasia tidak bocor ke publik.

### Fase G — Test otomatis

Lakukan setelah kontrak endpoint dan validasi stabil.

- [ ] Pilih cara pengujian yang terukur; mulai dari tes sederhana dan hindari menambah dependency tanpa kebutuhan.
- [ ] Pertimbangkan PHPUnit dan Composer untuk test suite serta autoload setelah fondasi PHP native dipahami.
- [ ] Pisahkan database test dari database lokal yang berisi data belajar.
- [ ] Siapkan fixture/test data yang dapat dibuat ulang; jangan bergantung pada ID `13` atau data manual di luar seed.
- [ ] Uji validator: data valid dan kombinasi input invalid.
- [ ] Uji Model dengan database test atau pendekatan yang jelas untuk query/database.
- [ ] Uji endpoint: status code, JSON response, dan efek pada data.
- [ ] Pastikan test tidak menghapus/mengubah data penting pada database development.
- [ ] Jalankan seluruh test secara berulang; hasil harus konsisten.

**Checkpoint:** perubahan berikutnya bisa diperiksa otomatis, tanpa mengandalkan tes manual saja.

### Fase H — Git/GitHub dan kebiasaan kerja tim

- [x] Repository GitHub publik sudah tersedia.
- [x] Sudah memakai issue, feature branch, commit, Pull Request, review, dan merge.
- [x] README telah ditambahkan dan default branch GitHub adalah `main`.
- [ ] Pastikan pola branch fitur tetap menggunakan nama yang mudah dimengerti, misalnya `feature/12-product-delete` atau `fix/product-validation`.
- [ ] Gunakan pesan commit yang menggambarkan perubahan: `feat: add product delete endpoint`, `fix: reject invalid product stock`, `docs: clarify database setup`.
- [ ] Sebelum staging, periksa `git status` dan `git diff`.
- [ ] Gunakan `git diff --cached` untuk memastikan hanya file terkait yang akan di-commit.
- [ ] Pelajari `git log --oneline`, `git show`, `git restore`, `git switch`, `git pull`, dan penanganan konflik dengan contoh nyata.
- [ ] Jangan melakukan `git push --force` atau menghapus branch utama tanpa alasan dan pemahaman dampaknya.
- [ ] Untuk fitur baru, gunakan alur issue → branch → perubahan → tes → commit → push → PR → review → merge → verifikasi di main.

**Checkpoint:** riwayat perubahan dapat dipahami dan setiap fitur dapat dilacak dari tujuan hingga merge.

### Fase I — CI (Continuous Integration)

Mulai setelah test otomatis tersedia.

- [ ] Buat workflow GitHub Actions untuk memeriksa sintaks PHP.
- [ ] Jalankan test otomatis pada pull request dan push ke branch utama.
- [ ] Pin versi PHP yang dibutuhkan dan gunakan dependency yang dideklarasikan bila Composer telah dipakai.
- [ ] Pastikan CI tidak membutuhkan password database produksi atau secret tidak perlu.
- [ ] Tangani kegagalan CI sebelum merge; jangan mematikan pemeriksaan hanya agar PR hijau.

**Checkpoint:** pull request mendapat pemeriksaan otomatis yang konsisten.


### Fase J — Desain UI dan Admin Dashboard Manajemen Produk

**Tujuan:** membuat tampilan admin yang modern, minimalis, responsif, dan mudah digunakan.

#### Arah desain
- [ ] Tema terang dengan warna netral dan satu warna aksen.
- [ ] Sidebar navigasi di sebelah kiri.
- [ ] Topbar sederhana.
- [ ] Kartu ringkasan statistik.
- [ ] Tabel daftar produk yang rapi.
- [ ] Form tambah dan edit produk.
- [ ] Dialog konfirmasi sebelum menonaktifkan produk.
- [ ] Tampilan responsif untuk desktop dan mobile.

#### Halaman yang direncanakan
- [ ] Dashboard: total produk, produk aktif, dan produk nonaktif.
- [ ] Manajemen Produk: daftar produk, kategori, harga, stok, status, dan aksi.
- [ ] Tambah Produk.
- [ ] Edit Produk.
- [ ] Nonaktifkan Produk.
- [ ] Manajemen Kategori (tahap lanjutan).

#### Tahapan desain
- [ ] Buat wireframe sebelum menulis kode.
- [ ] Tinjau tampilan desktop dan mobile.
- [ ] Sepakati alur pengguna dan komponen UI.
- [ ] Implementasikan HTML, CSS, dan JavaScript secara bertahap.
- [ ] Hubungkan tampilan dengan API setelah autentikasi dan otorisasi siap.

#### Pembelajaran DSA pada dashboard
- [ ] Array dan associative array untuk menampung data produk.
- [ ] Linear search untuk memahami pencarian data.
- [ ] Filtering berdasarkan kategori dan status.
- [ ] Sorting berdasarkan nama, harga, atau stok.
- [ ] Pagination untuk data produk yang banyak.
- [ ] Memahami kompleksitas waktu dan ruang dari setiap pendekatan.

**Checkpoint:** dashboard sudah memiliki desain yang disepakati, alur pengelolaan produk jelas, dan endpoint tulis tetap dilindungi di server.


### Fase K — Performa dan observability

- [ ] Ukur waktu respons dan query sebelum mengoptimasi.
- [ ] Pilih kolom yang dibutuhkan; gunakan `SELECT *` hanya bila memang beralasan.
- [ ] Gunakan `EXPLAIN` untuk memahami query plan.
- [ ] Periksa index yang sudah ada sebelum membuat index tambahan.
- [ ] Tambahkan pagination pada daftar besar; jangan mengirim seluruh produk tanpa batas.
- [ ] Pelajari pola N+1 query: bukan semata-mata algoritma `O(n²)`, tetapi pola jumlah query yang bertambah mengikuti jumlah record/relasi.
- [ ] Tambahkan cache hanya bila ada bottleneck terukur dan strategi invalidasi yang jelas.
- [ ] Log error dan kejadian penting tanpa menyimpan informasi sensitif.

**Checkpoint:** setiap optimasi punya alasan dan cara mengukur apakah hasilnya benar-benar lebih baik.

### Fase L — Pengembangan model bisnis e-commerce

Tahap ini dilakukan setelah produk, API, keamanan, dan pengujian dasar stabil.

- [ ] Rancang kebutuhan dan alur bisnis sebelum menambah tabel.
- [ ] Pertimbangkan `users`, `orders`, dan `order_items` untuk simulasi pesanan.
- [ ] Tentukan relasi, foreign key, tipe data uang `DECIMAL`, status pesanan, dan aturan kuantitas.
- [ ] Hitung total harga di server berdasarkan harga di database; jangan mempercayai total dari client.
- [ ] Gunakan transaksi database untuk checkout: verifikasi stok, buat order dan item, kurangi stok, lalu commit.
- [ ] Gunakan rollback jika salah satu langkah gagal.
- [ ] Cegah stok negatif dan pelajari risiko transaksi yang berjalan bersamaan.
- [ ] Uji order valid, stok tidak cukup, produk tidak aktif, dan rollback.
- [ ] Pembayaran sungguhan di luar lingkup awal; jangan menyimpan data kartu pembayaran.

**Checkpoint:** data pesanan dan stok tetap konsisten meskipun terjadi kegagalan di tengah proses.

### Fase M — Persiapan deployment

- [ ] Tentukan hosting sesuai kebutuhan dan kemampuan yang tersedia.
- [ ] Gunakan konfigurasi khusus produksi dan simpan secret di environment/server, bukan Git.
- [ ] Atur document root agar menunjuk ke `public/`.
- [ ] Gunakan HTTPS.
- [ ] Matikan tampilan error detail kepada pengguna publik; gunakan logging terbatas.
- [ ] Gunakan user database dengan hak minimal dan kredensial non-default.
- [ ] Buat prosedur backup/restore dan rencana rollback.
- [ ] Jalankan lint, test, dan smoke test sebelum rilis.
- [ ] Jangan menjalankan seed demo pada database produksi tanpa pemeriksaan.
- [ ] Catat commit/versi yang dirilis dan langkah memperbarui aplikasi.

**Checkpoint akhir:** aplikasi dapat disiapkan ulang, dikonfigurasi, diuji, dirilis, dipantau, dan dipulihkan. Jangan menyebutnya siap produksi sebelum pemeriksaan keamanan dan pengujian yang relevan selesai.

---

## 6. Kontrak pengujian HTTP yang perlu dipertahankan

Status di bawah adalah panduan target; implementasi aktual harus diverifikasi dari Controller dan route sebelum menyatakan semua perilaku sudah sesuai.

| Situasi | Perilaku yang diharapkan |
|---|---|
| GET sukses | `200 OK` dan JSON sesuai kontrak |
| POST sukses | `201 Created` dan data/identitas baru |
| PUT sukses | `200 OK` dengan representasi produk terbaru, atau kontrak lain yang konsisten |
| ID tidak ditemukan | `404 Not Found` |
| JSON rusak atau body kosong | `400 Bad Request` jika sesuai kontrak request helper |
| Content-Type tidak didukung | `415 Unsupported Media Type` jika endpoint mensyaratkannya |
| Data JSON tidak lolos validasi | `422 Unprocessable Content` |
| Slug duplikat | `409 Conflict` |
| Kategori tidak ditemukan | respons validasi/konflik sesuai kontrak yang telah ditetapkan; jangan mengembalikan 500 untuk kesalahan input yang diketahui |
| Error internal tak terduga | `500 Internal Server Error` dengan pesan aman ke client dan detail di log server |
| Metode HTTP tidak didukung | `405 Method Not Allowed` jika route dikenali tetapi metodenya tidak didukung |

Jangan mengubah status code hanya untuk menyamai tabel ini tanpa memeriksa kontrak API yang sudah dipakai. Kalau kontrak memang perlu diubah, lakukan perubahan pada kode, tes, dan README secara bersamaan.

---

## 7. Checklist sebelum setiap commit

- [ ] `git status` hanya menampilkan perubahan yang memang diharapkan.
- [ ] `git diff` sudah dibaca.
- [ ] `git diff --cached` sudah diperiksa setelah staging.
- [ ] Lint PHP berhasil untuk file yang berubah.
- [ ] Tes relevan dijalankan dan hasil aktual diperiksa.
- [ ] Tidak ada kredensial, token, dump data sensitif, file log, atau file lokal yang ikut masuk.
- [ ] Nama file dan path konsisten, termasuk huruf besar/kecil.
- [ ] README dan roadmap diperbarui bila perilaku atau setup project berubah.
- [ ] Pesan commit menjelaskan perubahan, bukan hanya “update”.

---

## 8. Glosarium singkat

- **API:** pintu agar aplikasi lain dapat meminta atau mengubah data dengan aturan yang disepakati.
- **Endpoint:** alamat dan metode HTTP tertentu, misalnya `GET /api/products`.
- **Request:** permintaan masuk dari client ke server.
- **Response:** jawaban yang dikirim server kepada client.
- **Controller:** bagian yang mengatur alur request dan response.
- **Model:** bagian yang berinteraksi dengan data/database.
- **Validator:** bagian yang memeriksa apakah input memenuhi aturan.
- **Prepared statement:** cara menyiapkan query lalu memasukkan nilai secara terpisah, sehingga input tidak ditempel langsung ke SQL.
- **Authentication:** memeriksa siapa peminta.
- **Authorization:** memeriksa tindakan apa yang boleh dilakukan peminta.
- **Regression:** kerusakan fitur lama akibat perubahan baru.
- **Automated test:** kode/perintah yang memeriksa perilaku secara otomatis dan berulang.
- **CI:** sistem yang menjalankan pemeriksaan otomatis saat ada perubahan kode.
- **Refactor:** merapikan struktur kode tanpa sengaja mengubah perilaku yang terlihat.
- **Overengineering:** membuat solusi lebih rumit daripada kebutuhan sebenarnya.

---

## 9. Status sesi dan langkah aktif berikutnya

**Fakta terakhir yang telah dikonfirmasi:**

- Branch default GitHub adalah `main`.
- `README.md` tersedia pada branch `main`.
- `GET /api/products/13` berhasil mengembalikan produk.
- `PUT /api/products/13` berhasil mengubah nama menjadi `Tas Tes Main Branch`, harga `135000.00`, dan stok `9`.
- GET ulang menunjukkan perubahan tersimpan.
- Pengguna meminta proses belajar tetap runtut, langsung ke inti, dan menggunakan bahasa yang mudah dimengerti.

**Langkah aktif berikutnya — jangan dilompati:**

1. Tinjau roadmap baru ini dan simpan sebagai `roadmaps.md` di root repository lokal.
2. Jalankan `git status --short --untracked-files=all` untuk melihat dampak penggantian file.
3. Sebelum commit roadmap, periksa `git diff --check` dan baca diff untuk memastikan hanya dokumentasi yang berubah.
4. Setelah roadmap tersimpan, lanjutkan **Fase A — menyelaraskan README dengan struktur serta SQL project yang nyata**. Jangan langsung membuat endpoint baru.
5. Pada sesi implementasi berikutnya, pilih satu materi DSA yang relevan dengan bagian yang sedang disentuh. Untuk langkah dokumentasi, fokus pada akurasi dokumen; jangan memaksakan latihan algoritma yang tidak relevan.
6. Sesudah dokumentasi sinkron, kembali ke Fase B untuk baseline kualitas, lalu Fase C/D untuk kontrak CRUD dan pengujian.

> **Prinsip akhir:** tujuan kita bukan sekadar membuat aplikasi selesai. Tujuannya adalah membuat pengguna mampu membaca kode, memahami alur data, memilih algoritma dan struktur data dengan alasan yang benar, menguji hasilnya, dan menjelaskan keputusan teknis seperti developer yang siap bekerja dalam tim.

---

## 10. Fondasi algoritma dan struktur data — wajib dipahami, bukan sekadar istilah

Bagian ini adalah jalur belajar yang berjalan **bersamaan dengan setiap fase project**. Setiap kali menambahkan fitur, mentor harus menjelaskan:

1. Data apa yang masuk, dari mana asalnya, dan bentuknya seperti apa.
2. Data structure apa yang dipakai untuk menyimpan atau mencari data.
3. Algoritma/langkah apa yang memproses data tersebut.
4. Mengapa pendekatan itu dipilih dibanding alternatifnya.
5. Perkiraan kompleksitas waktu dan ruangnya, setidaknya secara konseptual.
6. Apa yang berubah ketika jumlah data meningkat dari 10 menjadi 1.000, 100.000, atau lebih.
7. Bagian mana yang dikerjakan kode PHP kita dan bagian mana yang dikerjakan MySQL/PHP runtime.

Jangan menghafal Big O tanpa memahami jumlah operasi yang terjadi. Kita akan mengukur ketika memungkinkan, dan membedakan analisis teoretis dari hasil pengukuran nyata.

### 10.1 Dasar cara berpikir algoritmik

- [ ] Pahami algoritma sebagai urutan langkah yang menerima input, memprosesnya, lalu menghasilkan output.
- [ ] Pecah masalah menjadi: input → validasi → proses → akses data → response → verifikasi efek.
- [ ] Belajar membuat pseudocode sebelum menulis kode PHP.
- [ ] Kenali sequence, selection (`if/else`), dan iteration (`for`, `foreach`, `while`).
- [ ] Pelajari kondisi batas (*edge cases*): data kosong, satu item, ID tidak ada, nilai minimum/maksimum, tipe salah, duplikasi.
- [ ] Latih tracing: ikuti nilai variabel dari baris ke baris dan catat bagaimana nilainya berubah.
- [ ] Bedakan bug sintaks, bug runtime, bug logika, bug data, bug konfigurasi, dan bug integrasi.

**Latihan project:** tulis pseudocode proses `GET /api/products/{id}` sebelum membaca implementasinya. Jelaskan urutan route, validasi ID, pemanggilan Model, pencarian database, hasil ditemukan/tidak ditemukan, dan respons JSON.

### 10.2 Kompleksitas waktu dan ruang (Big O)

- [ ] Pahami `O(1)`, `O(log n)`, `O(n)`, `O(n log n)`, dan `O(n²)` dengan contoh kecil.
- [ ] Pahami bahwa Big O menggambarkan bagaimana pertumbuhan pekerjaan berubah saat input membesar; bukan ukuran detik yang pasti.
- [ ] Bedakan kompleksitas waktu (*time complexity*) dan ruang (*space complexity*).
- [ ] Belajar menghitung loop tunggal, loop bersarang, pencarian, dan pembuatan array baru.
- [ ] Pahami trade-off: struktur yang mempercepat pencarian dapat memakai memori lebih besar atau menambah biaya saat data ditulis.
- [ ] Jangan menyebut query database `O(1)` hanya karena memakai `WHERE id = ?`; pahami peran index dan query plan.

**Latihan:** hitung perkiraan operasi dari satu loop untuk `n` produk dan dua loop bersarang untuk dua daftar berukuran `n`. Bandingkan saat `n = 10`, `100`, dan `1.000`.

### 10.3 Struktur data yang dipakai atau akan ditemui dalam project

| Struktur data | Gambaran sederhana | Hubungan dengan project | Alasan / catatan |
|---|---|---|---|
| Array berurutan | Kumpulan nilai dengan posisi/index | Hasil daftar dari `fetchAll()` dan daftar produk | Cocok untuk menampung banyak baris hasil query dan ditelusuri dengan `foreach`. |
| Associative array / map | Kumpulan pasangan key → value | `$payload`, satu baris produk, dan data yang dikirim ke `JsonResponse` | Memudahkan mengambil nilai berdasarkan nama field seperti `name` atau `stock`. Di PHP, array juga berperan sebagai ordered map; jangan disamakan begitu saja dengan array numerik bahasa lain. |
| Object | Data dan perilaku yang dikelompokkan dalam class | `Product`, `ProductController`, `PDO`, `PDOStatement` | Membantu memisahkan tanggung jawab dan menyatukan state dengan method terkait. |
| Tabel relasional | Data disimpan sebagai baris dan kolom | `products` dan `categories` | Menjaga bentuk data terstruktur dan relasi antardata melalui key. |
| Primary key | Identitas unik tiap baris | `products.id`, `categories.id` | Membuat satu record bisa dirujuk secara konsisten. |
| Foreign key | Referensi ke primary/unique key tabel lain | `products.category_id` → `categories.id` | Menjaga agar produk tidak menunjuk kategori yang tidak ada. |
| Index database | Struktur tambahan untuk membantu menemukan baris | Primary key `id`, unique index `slug`, index lain yang ada di schema | Dapat mempercepat pencarian/filter tertentu, tetapi menambah ruang dan biaya saat INSERT/UPDATE/DELETE. Periksa `EXPLAIN`; jangan menambah index asal-asalan. |
| Set / keunikan | Kumpulan nilai tanpa duplikasi | Aturan `UNIQUE` pada `slug` | Database menjadi penjaga keunikan yang benar, bukan hanya pemeriksaan di PHP. |
| Queue (antrean) | First in, first out (FIFO) | Konsep untuk pekerjaan latar belakang, misalnya email/order notification di tahap lanjutan | Belum digunakan project sekarang. Pelajari saat ada pekerjaan yang tidak harus selesai di request pengguna. |
| Stack (tumpukan) | Last in, first out (LIFO) | Konsep call stack saat function saling memanggil; juga berguna dalam algoritma tertentu | Bukan struktur data bisnis utama project saat ini. Pelajari konsepnya dan jangan membuat stack manual tanpa kebutuhan. |

#### Catatan penting tentang PHP array

- Array numerik biasanya dipakai seperti daftar: `$products[0]`, `$products[1]`, dan seterusnya.
- Associative array dipakai seperti map: `$product['name']`, `$product['price']`.
- Data dari `PDO::FETCH_ASSOC` biasanya berbentuk associative array.
- `$payload['stock']` berarti mengambil nilai dengan key `stock`; key tersebut harus sesuai dengan nama properti yang dikirim client dan aturan yang diharapkan validator.
- Jangan menganggap key array otomatis sama dengan nama kolom database; hubungan itu terjadi karena query/alias dan cara kode membaca hasilnya.

#### Catatan index database

- Primary key dan unique constraint biasanya dibuatkan index oleh MySQL.
- Index bukan pengganti validasi atau foreign key.
- Pencarian lewat primary key/index dapat menghindari pemindaian seluruh tabel pada query yang sesuai, tetapi hasil sebenarnya bergantung pada query, statistik, dan optimizer.
- Index komposit hanya berguna untuk pola query tertentu; urutan kolom index penting.
- Index mempercepat beberapa operasi baca dengan konsekuensi penyimpanan dan biaya pemeliharaan saat data berubah.

### 10.4 Algoritma/pola pemrosesan yang sudah ada atau akan diterapkan

| Algoritma/pola | Dipakai di bagian mana | Hal yang perlu dipahami |
|---|---|---|
| Routing berdasarkan HTTP method dan path | `public/index.php` | Memilih handler berdasarkan method/path. Pastikan urutan pencocokan route tidak membuat route spesifik tertangkap route umum. |
| Validasi berurutan | `JsonRequest` dan `ProductValidator` | Memeriksa Content-Type, body, JSON, bentuk payload, field wajib, tipe, batas nilai, lalu menghasilkan data yang dinormalisasi atau error. |
| Pencarian berdasarkan primary key | `findActiveById()` / query detail produk | PHP mengirim parameter; MySQL mencari record dengan query yang sesuai. Pahami penggunaan index dan hasil 0 atau 1 baris. |
| Pemindaian daftar | `allActive()` dan loop tampilan | Database menghasilkan baris yang sesuai; PHP menelusuri hasil untuk membentuk response atau HTML. Jika hasil makin besar, pagination dibutuhkan. |
| JOIN relasional | Query produk dengan kategori | Database menggabungkan baris berdasarkan relasi key. Jangan mengasumsikan algoritma JOIN internal tertentu; periksa query plan bila membahas performa. |
| Pemeriksaan keunikan | Slug produk | Pemeriksaan di aplikasi bisa memberi pesan lebih awal, tetapi constraint UNIQUE database tetap diperlukan agar tidak terjadi duplikasi pada request bersamaan. |
| Update record | `updateActiveProduct()` | Validasi data, pastikan target ada/aktif, jalankan UPDATE dengan parameter, lalu ambil ulang data untuk response bila diperlukan. |
| Penanganan error terkontrol | `HttpException` dan Controller | Mengubah kondisi yang diketahui menjadi respons HTTP yang tepat, sambil menyimpan detail internal di log jika diperlukan. |
| Sorting dan pagination | Tahap katalog/API list lanjutan | Tentukan urutan stabil, gunakan `ORDER BY`, `LIMIT`, dan mekanisme halaman/cursor. Hindari mengambil semua data lalu menyortir di PHP tanpa alasan. |
| Transaksi | Tahap order/checkout | Sekumpulan query harus berhasil bersama atau dibatalkan bersama. Pelajari commit, rollback, dan konsistensi stok. |

### 10.5 Algoritma pencarian dan pengurutan yang perlu dipelajari

- [ ] **Linear search:** periksa item satu per satu; worst-case `O(n)`. Cocok untuk daftar kecil atau data yang memang harus ditelusuri satu per satu.
- [ ] **Binary search:** membagi ruang pencarian menjadi dua; `O(log n)` untuk data yang sudah terurut dan aksesnya mendukung. Jangan gunakan pada array yang belum terurut tanpa proses tambahan.
- [ ] **Hash lookup:** akses nilai berdasarkan key pada map/hash table; umumnya mendekati `O(1)` rata-rata pada implementasi hash yang baik, tetapi bukan jaminan semua situasi.
- [ ] **Sorting:** pahami mengapa sorting umumnya membutuhkan sekitar `O(n log n)` pada algoritma comparison-sort yang efisien; bandingkan dengan bubble sort `O(n²)` sebagai alat belajar, bukan pilihan default aplikasi.
- [ ] **Database ORDER BY:** pelajari kapan index membantu pengurutan dan kapan database perlu melakukan sort tambahan melalui `EXPLAIN`.
- [ ] Praktikkan linear search dan binary search pada dataset kecil di PHP, lalu ukur/analisis perbedaan; jangan mengganti query database dengan algoritma PHP bila database lebih tepat.

**Penting:** kita tidak perlu mengimplementasikan algoritma sorting sendiri untuk katalog produksi. Tujuan latihan adalah memahami trade-off, sehingga kita tahu kapan memakai array, map, index, atau query database.

### 10.6 Struktur data dan algoritma saat jumlah data membesar

- [ ] Pahami kenapa mengirim semua produk sekaligus dapat membuat response besar dan memakan memori.
- [ ] Pelajari pagination berbasis `LIMIT` dan `OFFSET`; pahami bahwa offset besar dapat menjadi mahal.
- [ ] Pelajari cursor/keyset pagination menggunakan nilai urut yang stabil, misalnya `id`, ketika data sangat besar atau terus berubah.
- [ ] Pelajari indeks komposit berdasarkan pola filter dan urutan query nyata.
- [ ] Pelajari N+1 query: bukan semata-mata algoritma `O(n²)`, tetapi pola jumlah query yang bertambah mengikuti jumlah record/relasi.
- [ ] Bandingkan pengambilan kategori lewat JOIN dengan query berulang per produk; ukur jumlah query dan waktu respons.
- [ ] Pahami cache sebagai penyimpanan sementara hasil yang mahal dihitung/diambil; rencanakan invalidasi saat produk berubah.

**Checkpoint DSA:** pengguna dapat menjelaskan bentuk data yang diterima Model/Controller, memilih array atau associative array untuk kebutuhan yang tepat, memahami index primary/unique, menelusuri algoritma GET/POST/PUT, serta memberi perkiraan kompleksitas sederhana.

---

## 11. Peta belajar algoritma & struktur data berdasarkan fase project

DSA tidak diajarkan sebagai teori terpisah yang tidak pernah dipakai. Materi diperkenalkan saat fitur yang relevan dikerjakan.

| Tahap project | Dasar algoritma/struktur data yang dipelajari | Pertanyaan yang harus bisa dijawab |
|---|---|---|
| Membaca daftar produk | Array, associative array, iteration, linear traversal, `O(n)` | Mengapa hasil query berupa kumpulan baris? Apa yang dilakukan `foreach`? |
| Detail produk | Key/ID, pencarian, primary-key index, `O(log n)` konseptual untuk B-tree index | Kenapa mencari berdasarkan ID berbeda dari memeriksa array satu per satu? |
| Validasi POST/PUT | Sequence, branching, guard clause, map/key-value | Kenapa validasi harus dilakukan sebelum query INSERT/UPDATE? |
| Slug unik | Set/uniqueness, unique index, race condition | Kenapa cek slug di PHP saja belum cukup? |
| JOIN kategori | Relasi one-to-many, foreign key, JOIN, query plan | Bagaimana satu produk mendapat nama kategori tanpa query berulang? |
| Daftar produk besar | Sorting, index, pagination, cursor | Kapan LIMIT/OFFSET mulai kurang efisien? |
| Test otomatis | Test case, fixture, data terkontrol, boundary testing | Bagaimana memastikan kasus sukses dan gagal selalu menghasilkan perilaku yang sama? |
| Orders/checkout | Transaction, consistency, concurrency, atomicity | Bagaimana mencegah stok berkurang sebagian ketika proses gagal? |
| Queue/notification opsional | FIFO queue, producer/consumer, retry | Kapan pekerjaan perlu dipindah dari request web? |

### Latihan algoritma pendamping

Latihan ini tidak harus menjadi fitur aplikasi. Buat file latihan terpisah jika diperlukan, misalnya `practice/`, agar kode eksperimen tidak tercampur dengan kode aplikasi.

- [ ] Linear search: temukan produk dengan ID tertentu dari array produk.
- [ ] Binary search: cari angka/ID dari array yang sudah diurutkan; bandingkan jumlah langkah dengan linear search.
- [ ] Frequency counter: hitung berapa produk berada di setiap kategori menggunakan associative array.
- [ ] Deduplication: temukan slug yang berulang pada dataset array, lalu bandingkan dengan constraint UNIQUE database.
- [ ] Sorting: urutkan daftar harga untuk memahami sorting, lalu bandingkan dengan `ORDER BY price` di SQL.
- [ ] Nested loop: cocokkan daftar produk dan kategori secara manual untuk memahami mengapa JOIN database lebih tepat pada data relasional.
- [ ] Pagination: ambil 10 record per halaman dan pastikan urutan stabil.
- [ ] Trace transaksi: tulis urutan checkout dan tandai titik commit/rollback.

**Aturan latihan:** selalu sertakan input contoh, output yang diharapkan, kasus tepi, penjelasan pilihan struktur data, dan analisis kompleksitas sederhana. Jangan hanya menyalin algoritma.

---

## 12. Protokol setiap sesi belajar

Sebelum memberi tugas baru, mentor harus membaca bagian status proyek dan langkah aktif, lalu mengikuti protokol ini:

1. **Konteks:** jelaskan satu masalah yang sedang dikerjakan.
2. **Konsep:** jelaskan dasar PHP/OOP/SQL/HTTP/algoritma/struktur data yang relevan.
3. **Pilihan:** sebutkan pendekatan yang dipilih dan alasan tidak memilih alternatif yang tidak cocok.
4. **Implementasi:** berikan satu perubahan kecil atau satu perintah pada satu waktu.
5. **Tracing:** telusuri input → proses → output; jelaskan simbol/kode penting dengan bahasa pemula.
6. **Uji:** berikan satu perintah tes dan hasil yang diharapkan.
7. **Evaluasi:** cocokkan hasil aktual, jelaskan apa yang sudah terbukti dan apa yang belum.
8. **Git:** setelah tes lolos, tinjau diff dan lakukan commit sesuai workflow.
9. **Catatan:** perbarui roadmap hanya pada item yang benar-benar selesai.

### Pertanyaan review yang perlu diajukan mentor

- Masalah apa yang diselesaikan kode ini?
- Bentuk input dan output-nya apa?
- Data structure apa yang dipakai, dan mengapa?
- Algoritma apa yang berjalan, dan bagaimana alurnya?
- Berapa perkiraan kompleksitas waktu/ruangnya?
- Apa edge case yang dapat menggagalkannya?
- Apakah validasi dilakukan di lapisan yang tepat?
- Apakah database punya constraint untuk menjaga integritas?
- Bagaimana membuktikan fitur lama tidak rusak (regression test)?
- Apakah solusi ini sederhana dan mudah dipelihara, atau sudah berlebihan?

---

## 13. Langkah aktif berikutnya — jangan melompat

1. Tinjau roadmap baru ini dan simpan sebagai `roadmaps.md` di root repository lokal.
2. Jalankan `git status --short --untracked-files=all` untuk melihat dampak penggantian file.
3. Sebelum commit roadmap, periksa `git diff --check` dan baca diff untuk memastikan hanya dokumentasi yang berubah.
4. Setelah roadmap tersimpan, lanjutkan **Fase A — menyelaraskan README dengan struktur serta SQL project yang nyata**. Jangan langsung membuat endpoint baru.
5. Pada sesi implementasi berikutnya, pilih satu materi DSA yang relevan dengan bagian yang sedang disentuh. Untuk langkah dokumentasi, fokus pada akurasi dokumen; jangan memaksakan latihan algoritma yang tidak relevan.
6. Sesudah dokumentasi sinkron, kembali ke Fase B untuk baseline kualitas, lalu Fase C/D untuk kontrak CRUD dan pengujian.

> **Prinsip akhir:** tujuan kita bukan sekadar membuat aplikasi selesai. Tujuannya adalah membuat pengguna mampu membaca kode, memahami alur data, memilih algoritma dan struktur data dengan alasan yang benar, menguji hasilnya, dan menjelaskan keputusan teknis seperti developer yang siap bekerja dalam tim.

## Langkah aktif berikutnya

1. Selesaikan penyelarasan README dengan struktur project dan file SQL.
2. Periksa baseline Git dan sintaks PHP.
3. Implementasikan DELETE API dengan soft delete.
4. Uji semua skenario DELETE.
5. Buat dan tinjau wireframe Admin Dashboard.
6. Selesaikan autentikasi dan otorisasi.
7. Implementasikan dashboard secara bertahap.
8. Hubungkan dashboard dengan API dan lakukan pengujian.
