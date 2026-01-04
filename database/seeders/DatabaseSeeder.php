<?php

namespace Database\Seeders;

use App\Models\MataKuliah;
use App\Models\RPS;
use App\Models\RpsPertemuan;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seed Mata Kuliah
        $mataKuliah = [
            [
                'kode_mk' => 'TI101',
                'nama_mk' => 'Pemrograman Web',
                'sks' => 3,
                'semester' => 5,
                'prodi' => 'Teknik Informatika',
                'deskripsi' => 'Mata kuliah yang membahas tentang pengembangan aplikasi web menggunakan HTML, CSS, JavaScript, dan PHP'
            ],
            [
                'kode_mk' => 'TI102',
                'nama_mk' => 'Basis Data',
                'sks' => 3,
                'semester' => 3,
                'prodi' => 'Teknik Informatika',
                'deskripsi' => 'Mata kuliah yang membahas konsep dan implementasi sistem basis data'
            ],
            [
                'kode_mk' => 'TI103',
                'nama_mk' => 'Algoritma dan Struktur Data',
                'sks' => 4,
                'semester' => 2,
                'prodi' => 'Teknik Informatika',
                'deskripsi' => 'Mata kuliah tentang algoritma dan struktur data fundamental'
            ],
            [
                'kode_mk' => 'TI104',
                'nama_mk' => 'Pemrograman Berorientasi Objek',
                'sks' => 3,
                'semester' => 4,
                'prodi' => 'Teknik Informatika',
                'deskripsi' => 'Mata kuliah tentang konsep dan implementasi pemrograman berorientasi objek'
            ],
            [
                'kode_mk' => 'TI105',
                'nama_mk' => 'Jaringan Komputer',
                'sks' => 3,
                'semester' => 5,
                'prodi' => 'Teknik Informatika',
                'deskripsi' => 'Mata kuliah tentang konsep dan protokol jaringan komputer'
            ],
            [
                'kode_mk' => 'SI101',
                'nama_mk' => 'Sistem Informasi Manajemen',
                'sks' => 3,
                'semester' => 4,
                'prodi' => 'Sistem Informasi',
                'deskripsi' => 'Mata kuliah tentang pengelolaan sistem informasi dalam organisasi'
            ],
            [
                'kode_mk' => 'SI102',
                'nama_mk' => 'Analisis dan Perancangan Sistem',
                'sks' => 3,
                'semester' => 5,
                'prodi' => 'Sistem Informasi',
                'deskripsi' => 'Mata kuliah tentang metodologi analisis dan perancangan sistem informasi'
            ]
        ];

        $mkRecords = [];
        foreach ($mataKuliah as $mk) {
            $mkRecords[] = MataKuliah::create($mk);
        }

        // Seed RPS 1 - Pemrograman Web (Final)
        $rps1 = RPS::create([
            'mata_kuliah_id' => $mkRecords[0]->id,
            'tahun_ajaran' => '2025/2026',
            'semester' => 'Ganjil',
            'dosen_pengampu' => 'Dr. Ahmad Fauzi, M.Kom',
            'capaian_pembelajaran' => 'Mahasiswa mampu mengembangkan aplikasi web dinamis menggunakan HTML, CSS, JavaScript, PHP, dan MySQL. Mahasiswa dapat menerapkan konsep MVC, REST API, dan keamanan aplikasi web.',
            'prasyarat' => 'Algoritma dan Pemrograman',
            'referensi' => "1. Robin Nixon - Learning PHP, MySQL & JavaScript, O'Reilly Media\n2. Jon Duckett - HTML and CSS: Design and Build Websites\n3. David Flanagan - JavaScript: The Definitive Guide",
            'metode_pembelajaran' => 'Ceramah, Diskusi, Praktikum, Project-Based Learning',
            'metode_penilaian' => 'Tugas (20%), UTS (30%), UAS (30%), Project (20%)',
            'status' => 'Final'
        ]);

        $pertemuanRps1 = [
            ['pertemuan_ke' => 1, 'materi' => 'Pengenalan Web Development dan HTML5 Dasar', 'metode' => 'Ceramah dan Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 2, 'materi' => 'CSS3 dan Responsive Design', 'metode' => 'Ceramah dan Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 3, 'materi' => 'Bootstrap Framework', 'metode' => 'Praktikum dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 4, 'materi' => 'JavaScript Fundamentals', 'metode' => 'Ceramah dan Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 5, 'materi' => 'DOM Manipulation dan Event Handling', 'metode' => 'Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 6, 'materi' => 'AJAX dan Fetch API', 'metode' => 'Praktikum dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 7, 'materi' => 'jQuery Library', 'metode' => 'Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 8, 'materi' => 'Ujian Tengah Semester', 'metode' => 'Ujian Tertulis', 'waktu' => 120],
            ['pertemuan_ke' => 9, 'materi' => 'Pengenalan PHP dan Sintaks Dasar', 'metode' => 'Ceramah dan Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 10, 'materi' => 'PHP Forms dan Validasi', 'metode' => 'Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 11, 'materi' => 'PHP Sessions dan Cookies', 'metode' => 'Praktikum dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 12, 'materi' => 'MySQL Database dan SQL', 'metode' => 'Ceramah dan Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 13, 'materi' => 'PHP MySQL Integration (CRUD Operations)', 'metode' => 'Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 14, 'materi' => 'MVC Architecture dan Framework Introduction', 'metode' => 'Ceramah dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 15, 'materi' => 'Web Security Best Practices', 'metode' => 'Ceramah dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 16, 'materi' => 'Ujian Akhir Semester dan Presentasi Project', 'metode' => 'Ujian dan Presentasi', 'waktu' => 180]
        ];

        foreach ($pertemuanRps1 as $p) {
            RpsPertemuan::create(array_merge(['rps_id' => $rps1->id], $p));
        }

        // Seed RPS 2 - Basis Data (Draft)
        $rps2 = RPS::create([
            'mata_kuliah_id' => $mkRecords[1]->id,
            'tahun_ajaran' => '2025/2026',
            'semester' => 'Ganjil',
            'dosen_pengampu' => 'Dr. Siti Nurhaliza, M.T',
            'capaian_pembelajaran' => 'Mahasiswa mampu memahami konsep sistem basis data, melakukan perancangan basis data menggunakan ER diagram dan normalisasi, serta mengimplementasikan basis data menggunakan SQL dan sistem manajemen basis data.',
            'prasyarat' => null,
            'referensi' => "1. Ramez Elmasri & Shamkant Navathe - Fundamentals of Database Systems\n2. Abraham Silberschatz - Database System Concepts\n3. C.J. Date - An Introduction to Database Systems",
            'metode_pembelajaran' => 'Ceramah, Diskusi, Studi Kasus, Praktikum',
            'metode_penilaian' => 'Tugas (25%), UTS (30%), Praktikum (20%), UAS (25%)',
            'status' => 'Draft'
        ]);

        $pertemuanRps2 = [
            ['pertemuan_ke' => 1, 'materi' => 'Pengenalan Sistem Basis Data dan DBMS', 'metode' => 'Ceramah', 'waktu' => 150],
            ['pertemuan_ke' => 2, 'materi' => 'Model Data dan Arsitektur Database', 'metode' => 'Ceramah dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 3, 'materi' => 'Entity-Relationship (ER) Model', 'metode' => 'Ceramah dan Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 4, 'materi' => 'Enhanced ER Model dan Mapping', 'metode' => 'Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 5, 'materi' => 'Relational Model dan Relational Algebra', 'metode' => 'Ceramah dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 6, 'materi' => 'SQL - Data Definition Language (DDL)', 'metode' => 'Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 7, 'materi' => 'SQL - Data Manipulation Language (DML)', 'metode' => 'Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 8, 'materi' => 'Ujian Tengah Semester', 'metode' => 'Ujian Tertulis', 'waktu' => 120],
            ['pertemuan_ke' => 9, 'materi' => 'SQL Advanced Queries dan Join Operations', 'metode' => 'Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 10, 'materi' => 'Normalisasi Database (1NF, 2NF, 3NF)', 'metode' => 'Ceramah dan Studi Kasus', 'waktu' => 150],
            ['pertemuan_ke' => 11, 'materi' => 'BCNF dan Denormalisasi', 'metode' => 'Ceramah dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 12, 'materi' => 'Transaction Management dan Concurrency Control', 'metode' => 'Ceramah', 'waktu' => 150],
            ['pertemuan_ke' => 13, 'materi' => 'Database Security dan Authorization', 'metode' => 'Ceramah dan Praktikum', 'waktu' => 150],
            ['pertemuan_ke' => 14, 'materi' => 'Database Recovery dan Backup Strategies', 'metode' => 'Ceramah dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 15, 'materi' => 'NoSQL dan Modern Database Systems', 'metode' => 'Ceramah dan Diskusi', 'waktu' => 150],
            ['pertemuan_ke' => 16, 'materi' => 'Ujian Akhir Semester', 'metode' => 'Ujian Tertulis', 'waktu' => 120]
        ];

        foreach ($pertemuanRps2 as $p) {
            RpsPertemuan::create(array_merge(['rps_id' => $rps2->id], $p));
        }
    }
}
