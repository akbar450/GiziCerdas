# Gizi Cerdas – Backend API

Gizi Cerdas adalah aplikasi backend berbasis **PHP** dan **MySQL** yang digunakan untuk memantau dan mengelola data gizi anak, mulai dari data pengguna, data anak, edukasi gizi, pertumbuhan anak, hingga notifikasi. Seluruh endpoint disusun dalam bentuk **CRUD (Create, Read, Update, Delete)** serta **JOIN**, dan seluruh respons dikembalikan dalam format **JSON**.

---

## Teknologi yang Digunakan

* PHP (Native)
* MySQL / MariaDB
* JSON (API Response)
* Laragon / XAMPP

---

## Struktur Database

### 1. Tabel `users`

| Kolom          | Tipe Data | Keterangan            |
| -------------- | --------- | --------------------- |
| user_id        | INT       | Primary Key           |
| nama_lengkap   | VARCHAR   | Nama lengkap pengguna |
| email          | VARCHAR   | Email pengguna        |
| password       | VARCHAR   | Password (hash)       |
| usia           | INT       | Usia pengguna         |
| provinsi       | VARCHAR   | Provinsi domisili     |
| tanggal_daftar | DATE      | Tanggal pendaftaran   |

---

### 2. Tabel `anak`

| Kolom         | Tipe Data | Keterangan          |
| ------------- | --------- | ------------------- |
| anak_id       | INT       | Primary Key         |
| user_id       | INT       | Foreign Key (users) |
| nama_anak     | VARCHAR   | Nama anak           |
| usia_bulan    | INT       | Usia anak (bulan)   |
| berat_badan   | DECIMAL   | Berat badan         |
| tinggi_badan  | DECIMAL   | Tinggi badan        |
| tanggal_input | DATE      | Tanggal input data  |

---

### 3. Tabel `edukasi_gizi`

| Kolom           | Tipe Data | Keterangan        |
| --------------- | --------- | ----------------- |
| edukasi_id      | INT       | Primary Key       |
| judul           | VARCHAR   | Judul edukasi     |
| kategori        | VARCHAR   | Kategori edukasi  |
| isi             | TEXT      | Isi konten        |
| tanggal_publish | DATE      | Tanggal publikasi |

---

### 4. Tabel `pertumbuhan_anak`

| Kolom          | Tipe Data | Keterangan          |
| -------------- | --------- | ------------------- |
| pertumbuhan_id | INT       | Primary Key         |
| anak_id        | INT       | Foreign Key (anak)  |
| berat_badan    | DECIMAL   | Berat badan         |
| tinggi_badan   | DECIMAL   | Tinggi badan        |
| tanggal_catat  | DATE      | Tanggal pencatatan  |
| keterangan     | VARCHAR   | Catatan pertumbuhan |

---

### 5. Tabel `notifikasi`

| Kolom         | Tipe Data | Keterangan          |
| ------------- | --------- | ------------------- |
| notifikasi_id | INT       | Primary Key         |
| user_id       | INT       | Foreign Key (users) |
| judul         | VARCHAR   | Judul notifikasi    |
| pesan         | TEXT      | Isi pesan           |
| tanggal_kirim | DATETIME  | Waktu pengiriman    |
| status        | VARCHAR   | Status notifikasi   |

---

## Daftar Modul & Endpoint

Modul yang tersedia:

1. Users
2. Anak
3. Edukasi Gizi
4. Pertumbuhan Anak
5. Notifikasi

Setiap modul memiliki endpoint:

* `create.php`
* `read.php`
* `update.php`
* `delete.php`
* `read_join.php`

Contoh path endpoint:

```
/anak/create.php
```

---

## Contoh Endpoint

### CREATE – Menambahkan Data Anak

**URL**
`/anak/create.php`

**Method**
POST

**Parameter**

* user_id (int)
* nama_anak (string)
* usia_bulan (int)
* berat_badan (float)
* tinggi_badan (float)
* tanggal_input (date)

---

### READ JOIN – Data Anak & Pertumbuhan

**URL**
`/anak/read_join.php`

**Method**
GET

**Deskripsi**
Mengambil data anak beserta riwayat pertumbuhan dengan JOIN antara tabel `anak` dan `pertumbuhan_anak`.

---

### CREATE – Menambahkan Edukasi Gizi

**URL**
`/edukasi_gizi/create.php`

**Method**
POST

**Parameter**

* judul
* kategori
* isi

---

### CREATE – Menambahkan Data Pertumbuhan Anak

**URL**
`/pertumbuhan_anak/create.php`

**Method**
POST

**Parameter**

* anak_id
* berat_badan
* tinggi_badan
* tanggal_catat
* keterangan

---

### READ JOIN – Notifikasi & Users

**URL**
`/notifikasi/read_join.php`

**Method**
GET

**Deskripsi**
Menampilkan data notifikasi beserta informasi pengguna (JOIN tabel `notifikasi` dan `users`).

---

## Instalasi

1. Clone repository GitHub
2. Jalankan Laragon / XAMPP
3. Import database MySQL sesuai struktur tabel
4. Atur koneksi database di file `db.php`
5. Akses endpoint menggunakan browser atau Postman

---

## Catatan Teknis

* Semua endpoint mengembalikan respons dalam format JSON
* Menggunakan prepared statement (aman dari SQL Injection)
* Struktur backend modular dan mudah dikembangkan

---

## Penutup

Dokumentasi ini disusun sebagai panduan penggunaan backend **Gizi Cerdas** agar mudah dipahami, diuji, dan dikembangkan lebih lanjut, baik untuk kebutuhan akademik maupun pengembangan aplikasi nyata.
