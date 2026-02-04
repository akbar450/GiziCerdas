# Gizi Cerdas – Backend API

Gizi Cerdas adalah aplikasi backend berbasis **PHP** dan **MySQL** yang digunakan untuk mengelola data pengguna (orang tua), data anak, edukasi gizi, pertumbuhan anak, serta notifikasi. Backend ini menyediakan **endpoint CRUD (Create, Read, Update, Delete)** dan **JOIN** dengan format respons **JSON**, sehingga mudah diintegrasikan dengan aplikasi web maupun mobile.

---

## Teknologi yang Digunakan

* PHP (Native)
* MySQL / MariaDB
* JSON (Response API)
* Laragon / XAMPP (Local Server)

---

## Daftar Modul

1. **Users** – Manajemen data pengguna
2. **Anak** – Manajemen data anak
3. **Edukasi Gizi** – Konten edukasi gizi
4. **Pertumbuhan Anak** – Data berat dan tinggi badan anak
5. **Notifikasi** – Pemberitahuan sistem

Setiap modul memiliki endpoint:

* `create.php`
* `read.php`
* `update.php`
* `delete.php`
* `read_join.php` (JOIN)

Contoh path endpoint:

```
/anak/create.php
```

---

## 1. Modul Users

### CREATE – Menambahkan User

**URL**
`/users/create.php`

**Method**
POST

**Parameter**

* username (string)
* password (string)
* role (string)

**Contoh Request**

```bash
curl -X POST \
-d "username=admin" \
-d "password=admin123" \
-d "role=admin" \
http://localhost/gizi-cerdas/users/create.php
```

---

### READ – Menampilkan Data User

**URL**
`/users/read.php`

**Method**
GET

**Parameter (Opsional)**

* user_id

---

### UPDATE – Memperbarui Data User

**URL**
`/users/update.php`

**Method**
POST

**Parameter**

* user_id
* username
* role

---

### DELETE – Menghapus User

**URL**
`/users/delete.php`

**Method**
POST

**Parameter**

* user_id

---

## 2. Modul Anak

### CREATE – Menambahkan Data Anak

**URL**
`/anak/create.php`

**Method**
POST

**Parameter**

* user_id (int)
* nama_anak (string)
* tanggal_lahir (date)
* jenis_kelamin (string)

**Contoh Request**

```bash
curl -X POST \
-d "user_id=1" \
-d "nama_anak=Budi" \
-d "tanggal_lahir=2022-01-01" \
-d "jenis_kelamin=L" \
http://localhost/gizi-cerdas/anak/create.php
```

---

### READ JOIN – Data Anak & Pertumbuhan

**URL**
`/anak/read_join.php`

**Method**
GET

**Deskripsi**
Menampilkan data anak beserta riwayat pertumbuhan menggunakan JOIN antara tabel `anak` dan `pertumbuhan_anak`.

**Contoh Response**

```json
{
  "anak_id": 1,
  "nama_anak": "Budi",
  "berat_badan": 8.5,
  "tinggi_badan": 72.4,
  "tanggal_catat": "2025-01-15"
}
```

---

## 3. Modul Edukasi Gizi

### CREATE – Menambahkan Konten Edukasi

**URL**
`/edukasi_gizi/create.php`

**Method**
POST

**Parameter**

* judul (string)
* isi (text)

---

### READ – Menampilkan Edukasi Gizi

**URL**
`/edukasi_gizi/read.php`

**Method**
GET

---

## 4. Modul Pertumbuhan Anak

### CREATE – Menambahkan Data Pertumbuhan

**URL**
`/pertumbuhan_anak/create.php`

**Method**
POST

**Parameter**

* anak_id (int)
* berat_badan (float)
* tinggi_badan (float)
* tanggal_catat (date)
* keterangan (string)

---

### UPDATE – Memperbarui Data Pertumbuhan

**URL**
`/pertumbuhan_anak/update.php`

**Method**
POST

**Parameter**

* pertumbuhan_id
* berat_badan
* tinggi_badan
* tanggal_catat
* keterangan

---

## 5. Modul Notifikasi

### CREATE – Menambahkan Notifikasi

**URL**
`/notifikasi/create.php`

**Method**
POST

**Parameter**

* user_id
* pesan

---

### READ JOIN – Notifikasi & User

**URL**
`/notifikasi/read_join.php`

**Method**
GET

**Deskripsi**
Menampilkan notifikasi beserta informasi user menggunakan JOIN antara tabel `notifikasi` dan `users`.

---

## Instalasi

1. Clone repository GitHub
2. Jalankan Laragon / XAMPP
3. Import database MySQL
4. Atur koneksi database di `db.php`
5. Akses endpoint melalui browser atau Postman

---

## Catatan Teknis

* Semua endpoint mengembalikan respons dalam format JSON
* Menggunakan prepared statement (aman dari SQL Injection)
* Cocok digunakan sebagai backend REST API
* Mudah dikembangkan untuk aplikasi mobile

---

## Penutup

Dokumentasi ini disusun untuk memudahkan pengembangan dan integrasi backend **Gizi Cerdas**. Dengan struktur CRUD dan JOIN yang konsisten, sistem ini dapat dikembangkan lebih lanjut untuk kebutuhan monitoring gizi dan pertumbuhan anak secara berkelanjutan.
