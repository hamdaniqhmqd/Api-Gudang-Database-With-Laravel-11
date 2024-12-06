# API Gudang - Laravel 11

Proyek ini merupakan backend berbasis Laravel 11 untuk mengelola data gudang. API ini menyediakan fitur CRUD untuk barang, supplier, admin, dan transaksi, yang dapat digunakan oleh aplikasi frontend atau mobile.

---

## Fitur Utama

-   **CRUD Barang**: Tambah, ubah, hapus, dan lihat data barang.
-   **Manajemen Supplier**: Kelola data supplier barang.
-   **Manajemen Transaksi**: Catat barang masuk dan keluar.
-   **Manajemen Admin**: Kelola data admin aplikasi.

---

## Teknologi yang Digunakan

-   **Laravel 11**: Framework utama.
-   **MySQL**: Database untuk penyimpanan data.
-   **Laravel Sanctum**: Untuk autentikasi berbasis token (opsional).
-   **Eloquent ORM**: Mempermudah pengelolaan database.

---

## Endpoint API

Daftar Endpoint yang isa di gunakan.

### **1. Transaksi**

| **Method** | **Endpoint**          | **Deskripsi**                                |
| ---------- | --------------------- | -------------------------------------------- |
| `GET`      | `/api/transaksi`      | Menampilkan daftar semua transaksi.          |
| `GET`      | `/api/transaksi/{id}` | Menampilkan detail transaksi berdasarkan ID. |
| `POST`     | `/api/transaksi`      | Menambahkan data transaksi baru.             |
| `PUT`      | `/api/transaksi/{id}` | Mengupdate data transaksi berdasarkan ID.    |
| `DELETE`   | `/api/transaksi/{id}` | Menghapus data transaksi berdasarkan ID.     |

---

### **2. Admin**

| **Method** | **Endpoint**      | **Deskripsi**                            |
| ---------- | ----------------- | ---------------------------------------- |
| `GET`      | `/api/admin`      | Menampilkan daftar semua admin.          |
| `GET`      | `/api/admin/{id}` | Menampilkan detail admin berdasarkan ID. |
| `POST`     | `/api/admin`      | Menambahkan data admin baru.             |
| `PUT`      | `/api/admin/{id}` | Mengupdate data admin berdasarkan ID.    |
| `DELETE`   | `/api/admin/{id}` | Menghapus data admin berdasarkan ID.     |

---

### **3. Barang**

| **Method** | **Endpoint**       | **Deskripsi**                             |
| ---------- | ------------------ | ----------------------------------------- |
| `GET`      | `/api/barang`      | Menampilkan daftar semua barang.          |
| `GET`      | `/api/barang/{id}` | Menampilkan detail barang berdasarkan ID. |
| `POST`     | `/api/barang`      | Menambahkan data barang baru.             |
| `PUT`      | `/api/barang/{id}` | Mengupdate data barang berdasarkan ID.    |
| `DELETE`   | `/api/barang/{id}` | Menghapus data barang berdasarkan ID.     |

---

### **4. Supplier**

| **Method** | **Endpoint**         | **Deskripsi**                               |
| ---------- | -------------------- | ------------------------------------------- |
| `GET`      | `/api/supplier`      | Menampilkan daftar semua supplier.          |
| `GET`      | `/api/supplier/{id}` | Menampilkan detail supplier berdasarkan ID. |
| `POST`     | `/api/supplier`      | Menambahkan data supplier baru.             |
| `PUT`      | `/api/supplier/{id}` | Mengupdate data supplier berdasarkan ID.    |
| `DELETE`   | `/api/supplier/{id}` | Menghapus data supplier berdasarkan ID.     |

---

## Langkah-Langkah Instalasi Laravel

Ikuti langkah-langkah berikut untuk menginstal Laravel dan menjalankan proyek ini:

1. **Pastikan Composer telah terinstal** di komputer Anda.  
   Unduh Composer [di sini](https://getcomposer.org/download/).

2. **Clone repository:**

    ```bash
    git clone https://github.com/username/API-Gudang-Laravel-11.git
    ```

3. **Masuk ke direktori proyek:**

    ```bash
    cd API-Gudang-Laravel-11
    ```

4. **Install dependensi Laravel:**

    ```bash
    composer install
    ```

5. **Salin file `.env.example` menjadi `.env`:**

    ```bash
    cp .env.example .env
    ```

6. **Konfigurasi file `.env`:**  
   Edit file `.env` dan sesuaikan dengan pengaturan database lokal Anda:

    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nama_database
    DB_USERNAME=user_database
    DB_PASSWORD=password_database
    ```

7. **Generate application key:**

    ```bash
    php artisan key:generate
    ```

8. **Jalankan migrasi database:**

    ```bash
    php artisan migrate
    ```

9. **Jalankan server Larave**

    ```bash
    php artisan serve
    ```

10. **Akses API melalui browser atau Postman:**
    ```bash
    http://127.0.0.1:8000/api
    ```
