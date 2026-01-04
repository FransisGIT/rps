# 🎓 Sistem SIAKAD - Modul RPS

Sistem Informasi Akademik untuk pengelolaan Rencana Pembelajaran Semester (RPS) dengan fitur tanda tangan digital menggunakan QR Code.

## 📋 Fitur Utama

- ✅ **Manajemen Mata Kuliah**: CRUD (Create, Read, Update, Delete) mata kuliah
- ✅ **Manajemen RPS**: Buat dan kelola RPS dengan 16 pertemuan lengkap
- ✅ **QR Code Digital Signature**: Generate QR Code untuk verifikasi keaslian dokumen
- ✅ **Export PDF**: Download RPS dalam format PDF profesional
- ✅ **Verifikasi QR Code**: Sistem verifikasi untuk memastikan keaslian dokumen RPS
- ✅ **Responsive Design**: Tampilan optimal di desktop dan mobile

## 🛠 Tech Stack

- **Backend**: Laravel 10.x
- **Frontend**: Blade Templates + Bootstrap 5
- **Database**: MySQL
- **QR Code**: Simple QR Code
- **PDF Generator**: Laravel DomPDF

## 📦 Instalasi

### Prerequisites

Pastikan sistem Anda sudah terinstall:
- PHP >= 8.1
- Composer
- MySQL
- Node.js & NPM (optional)

### Langkah Instalasi

1. **Clone repository**
   ```bash
   git clone https://github.com/FransisGIT/rps.git
   cd rps
   ```

2. **Install dependencies**
   ```bash
   composer install
   ```

3. **Setup environment**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Konfigurasi database**
   
   Buka file `.env` dan sesuaikan konfigurasi database:
   ```
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=siakad_rps
   DB_USERNAME=root
   DB_PASSWORD=
   ```

5. **Buat database**
   ```sql
   CREATE DATABASE siakad_rps;
   ```

6. **Run migration & seeder**
   ```bash
   php artisan migrate
   php artisan db:seed
   ```

7. **Create storage symlink**
   ```bash
   php artisan storage:link
   ```

8. **Jalankan aplikasi**
   ```bash
   php artisan serve
   ```

9. **Akses aplikasi**
   
   Buka browser dan akses: `http://localhost:8000`

## 📁 Struktur Database

### Tabel: `mata_kuliah`
- `id`: Primary Key
- `kode_mk`: Kode Mata Kuliah (unique)
- `nama_mk`: Nama Mata Kuliah
- `sks`: Jumlah SKS
- `semester`: Semester
- `prodi`: Program Studi
- `deskripsi`: Deskripsi Mata Kuliah

### Tabel: `rps`
- `id`: Primary Key
- `mata_kuliah_id`: Foreign Key ke `mata_kuliah`
- `tahun_ajaran`: Tahun Ajaran (ex: 2025/2026)
- `semester`: Ganjil/Genap
- `dosen_pengampu`: Nama Dosen
- `capaian_pembelajaran`: Learning Outcomes
- `prasyarat`: Mata Kuliah Prasyarat
- `referensi`: Daftar Pustaka
- `metode_pembelajaran`: Metode Pembelajaran
- `metode_penilaian`: Metode Penilaian
- `qr_code_path`: Path file QR Code
- `qr_code_hash`: Hash untuk verifikasi
- `status`: Draft/Final

### Tabel: `rps_pertemuan`
- `id`: Primary Key
- `rps_id`: Foreign Key ke `rps`
- `pertemuan_ke`: Nomor Pertemuan (1-16)
- `materi`: Materi Pembelajaran
- `metode`: Metode Pengajaran
- `waktu`: Durasi (menit)

## 🎯 Cara Penggunaan

### 1. Tambah Mata Kuliah
- Klik menu **Mata Kuliah**
- Klik tombol **Tambah Mata Kuliah**
- Isi form dan klik **Simpan**

### 2. Buat RPS
- Klik menu **RPS**
- Klik tombol **Tambah RPS**
- Pilih mata kuliah dan isi semua field
- Isi materi untuk 16 pertemuan
- Klik **Simpan RPS**

### 3. Generate QR Code
- Buka detail RPS
- Klik tombol **Generate QR Code**
- QR Code akan muncul di sidebar

### 4. Download PDF
- Buka detail RPS atau list RPS
- Klik tombol **Download PDF**
- PDF akan terdownload otomatis

### 5. Verifikasi QR Code
- Scan QR Code menggunakan scanner
- Copy data JSON hasil scan
- Akses menu **Verifikasi QR**
- Paste data dan klik **Verifikasi**

## 🔐 QR Code Security

QR Code berisi data terenkripsi dengan format:
```json
{
  "rps_id": 1,
  "timestamp": 1234567890,
  "hash": "sha256_hash_value"
}
```

Hash digenerate menggunakan:
```php
hash('sha256', $rps_id . $app_key . $timestamp)
```

## 🚀 Development

### Run Development Server
```bash
php artisan serve
```

### Run Migration
```bash
php artisan migrate
```

### Rollback Migration
```bash
php artisan migrate:rollback
```

### Refresh Database with Seeder
```bash
php artisan migrate:fresh --seed
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

## 📝 TODO / Future Improvements

- [ ] Tambah sistem login & role management
- [ ] Multi-level approval (Dosen → Kaprodi → Dekan)
- [ ] Email notification untuk approval
- [ ] History tracking untuk perubahan RPS
- [ ] Template RPS yang customizable
- [ ] Export ke format Word (.docx)
- [ ] Dashboard analytics
- [ ] API untuk integrasi dengan sistem lain

## 🤝 Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## 📄 License

This project is open-sourced software licensed under the MIT license.

## 👨‍💻 Author

**FransisGIT**
- GitHub: [@FransisGIT](https://github.com/FransisGIT)

## 📞 Support

Jika ada pertanyaan atau issue, silakan buat issue di repository ini.

---

Made with ❤️ by FransisGIT