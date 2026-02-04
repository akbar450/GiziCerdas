# Gizi Cerdas – Backend API

Gizi Cerdas adalah aplikasi backend berbasis **PHP** dan **MySQL** yang digunakan untuk memantau dan mengelola data gizi anak, mulai dari data pengguna, data anak, edukasi gizi, pertumbuhan anak, hingga notifikasi. Seluruh endpoint disusun dalam bentuk **CRUD (Create, Read, Update, Delete)** serta **JOIN**, dan seluruh respons dikembalikan dalam format **JSON**.

---

## Teknologi yang Digunakan

* PHP (Native)
* MySQL
* JSON (API Response)
* Laragon (Local Server)
---

## Struktur Database

### 1. Tabel `users`

| Kolom          | Tipe Data | Keterangan                  |
| -------------- | --------- | --------------------------- |
| user_id        | INT       | Primary Key, Auto Increment |
| nama_lengkap   | VARCHAR   | Nama lengkap pengguna       |
| email          | VARCHAR   | Email pengguna              |
| password       | VARCHAR   | Password pengguna (hash)    |
| usia           | INT       | Usia pengguna               |
| provinsi       | VARCHAR   | Provinsi domisili pengguna  |
| tanggal_daftar | DATE      | Tanggal pendaftaran         |


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

## Dokumentasi Modul Users

Modul **Users** digunakan untuk mengelola data pengguna aplikasi Gizi Cerdas. Modul ini mencakup operasi CRUD (Create, Read, Update, Delete) dan digunakan sebagai dasar relasi dengan modul lain seperti `anak` dan `notifikasi`.

---

### Struktur Data Users

| Field          | Tipe Data | Keterangan            |
| -------------- | --------- | --------------------- |
| user_id        | int       | Primary Key           |
| nama_lengkap   | string    | Nama lengkap pengguna |
| email          | string    | Email pengguna        |
| password       | string    | Password (hash)       |
| usia           | int       | Usia pengguna         |
| provinsi       | string    | Provinsi domisili     |
| tanggal_daftar | date      | Tanggal pendaftaran   |

---

### CREATE – Menambahkan Data User

**URL**
`/users/create.php`

**Method**
POST

**Parameter**

* nama_lengkap (string)
* email (string)
* password (string)
* usia (int)
* provinsi (string)

**Contoh Request**

```bash
curl -X POST \
-d "nama_lengkap=Rina Pratiwi" \
-d "email=rina@gmail.com" \
-d "password=hashpass1" \
-d "usia=23" \
-d "provinsi=Kalimantan Selatan" \
http://localhost/gizi-cerdas/users/create.php
```

**Contoh Response Sukses**

```json
{
    "status": "success",
    "message": "Data berhasil ditambahkan",
    "data": {
        "nama_lengkap": "Rina Pratiwi",
        "email": "rina@gmail.com",
        "usia": "23",
        "provinsi": "Kalimantan Selatan"
    }
}
```

**Contoh Response Error**

```json
{
  "status": "error",
  "message": "Error message here"
}
```

---

### READ – Menampilkan Data User

**URL**
`/users/read.php`

**Method**
GET

**Parameter (Opsional)**

* user_id (int)

**Contoh Request**

```bash
curl http://localhost/gizi-cerdas/users/read.php
```

**Contoh Response Sukses**

```json
{
  "status": "success",
  "data": [
    {
      "user_id": 1,
      "nama_lengkap": "Rina Pratiwi",
      "email": "rina@gmail.com",
      "usia": 23,
      "provinsi": "Kalimantan Selatan",
      "tanggal_daftar": "2025-01-10"
    }
  ]
}
```

**Contoh Response Sukses (Data Kosong)**

```json
{
  "status": "success",
  "message": "Data user kosong",
  "data": []
}
```

---

### UPDATE – Memperbarui Data User

**URL**
`/users/update.php`

**Method**
POST

**Parameter**

* user_id (int)
* nama_lengkap (string)
* usia (int)
* provinsi (string)

**Contoh Request**

```bash
curl -X POST \
-d "user_id=1" \
-d "nama_lengkap=Rina P. Updated" \
-d "usia=24" \
-d "provinsi=Kalimantan Timur" \
http://localhost/gizi-cerdas/users/update.php
```

**Contoh Response Sukses**

```json
{
  "status": "success",
  "message": "Data user berhasil diperbarui"
}
```

**Contoh Response Error**

```json
{
  "status": "error",
  "message": "Error message here"
}
```

---

### DELETE – Menghapus Data User

**URL**
`/users/delete.php`

**Method**
POST

**Parameter**

* user_id (int)

**Contoh Request**

```bash
curl -X POST \
-d "user_id=1" \
http://localhost/gizi-cerdas/users/delete.php
```

**Contoh Response Sukses**

```json
{
  "status": "success",
  "message": "Data user berhasil dihapus"
}
```

**Contoh Response Error**

```json
{
  "status": "error",
  "message": "Error message here"
}
```

---

> Dokumentasi modul **Users** ini menjadi dasar untuk modul lain yang memiliki relasi Foreign Key, seperti `anak` dan `notifikasi`.

---

### READ JOIN – Users & Notifikasi

Endpoint JOIN ini digunakan untuk menampilkan data **user beserta notifikasi yang diterimanya**, dengan menggabungkan tabel `users` dan `notifikasi` berdasarkan `user_id`.

**URL**
`/users/read_join.php`

**Method**
GET

**Parameter (Opsional)**

* user_id (int) – untuk menampilkan notifikasi milik user tertentu

**Contoh Request**

```bash
curl http://localhost/gizi-cerdas/users/read_join.php?user_id=1
```

**Contoh Response Sukses**

```json
{
  "status": "success",
  "data": [
    {
      "user_id": 1,
      "nama_lengkap": "Rina Pratiwi",
      "email": "rina@gmail.com",
      "judul": "Pengingat MPASI",
      "pesan": "Waktunya memberikan MPASI",
      "tanggal_kirim": "2025-01-20 08:00:00",
      "status_notifikasi": "terkirim"
    }
  ]
}
```

**Contoh Response Sukses (Data Kosong)**

```json
{
  "status": "success",
  "message": "Data notifikasi tidak ditemukan",
  "data": []
}
```

**Contoh Response Error**

```json
{
  "status": "error",
  "message": "Error message here"
}
```

---

> Dengan adanya endpoint JOIN ini, modul **Users** dapat digunakan untuk menampilkan riwayat notifikasi pengguna, yang umumnya dibutuhkan pada halaman dashboard atau profil pengguna.


---


## Dokumentasi Modul Anak

Modul **Anak** digunakan untuk mengelola data anak yang terhubung dengan data pengguna (`users`) serta menjadi dasar pencatatan pertumbuhan anak. Modul ini mendukung operasi **CRUD** dan **JOIN**.

---

### Struktur Data Anak

| Field         | Tipe Data | Keterangan                 |
| ------------- | --------- | -------------------------- |
| anak_id       | int       | Primary Key                |
| user_id       | int       | Foreign Key ke tabel users |
| nama_anak     | string    | Nama anak                  |
| usia_bulan    | int       | Usia anak dalam bulan      |
| berat_badan   | float     | Berat badan anak           |
| tinggi_badan  | float     | Tinggi badan anak          |
| tanggal_input | date      | Tanggal input data         |

---

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

**Contoh Request**

```bash
curl -X POST \
-d "user_id=1" \
-d "nama_anak=Alya Zahra" \
-d "usia_bulan=12" \
-d "berat_badan=8.5" \
-d "tinggi_badan=72.1" \
http://localhost/gizi-cerdas/anak/create.php
```

**Contoh Response Sukses**

```json
{
    "status": "success",
    "message": "Data anak berhasil ditambahkan",
    "data": {
        "user_id": "1",
        "nama_anak": "Alya Zahra",
        "usia_bulan": "12",
        "berat_badan": "8.5",
        "tinggi_badan": "72.1"
    }
}
```

**Contoh Response Error**

```json
{
  "status": "error",
  "message": "Error message here"
}
```

---

### READ – Menampilkan Data Anak

**URL**
`/anak/read.php`

**Method**
GET

**Parameter (Opsional)**

* anak_id (int)
* user_id (int)

**Contoh Request**

```bash
curl http://localhost/gizi-cerdas/anak/read.php
```

**Contoh Response Sukses**

```json
{
  "status": "success",
  "data": [
    {
      "anak_id": 1,
      "nama_anak": "Alya Zahra",
      "usia_bulan": 12,
      "berat_badan": 8.5,
      "tinggi_badan": 72.1,
      "tanggal_input": "2025-01-20"
    }
  ]
}
```

**Contoh Response Sukses (Data Kosong)**

```json
{
  "status": "success",
  "message": "Data anak kosong",
  "data": []
}
```

---

### UPDATE – Memperbarui Data Anak

**URL**
`/anak/update.php`

**Method**
POST

**Parameter**

* anak_id (int)
* nama_anak (string)
* usia_bulan (int)
* berat_badan (float)
* tinggi_badan (float)

**Contoh Request**

```bash
curl -X POST \
-d "anak_id=1" \
-d "nama_anak=Alya Zahra Updated" \
-d "usia_bulan=13" \
-d "berat_badan=8.9" \
-d "tinggi_badan=73.0" \
http://localhost/gizi-cerdas/anak/update.php
```

**Contoh Response Sukses**

```json
{
  "status": "success",
  "message": "Data anak berhasil diperbarui"
}
```

**Contoh Response Error**

```json
{
  "status": "error",
  "message": "Error message here"
}
```

---

### DELETE – Menghapus Data Anak

**URL**
`/anak/delete.php`

**Method**
POST

**Parameter**

* anak_id (int)

**Contoh Request**

```bash
curl -X POST \
-d "anak_id=1" \
http://localhost/gizi-cerdas/anak/delete.php
```

**Contoh Response Sukses**

```json
{
  "status": "success",
  "message": "Data anak berhasil dihapus"
}
```

**Contoh Response Error**

```json
{
  "status": "error",
  "message": "Error message here"
}
```

---

### READ JOIN – Anak & Users

**URL**
`/anak/read_join.php`

**Method**
GET

**Deskripsi**
Menampilkan data anak beserta informasi pengguna (JOIN tabel `anak` dan `users`).

**Contoh Response Sukses**

```json
{
  "status": "success",
  "data": [
    {
      "nama_lengkap": "Rina Pratiwi",
      "nama_anak": "Alya Zahra",
      "usia_bulan": 12,
      "provinsi": "Kalimantan Selatan"
    }
  ]
}
```

**Contoh Response Sukses (Data Kosong)**

```json
{
  "status": "success",
  "message": "Data anak tidak ditemukan",
  "data": []
}
```

**Contoh Response Error**

```json
{
  "status": "error",
  "message": "Error message here"
}
```

---

> Modul **Anak** merupakan penghubung utama antara data pengguna dan data pertumbuhan anak. Dokumentasi modul berikutnya dapat menggunakan pola yang sama untuk menjaga konsistensi API.

