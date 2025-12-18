# Dokumentasi Proyek Penilaian Mahasiswa

## Ikhtisar

Proyek ini adalah aplikasi web sederhana yang berfungsi sebagai **kalkulator nilai mahasiswa**. Aplikasi ini memungkinkan pengguna untuk memasukkan data mahasiswa beserta komponen nilai (kehadiran, tugas, UTS, dan UAS), kemudian menghitung nilai akhir, menentukan grade, dan status kelulusan berdasarkan aturan yang telah ditetapkan.

Antarmuka pengguna (UI) dibangun menggunakan **Bootstrap 5**, yang memberikan tampilan modern, responsif, dan mudah digunakan. Logika pemrosesan data diimplementasikan dengan **PHP**.

## Fitur Utama

- **Form Input Data**: Pengguna dapat memasukkan Nama, NIM, dan empat jenis nilai.
- **Perhitungan Nilai Akhir**: Sistem secara otomatis menghitung nilai akhir dengan bobot yang telah ditentukan.
- **Penentuan Grade**: Grade (A, B, C, D, E) diberikan berdasarkan rentang nilai akhir.
- **Penentuan Status Kelulusan**: Status "LULUS" atau "TIDAK LULUS" ditentukan berdasarkan beberapa kriteria.
- **Umpan Balik Visual**: Hasil penilaian ditampilkan dengan warna yang berbeda (hijau untuk lulus, merah untuk tidak lulus) untuk memberikan umpan balik yang jelas.
- **Desain Responsif**: Aplikasi dapat diakses dengan baik di berbagai perangkat, termasuk desktop dan seluler.

## Struktur File

- `index.php`: File tunggal yang berisi semua kode HTML, CSS, dan PHP.

## Logika Aplikasi

### 1. Pengambilan Input

Aplikasi dimulai dengan menampilkan form. Pengguna mengisi data berikut:
- **Nama**: Nama lengkap mahasiswa.
- **NIM**: Nomor Induk Mahasiswa.
- **Nilai Kehadiran**: Persentase kehadiran (0-100).
- **Nilai Tugas**: Nilai tugas (0-100).
- **Nilai UTS**: Nilai Ujian Tengah Semester (0-100).
- **Nilai UAS**: Nilai Ujian Akhir Semester (0-100).

### 2. Pemrosesan Data (PHP)

Setelah pengguna menekan tombol **"Proses"**, data form dikirim ke server melalui metode `POST`. Skrip PHP kemudian melakukan langkah-langkah berikut:

#### a. Validasi dan Pengambilan Data

- `isset($_POST['proses'])`: Memeriksa apakah form telah disubmit.
- `htmlspecialchars()`: Membersihkan input untuk mencegah serangan XSS.
- `floatval()`: Mengonversi input nilai dari string menjadi angka desimal (float) agar dapat dihitung.

#### b. Perhitungan Nilai Akhir

Nilai akhir dihitung menggunakan rumus berbobot:

```php
$nilai_akhir = ($kehadiran * 0.1) + ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.4);
```

- **Bobot Kehadiran**: 10%
- **Bobot Tugas**: 20%
- **Bobot UTS**: 30%
- **Bobot UAS**: 40%

#### c. Penentuan Grade

Grade ditentukan berdasarkan `nilai_akhir`:

| Rentang Nilai | Grade |
|---------------|-------|
| >= 85         | A     |
| >= 70         | B     |
| >= 55         | C     |
| >= 40         | D     |
| < 40          | E     |

#### d. Penentuan Status Kelulusan

Status kelulusan memiliki aturan yang lebih kompleks. Seorang mahasiswa dinyatakan **LULUS** jika **semua** kondisi berikut terpenuhi:

1. `nilai_akhir` >= 60
2. `kehadiran` > 70
3. `tugas` >= 40
4. `uts` >= 40
5. `uas` >= 40

Jika salah satu dari kondisi di atas tidak terpenuhi, statusnya adalah **TIDAK LULUS**.

### 3. Tampilan Hasil

Hasil perhitungan ditampilkan di bawah form dalam sebuah kartu (card). Tampilan kartu ini disesuaikan berdasarkan status kelulusan:

- **Jika LULUS**: Header kartu, tombol, dan teks status akan berwarna **hijau**.
- **Jika TIDAK LULUS**: Header kartu, tombol, dan teks status akan berwarna **merah**.

Ini memberikan umpan balik visual yang cepat dan intuitif kepada pengguna.

## Keamanan

Keamanan adalah aspek penting dalam pengembangan web. Meskipun aplikasi ini sederhana, langkah-langkah dasar telah diambil untuk mengamankan input pengguna:

- **Pencegahan Cross-Site Scripting (XSS)**: Semua data yang dimasukkan oleh pengguna (Nama dan NIM) dibersihkan menggunakan fungsi PHP `htmlspecialchars()`. Fungsi ini mengubah karakter khusus HTML (seperti `<` dan `>`) menjadi entitas HTML (seperti `&lt;` dan `&gt;`). Ini memastikan bahwa jika pengguna mencoba memasukkan kode berbahaya (misalnya, skrip JavaScript) ke dalam form, kode tersebut tidak akan dieksekusi oleh browser, melainkan hanya ditampilkan sebagai teks biasa. Ini adalah praktik standar untuk melindungi aplikasi dari serangan XSS.

## Cara Menjalankan Proyek

1. Pastikan Anda memiliki server web lokal (misalnya, XAMPP, Laragon, atau WAMP) dengan dukungan PHP.
2. Tempatkan file `index.php` di dalam direktori root server web Anda (misalnya, `htdocs` untuk XAMPP atau `www` untuk Laragon).
3. Buka browser web dan akses file tersebut melalui `http://localhost/nama_folder_proyek/index.php`.
4. Isi form dan klik tombol "Proses" untuk melihat hasilnya.