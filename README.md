# Gizi Cerdas – Backend API (Final Version)

Gizi Cerdas adalah backend API berbasis **PHP (Native)** dan **MySQL** yang digunakan untuk memantau dan mengelola data gizi anak. Sistem ini menyediakan fungsi CRUD (Create, Read, Update, Delete) untuk mengelola datagizi anak. Serta mendukung relasi one-to-many dan many-to-many.

##Deskripsi

Seluruh endpoint disusun dalam bentuk:

- CREATE: Menambahkan data baru
- READ: Membaca/menampilkan data
- UPDATE: Memperbarui data sudah ada
- DELETE: Menghapus data
- JOIN: Relasi Antar Tabel

Semua endpoint mengembalikan respons dalam format JSON.

---

# Teknologi yang Digunakan

- PHP (Native)
- MySQL
- JSON API
- Laragon (Local Development Server)

---

# Struktur Database (10 Tabel)

## 1. roles (Master Data)

| Kolom      | Tipe Data | Keterangan                  |
|------------|----------|-----------------------------|
| role_id    | INT      | Primary Key, Auto Increment |
| role_name  | VARCHAR  | Nama peran (orang_tua, bidan) |

Relasi:
- 1 role → banyak users

---

## 2. provinsi (Master Data)

| Kolom         | Tipe Data | Keterangan                  |
|---------------|----------|-----------------------------|
| provinsi_id   | INT      | Primary Key, Auto Increment |
| nama_provinsi | VARCHAR  | Nama wilayah/provinsi       |

Relasi:
- 1 provinsi → banyak users

---

## 3. users

| Kolom           | Tipe Data | Keterangan                     |
|-----------------|----------|--------------------------------|
| user_id         | INT      | Primary Key                    |
| role_id         | INT      | FK → roles                     |
| nama_lengkap    | VARCHAR  | Nama pengguna                  |
| email           | VARCHAR  | Email                          |
| password        | VARCHAR  | Password (hash)                |
| provinsi_id     | INT      | FK → provinsi                  |
| tanggal_lahir   | DATE     | Tanggal lahir pengguna         |
| tanggal_daftar  | DATE     | Tanggal registrasi             |

Relasi:
- Banyak users → 1 role
- Banyak users → 1 provinsi
- 1 user → banyak anak
- 1 user → banyak notifikasi

---

## 4. anak

| Kolom          | Tipe Data | Keterangan              |
|----------------|----------|--------------------------|
| anak_id        | INT      | Primary Key              |
| user_id        | INT      | FK → users               |
| nama_anak      | VARCHAR  | Nama anak                |
| tanggal_lahir  | DATE     | Tanggal lahir anak       |
| jenis_kelamin  | VARCHAR  | L / P                    |

Relasi:
- 1 anak → banyak pertumbuhan_anak

---

## 5. pertumbuhan_anak

| Kolom          | Tipe Data | Keterangan               |
|----------------|----------|---------------------------|
| pertumbuhan_id | INT      | Primary Key               |
| anak_id        | INT      | FK → anak                 |
| usia_bulan     | INT      | Usia saat pengukuran      |
| berat_badan    | DECIMAL  | Berat badan               |
| tinggi_badan   | DECIMAL  | Tinggi badan              |
| tanggal_catat  | DATE     | Tanggal pencatatan        |
| keterangan     | VARCHAR  | Catatan tambahan          |

Relasi:
- Banyak pertumbuhan → 1 anak

---

## 6. edukasi_gizi (Master Konten)

| Kolom           | Tipe Data | Keterangan        |
|-----------------|----------|-------------------|
| edukasi_id      | INT      | Primary Key       |
| judul           | VARCHAR  | Judul             |
| kategori        | VARCHAR  | Kategori          |
| isi             | TEXT     | Konten edukasi    |
| tanggal_publish | DATE     | Tanggal publikasi |

---

## 7. notifikasi

| Kolom         | Tipe Data | Keterangan          |
|---------------|----------|----------------------|
| notifikasi_id | INT      | Primary Key          |
| user_id       | INT      | FK → users           |
| judul         | VARCHAR  | Judul notifikasi     |
| pesan         | TEXT     | Isi pesan            |
| tanggal_kirim | DATETIME | Waktu kirim          |
| status        | VARCHAR  | Status (terkirim/dibaca) |

---

## 8. resep (Master Data)

| Kolom           | Tipe Data | Keterangan         |
|-----------------|----------|--------------------|
| resep_id        | INT      | Primary Key        |
| nama_resep      | VARCHAR  | Nama resep         |
| kategori        | VARCHAR  | Kategori menu      |
| estimasi_porsi  | VARCHAR  | Estimasi porsi     |
| kandungan_gizi  | TEXT     | Informasi gizi     |

Relasi:
- Many-to-many dengan bahan_pangan

---

## 9. bahan_pangan (Master Data)

| Kolom         | Tipe Data | Keterangan          |
|---------------|----------|----------------------|
| bahan_id      | INT      | Primary Key          |
| nama_bahan    | VARCHAR  | Nama bahan           |
| satuan        | VARCHAR  | Gram/ml/dll          |
| asal_daerah   | VARCHAR  | Wilayah asal         |

Relasi:
- Many-to-many dengan resep

---

## 10. resep_bahan (Pivot Table)

| Kolom       | Tipe Data | Keterangan                     |
|-------------|----------|--------------------------------|
| resep_id    | INT      | FK → resep                     |
| bahan_id    | INT      | FK → bahan_pangan              |
| takaran     | VARCHAR  | Takaran penggunaan             |
| alternatif  | VARCHAR  | Alternatif bahan (opsional)    |

Relasi:
- Many-to-many antara resep dan bahan_pangan

---

# Daftar Modul & Endpoint

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


# Jenis Relasi dalam Sistem

## One-to-Many
- roles → users
- provinsi → users
- users → anak
- anak → pertumbuhan_anak
- users → notifikasi

## Many-to-Many
- resep ↔ bahan_pangan (melalui resep_bahan)

---

## Dokumentasi Modul Users

Modul **Users** digunakan untuk mengelola data pengguna aplikasi Gizi Cerdas. Modul ini mencakup operasi CRUD (Create, Read, Update, Delete) serta memiliki relasi dengan tabel `roles`, `provinsi`, `anak`, dan `notifikasi`.

---

### Struktur Data Users

| Field           | Tipe Data | Keterangan                              |
|----------------|----------|------------------------------------------|
| user_id        | int      | Primary Key                              |
| role_id        | int      | Foreign Key → roles                      |
| nama_lengkap   | string   | Nama lengkap pengguna                    |
| email          | string   | Email pengguna                           |
| password       | string   | Password (hash)                          |
| provinsi_id    | int      | Foreign Key → provinsi                   |
| tanggal_lahir  | date     | Tanggal lahir pengguna                   |
| tanggal_daftar | date     | Tanggal registrasi                       |

---

### Relasi

- Banyak users → 1 role
- Banyak users → 1 provinsi
- 1 user → banyak anak
- 1 user → banyak notifikasi

---

## CREATE – Menambahkan Data User

**URL**  
`/users/create.php`

**Method**  
POST

### Parameter

- `role_id` (int)
- `nama_lengkap` (string)
- `email` (string)
- `password` (string)
- `provinsi_id` (int)
- `tanggal_lahir` (date)

### Contoh Request

```bash
curl -X POST \
-d "role_id=1" \
-d "nama_lengkap=Rina Pratiwi" \
-d "email=rina@gmail.com" \
-d "password=hashpass1" \
-d "provinsi_id=3" \
-d "tanggal_lahir=2002-04-21" \
http://localhost/BE-Latihan-kelas/users/create.php
```

### Contoh Response Sukses

```json
{
  "status": "success",
  "message": "Data user berhasil ditambahkan",
  "data": {
    "nama_lengkap": "Rina Pratiwi",
    "email": "rina@gmail.com",
    "role_id": 1,
    "provinsi_id": 3,
    "tanggal_lahir": "2002-04-21"
  }
}
```

### Contoh Response Error

```json
{
  "status": "error",
  "message": "Error messege here"
}
```

---

## READ – Menampilkan Data User

**URL**  
`/users/read.php`

**Method**  
GET

### Parameter (Opsional)

- `user_id` (int) - Untuk mendapatkan data users berdasarkan ID

Jika tidak ada parameter, maka akan mengembalikan semua data users.

### Contoh Request (Semua Data)

```bash
curl http://localhost/BE-Latihan-kelas/users/read.php
```

### Contoh Request (Spesifik ID)

```bash
curl http://localhost/BE-Latihan-kelas/users/read.php?user_id=1
```

### Contoh Response Sukses

```json
{
  "status": "success",
  "data": [
    {
      "user_id": 1,
      "role_id": 1,
      "nama_lengkap": "Rina Pratiwi",
      "email": "rina@gmail.com",
      "provinsi_id": 3,
      "tanggal_lahir": "2002-04-21",
      "tanggal_daftar": "2026-02-10"
    }
  ]
}
```

### Contoh Response Sukses (Data Kosong)

```json
{
  "status": "success",
  "message": "Data user kosong",
  "data": []
}
```

---

## UPDATE – Memperbarui Data User

**URL**  
`/users/update.php`

**Method**  
POST

### Parameter

- `user_id` (int)
- `nama_lengkap` (string)
- `email` (string)
- `provinsi_id` (int)
- `tanggal_lahir` (date)

### Contoh Request

```bash
curl -X POST \
-d "user_id=1" \
-d "nama_lengkap=Rina Pratiwi Update" \
-d "email=rina_update@gmail.com" \
-d "provinsi_id=5" \
-d "tanggal_lahir=2002-04-21" \
http://localhost/BE-Latihan-kelas/users/update.php
```

### Contoh Response sukses

```json
{
    "status": "success",
    "message": "Data users berhasil diperbarui",
    "data": {
        "user_id": "1",
        "nama_lengkap": "Rina Pratiwi Update",
        "email": "rina_update@gmail.com",
        "provinsi_id": "5",
        "tanggal_lahir": "2002-04-21"
    }
}
```

### Contoh Response Error

```json
{
  "status": "error",
  "message": "Error message here"
}
```


---

## DELETE – Menghapus Data User

**URL**  
`/users/delete.php`

**Method**  
POST

### Parameter

- `user_id` (int)

### Contoh Request

```bash
curl -X POST \
-d "user_id=1" \
http://localhost/BE-Latihan-kelas/users/delete.php
```

### Contoh Response sukses

```json
{
  "status": "success",
  "message": "Data user berhasil dihapus"
}
```

### Contoh Response Error

```json
{
  "status": "error",
  "message": "Error message here"
}
```

---

# READ JOIN – Users & Roles

Endpoint JOIN ini digunakan untuk menampilkan data user beserta nama role yang dimiliki.

**URL**  
`/users/read_join.php`

**Method**  
GET

### Contoh Query

```sql
SELECT u.*, r.role_name
FROM users u
INNER JOIN roles r
ON u.role_id = r.role_id;
```

### Contoh Response

```json
{
    "status": "success",
    "total_data": 11,
    "data": [
        {
            "user_id": 1,
            "nama_lengkap": "Rina Pratiwi",
            "role_name": "orang_tua"
}
```

---


> Modul **Users** merupakan pusat relasi sistem dan menjadi dasar bagi modul `anak`, `notifikasi`, dan relasi lainnya.


---

## Instalasi
---
1. Pastikan Anda memiliki server web dengan PHP dan MySQL
2. Salin semua file ke direktori web server Anda
3. Buat database MySQL dan import struktur tabel sesuai dengan deskripsi di atas
4. Konfigurasi koneksi database di file `db.php`
5. Akses endpoint sesuai kebutuhan

---

## Catatan
1. Semua endpoint mengembalikan respons dalam format JSON
2. Gunakan metode POST untuk CREATE, UPDATE, dan DELETE
3. Gunakan metode GET untuk READ dan JOIN
4. Gunakan prepared statements untuk mencegah SQL injection
5. Pastikan untuk selalu mengecek status respons sebelum memproses data lebih lanjut

Struktur ini siap dikembangkan lebih lanjut untuk kebutuhan mobile app atau sistem berbasis web.
