<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bagian head berisi metadata dan link ke resource eksternal. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penilaian Mahasiswa</title>

    <!-- Link ke stylesheet Bootstrap untuk styling. -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">

    <!-- Link ke JavaScript Bootstrap untuk komponen interaktif. -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-j1CDi7MgGQ12Z7Qab0qlWQ/Qqz24Gc6BM0thvEMVjHnfYGF0rmFCozFSxQBxwHKO"
        crossorigin="anonymous"></script>

    <!-- Gaya CSS kustom untuk halaman. -->
    <style>
        body {
            background-color: #f8f9fa; /* Latar belakang abu-abu muda untuk seluruh halaman. */
        }

        .card-header {
            background-color: #007bff; /* Header kartu dengan latar belakang biru. */
            color: white; /* Teks putih pada header kartu. */
        }

        .form-label {
            font-weight: bold; /* Membuat teks label form menjadi tebal. */
        }
    </style>
</head>

<body>
    <!-- Kontainer utama yang membungkus konten halaman. -->
    <div class="container mt-4 mb-5 px-5">
        <!-- Kartu (card) sebagai wadah untuk form penilaian. -->
        <div class="card shadow-sm">
            
            <!-- Header kartu yang berisi judul form. -->
            <div class="card-header text-center">
                <h1 class="h4 mb-0">Form Penilaian Mahasiswa</h1>
            </div>

            <!-- Badan kartu yang berisi form input. -->
            <div class="card-body">
                
                <!-- Form untuk mengirim data penilaian. Data dikirim dengan metode POST. -->
                <form method="post">
                    
                    <!-- Input untuk Nama Mahasiswa -->
                    <div class="mb-3">
                        <label for="nama" class="form-label">Masukkan Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Agus" required value="<?php echo isset($_POST['nama']) ? $_POST['nama'] : ''; ?>">
                    </div>

                    <!-- Input untuk NIM Mahasiswa -->
                    <div class="mb-3">
                        <label for="nim" class="form-label">Masukkan NIM</label>
                        <input type="text" class="form-control" id="nim" name="nim" placeholder="202332xxx" required value="<?php echo isset($_POST['nim']) ? $_POST['nim'] : ''; ?>">
                    </div>

                    <!-- Input untuk Nilai Kehadiran -->
                    <div class="mb-3">
                        <label for="kehadiran" class="form-label">Nilai Kehadiran (10%)</label>
                        <input type="number" class="form-control" id="kehadiran" name="kehadiran" placeholder="Untuk Lulus minimal 70%" min="0" max="100" required value="<?php echo isset($_POST['kehadiran']) ? $_POST['kehadiran'] : ''; ?>">
                    </div>

                    <!-- Input untuk Nilai Tugas -->
                    <div class="mb-3">
                        <label for="tugas" class="form-label">Nilai Tugas (20%)</label>
                        <input type="number" class="form-control" id="tugas" name="tugas" placeholder="0 - 100" min="0" max="100" required value="<?php echo isset($_POST['tugas']) ? $_POST['tugas'] : ''; ?>">
                    </div>

                    <!-- Input untuk Nilai UTS -->
                    <div class="mb-3">
                        <label for="uts" class="form-label">Nilai UTS (30%)</label>
                        <input type="number" class="form-control" id="uts" name="uts" placeholder="0 - 100" min="0" max="100" required value="<?php echo isset($_POST['uts']) ? $_POST['uts'] : ''; ?>">
                    </div>

                    <!-- Input untuk Nilai UAS -->
                    <div class="mb-3">
                        <label for="uas" class="form-label">Nilai UAS (40%)</label>
                        <input type="number" class="form-control" id="uas" name="uas" placeholder="0 - 100" min="0" max="100" required value="<?php echo isset($_POST['uas']) ? $_POST['uas'] : ''; ?>">
                    </div>

                    <!-- Tombol untuk memproses form. -->
                    <div class="d-grid gap-2">
                        <button type="submit" name="proses" class="btn btn-primary">Proses</button>
                    </div>
                </form>

                <?php
                // Blok PHP ini akan dieksekusi setelah pengguna menekan tombol "Proses".
                // Ini memeriksa apakah form telah disubmit sebelum menjalankan logika penilaian.
                if (isset($_POST['proses'])) {
                    
                    
                    // Mengambil data yang diinputkan oleh pengguna dari form.
                    // htmlspecialchars() digunakan untuk keamanan, mencegah serangan Cross-Site Scripting (XSS).
                    $nama = htmlspecialchars($_POST['nama']); // Mengambil dan membersihkan input nama.
                    $nim = htmlspecialchars($_POST['nim']);   // Mengambil dan membersihkan input NIM.
                    
                    // floatval() mengubah input teks menjadi angka desimal (float).
                    // Ini penting agar nilai-nilai ini dapat digunakan dalam perhitungan matematis.
                    $kehadiran = floatval($_POST['kehadiran']); // Mengambil nilai kehadiran.
                    $tugas = floatval($_POST['tugas']);       // Mengambil nilai tugas.
                    $uts = floatval($_POST['uts']);           // Mengambil nilai UTS.
                    $uas = floatval($_POST['uas']);           // Mengambil nilai UAS.

                    
                    // Menghitung nilai akhir berdasarkan bobot yang telah ditentukan:
                    // Kehadiran: 10%, Tugas: 20%, UTS: 30%, UAS: 40%.
                    $nilai_akhir = ($kehadiran * 0.1) + ($tugas * 0.2) + ($uts * 0.3) + ($uas * 0.4);

                   
                    // Menggunakan struktur if-elseif-else untuk menentukan grade (A, B, C, D, E).
                    $grade = '';
                    if ($nilai_akhir >= 85) {
                        $grade = 'A'; // Nilai 85 ke atas.
                    } elseif ($nilai_akhir >= 70) {
                        $grade = 'B'; // Nilai 70 hingga 84.99.
                    } elseif ($nilai_akhir >= 55) {
                        $grade = 'C'; // Nilai 55 hingga 69.99.
                    } elseif ($nilai_akhir >= 40) {
                        $grade = 'D'; // Nilai 40 hingga 54.99.
                    } else {
                        $grade = 'E'; // Nilai di bawah 40.
                    }

                    
                    // Status default diatur sebagai "TIDAK LULUS".
                    // Status akan berubah menjadi "LULUS" hanya jika semua kondisi terpenuhi.
                    $status = "TIDAK LULUS";
                    
                    // Kondisi kelulusan yang kompleks:
                    // 1. Nilai akhir harus 60 atau lebih.
                    // 2. Kehadiran harus lebih dari 70%.
                    // 3. Nilai tugas, UTS, dan UAS masing-masing harus minimal 40.
                    if ($nilai_akhir >= 60 && $kehadiran > 70 && $tugas >= 40 && $uts >= 40 && $uas >= 40) {
                        $status = "LULUS";
                    }

                
                    // Mengatur kelas CSS untuk memberikan feedback visual kepada pengguna.
                    // Hijau untuk "LULUS" dan Merah untuk "TIDAK LULUS".
                    if ($status == "LULUS") {
                        $bg_class = "bg-success";        // Latar belakang header kartu hasil.
                        $btn_class = "btn-success";      // Warna tombol "Selesai".
                        $border_class = "border-success"; // Warna border kartu hasil.
                        $text_status_color = "text-success"; // Warna teks status.
                    } else {
                        $bg_class = "bg-danger";         // Latar belakang header kartu hasil.
                        $btn_class = "btn-danger";       // Warna tombol "Selesai".
                        $border_class = "border-danger"; // Warna border kartu hasil.
                        $text_status_color = "text-danger"; // Warna teks status.
                    }
                ?>

                <!-- Bagian ini menampilkan hasil penilaian setelah form diproses. -->
                <div class="card mt-4 <?php echo $border_class; ?>">
                    
                    <!-- Header Kartu Hasil -->
                    <div class="card-header <?php echo $bg_class; ?> text-white">
                        <h5 class="mb-0">Hasil Penilaian</h5>
                    </div>

                    <!-- Isi Kartu Hasil -->
                    <div class="card-body">
                        <!-- Menampilkan Nama dan NIM Mahasiswa -->
                        <div class="row mb-3">
                            <div class="col-md-6 text-center">
                                <h5>Nama: <strong><?php echo $nama; ?></strong></h5>
                            </div>
                            <div class="col-md-6 text-center">
                                <h5>NIM: <strong><?php echo $nim; ?></strong></h5>
                            </div>
                        </div>

                        <!-- Rincian Nilai yang Diinput -->
                        <ul class="list-unstyled">
                            <li>Nilai Kehadiran: <strong><?php echo $kehadiran; ?>%</strong></li>
                            <li>Nilai Tugas: <strong><?php echo $tugas; ?></strong></li>
                            <li>Nilai UTS: <strong><?php echo $uts; ?></strong></li>
                            <li>Nilai UAS: <strong><?php echo $uas; ?></strong></li>
                        </ul>
                        
                        <hr>
                        
                        <!-- Hasil Akhir, Grade, dan Status Kelulusan -->
                        <h5 class="mb-1">Nilai Akhir: <strong><?php echo number_format($nilai_akhir, 2); ?></strong></h5>
                        <h5 class="mb-1">Grade: <strong><?php echo $grade; ?></strong></h5>
                        <h5 class="mb-3">Status: <strong class="<?php echo $text_status_color; ?>"><?php echo $status; ?></strong></h5>

                        <!-- Tombol untuk Kembali atau Mengulang -->
                        <div class="d-grid gap-2">
                            <a href="" class="btn <?php echo $btn_class; ?>">Selesai</a>
                        </div>
                    </div>
                </div>

                <?php
                } // Akhir dari blok if (isset($_POST['proses'])).
                ?>

            </div>
        </div>
    </div>
</body>

</html>