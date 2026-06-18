<?php
// Memanggil class yang sudah kita buat sebelumnya
require_once 'TiketRegular.php';
require_once 'TiketIMAX.php';
require_once 'TiketVelvet.php';

// 1. Konfigurasi Koneksi Database
$host = "localhost";
$user = "root"; // Sesuaikan jika user MySQL kamu beda (default XAMPP adalah root)
$pass = "";     // Kosongkan jika tidak ada password
$db   = "DB_LATIHAN_PBO_TI-1D_MUHAMMADFATIHABDULAZIZ"; // Sesuai nama database Tahap 1

$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi database gagal: " . $conn->connect_error);
}

// 2. Mengambil data dari database
$sql = "SELECT * FROM tabel_tiket ORDER BY jenis_studio, jadwal_tayang";
$result = $conn->query($sql);

// Array untuk mengelompokkan data berdasarkan jenis studio
$tiket_terkelompok = [
    'Regular' => [],
    'IMAX'    => [],
    'Velvet'  => []
];

// 3. Proses Instansiasi Objek (Mengubah baris data menjadi Objek PHP)
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Seleksi untuk membuat objek sesuai kelas anaknya
        if ($row['jenis_studio'] == 'Regular') {
            $tiket = new TiketRegular($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['tipe_audio'], $row['lokasi_baris']);
            $tiket_terkelompok['Regular'][] = $tiket;
        } elseif ($row['jenis_studio'] == 'IMAX') {
            $tiket = new TiketIMAX($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['kacamata_3d_id'], $row['efek_gerak_fitur']);
            $tiket_terkelompok['IMAX'][] = $tiket;
        } elseif ($row['jenis_studio'] == 'Velvet') {
            $tiket = new TiketVelvet($row['id_tiket'], $row['nama_film'], $row['jadwal_tayang'], $row['jumlah_kursi'], $row['harga_dasar_tiket'], $row['bantal_selimut_pack'], $row['layanan_butler']);
            $tiket_terkelompok['Velvet'][] = $tiket;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pemesanan Tiket Bioskop</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; padding: 20px; background-color: #f9f9f9; }
        h1 { text-align: center; color: #333; }
        .kategori-title { background-color: #2c3e50; color: white; padding: 10px; border-radius: 5px; margin-top: 30px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; background-color: white; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #e2e8f0; color: #333; }
        tr:hover { background-color: #f1f5f9; }
    </style>
</head>
<body>

    <h1>Data Pemesanan Tiket Bioskop</h1>

    <?php foreach ($tiket_terkelompok as $jenis => $daftar_tiket): ?>
        <h2 class="kategori-title">Kategori Studio: <?= $jenis ?></h2>
        
        <?php if (count($daftar_tiket) > 0): ?>
            <table>
                <thead>
                    <tr>
                        <th>Nama Film</th>
                        <th>Jadwal Tayang</th>
                        <th>Fasilitas Spesifik</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($daftar_tiket as $tiket): ?>
                        <tr>
                            <td><?= htmlspecialchars($tiket->getNamaFilm()) ?></td>
                            <td><?= htmlspecialchars($tiket->getJadwalTayang()) ?></td>
                            
                            <td><?= htmlspecialchars($tiket->tampilkanInfoFasilitas()) ?></td>
                            <td><strong>Rp <?= number_format($tiket->hitungTotalHarga(), 0, ',', '.') ?></strong></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Belum ada data untuk kategori studio ini.</p>
        <?php endif; ?>
    <?php endforeach; ?>

</body>
</html>

