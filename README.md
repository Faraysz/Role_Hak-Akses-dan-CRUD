# Workshop Sistem Informasi - Minggu 11

**Sistem Informasi Kampus** - Implementasi RBAC (Role-Based Access Control) & CRUD dengan PHP OOP

> Tugas Praktikum Workshop Sistem Informasi (TIF120808)  
> Politeknik Negeri Jember - D4 Teknik Informatika

---

## Deskripsi

Aplikasi web berbasis PHP OOP yang mengimplementasikan:

- **Acara 19 (Minggu 11/1):** User Roles & Access Rights
  - Authentication (Login & Register)
  - Authorization (Role-Based Access Control)
  - Session Management
  
- **Acara 20 (Minggu 11/2):** Manajemen Data (CRUD)
  - CRUD Jurusan dengan PHP OOP
  - DataTables (Client-Side) untuk tampilan data interaktif

---

## Fitur

| Fitur | Deskripsi |
|-------|-----------|
| Register | Registrasi akun user baru |
| Login | Autentikasi dengan email & password |
| RBAC | Role `admin` dan `user` dengan hak akses berbeda |
| Dashboard | Halaman utama dengan statistik |
| CRUD Jurusan | Create, Read, Update, Delete data jurusan |
| DataTables | Pagination, searching, sorting otomatis |
| Admin Panel | Halaman khusus admin (daftar user) |
| Security | `password_hash()`, `prepared statement`, session |

---

## Struktur Proyek

```
Workshop-SI-Minggu11/
├── config/
│   └── Database.php          # Class koneksi database
├── classes/
│   ├── User.php              # Class manajemen user
│   ├── Auth.php              # Class login & session
│   ├── AccessControl.php     # Class validasi hak akses (RBAC)
│   └── Jurusan.php           # Class CRUD jurusan
├── contents/
│   └── jurusan/
│       ├── index.php         # Halaman list jurusan (DataTables)
│       ├── create.php        # Form tambah jurusan
│       ├── edit.php          # Form edit jurusan
│       ├── store.php         # Proses simpan data baru
│       ├── update.php        # Proses update data
│       └── delete.php        # Proses hapus data (AJAX)
├── includes/
│   ├── header.php            # Template header HTML
│   ├── navbar.php            # Navbar dengan RBAC
│   └── footer.php            # Template footer HTML
├── assets/
│   ├── css/
│   │   └── style.css         # Custom stylesheet
│   └── js/
│       └── script.js         # DataTables init & delete handler
├── sql/
│   └── db_kampus.sql         # Schema & seed database
├── index.php                 # Redirect ke login
├── login.php                 # Halaman login
├── register.php              # Halaman registrasi
├── logout.php                # Proses logout
├── dashboard.php             # Halaman dashboard + routing
├── admin.php                 # Halaman admin (role admin only)
└── README.md
```

---

## Prinsip OOP yang Diterapkan

| Prinsip | Implementasi |
|---------|-------------|
| **Encapsulation** | Data user & role dibungkus dalam class dengan `private` properties |
| **Abstraction** | Logika login, CRUD, dan akses disederhanakan dalam method |
| **Separation of Concerns** | Auth → login, AccessControl → validasi akses, Jurusan → CRUD |

---

## Instalasi & Setup

### Prasyarat
- PHP >= 7.4
- MySQL >= 5.7
- Apache (XAMPP / Laragon / MAMP)

### Langkah-Langkah

1. **Clone repository**
   ```bash
   git clone https://github.com/Faraysz/Workshop-SI-Minggu11.git
   ```

2. **Import database**
   - Buka phpMyAdmin / HeidiSQL / MySQL Workbench
   - Import file `sql/db_kampus.sql`
   - Atau jalankan via terminal:
     ```bash
     mysql -u root < sql/db_kampus.sql
     ```

3. **Konfigurasi database** (jika perlu)
   - Edit file `config/Database.php`
   - Sesuaikan `$host`, `$user`, `$pass`, `$db`

4. **Jalankan aplikasi**
   - Pindahkan folder proyek ke `htdocs` (XAMPP) atau `www` (Laragon)
   - Buka browser: `http://localhost/Workshop-SI-Minggu11/`

### Akun Default

| Role | Email | Password |
|------|-------|----------|
| Admin | admin@kampus.ac.id | admin123 |

---

## Teknologi

- **Backend:** PHP 7.4+ (OOP)
- **Database:** MySQL
- **Frontend:** Bootstrap 5, Bootstrap Icons
- **Plugin:** DataTables (Client-Side)
- **Library:** jQuery 3.7

---

## Keamanan

- Password di-hash menggunakan `password_hash()` dan diverifikasi dengan `password_verify()`
- Query menggunakan **Prepared Statement** untuk mencegah SQL Injection
- Session dikelola secara aman
- Akses halaman dilindungi dengan class `AccessControl`

---

## Screenshot

### Halaman Login
![Login Page](assets/screenshots/login.png)

### Dashboard
![Dashboard](assets/screenshots/dashboard.png)

### CRUD Jurusan
![CRUD Jurusan](assets/screenshots/jurusan.png)

---

## Lisensi

Proyek ini dibuat untuk keperluan tugas praktikum.
