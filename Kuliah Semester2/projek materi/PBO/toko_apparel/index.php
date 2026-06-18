<?php
// index.php - Dashboard Admin Kuro Merch
require_once 'koneksi.php';

class Dashboard extends Database {
    public function getTotalProduk() {
        $sql = "SELECT COUNT(id_produk) as total FROM produk";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total'];
    }

    public function getTotalStok() {
        $sql = "SELECT SUM(stok) as total_stok FROM produk";
        $result = $this->conn->query($sql);
        $row = $result->fetch_assoc();
        return $row['total_stok'] ? $row['total_stok'] : 0;
    }

    // Method baru untuk mengisi ruang kosong di dashboard
    public function getProdukTerbaru() {
        $sql = "SELECT * FROM produk ORDER BY id_produk DESC LIMIT 4";
        return $this->conn->query($sql);
    }
}

$dash = new Dashboard();
$jml_produk = $dash->getTotalProduk();
$jml_stok = $dash->getTotalStok();
$produk_terbaru = $dash->getProdukTerbaru();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuro Merch - Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(45deg, #0f0c29, #302b63, #24243e, #0f2027); background-size: 400% 400%; animation: gradientBG 15s ease infinite; color: #fff; min-height: 100vh; display: flex; justify-content: center; padding: 20px; overflow-x: hidden; }
        @keyframes gradientBG { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }

        .glass-container { width: 100%; max-width: 1200px; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 24px; box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3); display: flex; z-index: 10; }
        
        .sidebar { width: 260px; background: rgba(255, 255, 255, 0.02); border-right: 1px solid rgba(255, 255, 255, 0.1); padding: 30px 20px; display: flex; flex-direction: column; gap: 15px; }
        .brand { font-size: 24px; font-weight: 700; color: #fff; text-shadow: 0 0 10px rgba(255,255,255,0.5); margin-bottom: 30px; text-align: center; }
        .nav-link { text-decoration: none; color: rgba(255, 255, 255, 0.7); padding: 12px 20px; border-radius: 12px; font-weight: 600; transition: all 0.3s ease; display: flex; align-items: center; gap: 12px; }
        .nav-link:hover, .nav-link.active { color: #fff; background: rgba(255, 255, 255, 0.15); }
        .btn-store { background: rgba(37, 117, 252, 0.2); color: #2575fc; margin-top: auto; border: 1px solid rgba(37, 117, 252, 0.3); justify-content: center; }
        .btn-store:hover { background: #2575fc; color: #fff; }

        .content { flex: 1; padding: 40px; display: flex; flex-direction: column; gap: 25px; }
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 20px; }
        .user-profile { background: rgba(255, 255, 255, 0.1); padding: 8px 16px; border-radius: 20px; font-weight: 600; border: 1px solid rgba(255, 255, 255, 0.2); }

        .stats-container { display: flex; gap: 20px; }
        .stat-box { background: linear-gradient(135deg, rgba(255,255,255,0.1), rgba(255,255,255,0.02)); border: 1px solid rgba(255,255,255,0.1); border-radius: 16px; padding: 20px; flex: 1; display: flex; align-items: center; gap: 20px; }
        .stat-icon { font-size: 36px; color: #2575fc; }
        .stat-info h4 { font-size: 14px; color: rgba(255,255,255,0.6); font-weight: 400; }
        .stat-info h2 { font-size: 28px; font-weight: 700; }

        .card-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; }
        .glass-card { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 16px; padding: 25px; text-decoration: none; color: #fff; transition: 0.3s; display: block; }
        .glass-card:hover { transform: translateY(-5px); background: rgba(255, 255, 255, 0.1); border-color: rgba(37, 117, 252, 0.5); box-shadow: 0 10px 20px rgba(0,0,0,0.2); }
        .card-icon { font-size: 30px; margin-bottom: 15px; color: #2575fc; }

        /* Tabel Tambahan untuk Mengisi Ruang */
        .recent-section { background: rgba(0,0,0,0.15); border-radius: 16px; padding: 20px; border: 1px solid rgba(255,255,255,0.05); }
        .recent-section h3 { font-size: 16px; margin-bottom: 15px; color: rgba(255,255,255,0.8); }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); font-size: 14px; }
        th { color: rgba(255,255,255,0.5); font-weight: 600; text-transform: uppercase; font-size: 12px; }
    </style>
</head>
<body>

    <div class="glass-container">
        <div class="sidebar">
            <div class="brand"><i class="fa-solid fa-shirt"></i> KURO</div>
            <a href="index.php" class="nav-link active"><i class="fa-solid fa-chart-pie"></i> Dashboard</a>
            <a href="produk.php" class="nav-link"><i class="fa-solid fa-box-open"></i> Data Produk</a>
            <a href="#" class="nav-link"><i class="fa-solid fa-cart-shopping"></i> Kasir</a>
            
            <a href="toko.php" class="nav-link btn-store"><i class="fa-solid fa-store"></i> Lihat Toko</a>
        </div>

        <div class="content">
            <div class="header">
                <div>
                    <h2>Dashboard Admin</h2>
                    <p style="color: rgba(255,255,255,0.7); font-size: 14px;">Ringkasan sistem inventori toko hari ini.</p>
                </div>
                <div class="user-profile"><i class="fa-solid fa-user-ninja"></i> Fatih</div>
            </div>

            <div class="stats-container">
                <div class="stat-box">
                    <i class="fa-solid fa-tags stat-icon"></i>
                    <div class="stat-info">
                        <h4>Total Item Produk</h4>
                        <h2><?= $jml_produk ?></h2>
                    </div>
                </div>
                <div class="stat-box">
                    <i class="fa-solid fa-boxes-stacked stat-icon"></i>
                    <div class="stat-info">
                        <h4>Total Stok Gudang</h4>
                        <h2><?= $jml_stok ?></h2>
                    </div>
                </div>
            </div>

            <div class="card-grid">
                <a href="produk.php" class="glass-card">
                    <i class="fa-solid fa-boxes-packing card-icon"></i>
                    <h3>Kelola Produk</h3>
                    <p style="font-size: 12px; color: rgba(255,255,255,0.6);">Lihat daftar apparel, dan edit harga.</p>
                </a>
                <a href="#" class="glass-card">
                    <i class="fa-solid fa-cash-register card-icon"></i>
                    <h3>Kasir Transaksi</h3>
                    <p style="font-size: 12px; color: rgba(255,255,255,0.6);">Sistem Point of Sale (POS) toko.</p>
                </a>
            </div>

            <div class="recent-section">
                <h3><i class="fa-solid fa-clock-rotate-left"></i> Produk Terakhir Ditambahkan</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Sisa Stok</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = $produk_terbaru->fetch_assoc()): ?>
                        <tr>
                            <td style="font-weight: 600;"><?= $row['nama_produk'] ?></td>
                            <td><?= $row['kategori'] ?></td>
                            <td>Rp <?= number_format($row['harga'], 0, ',', '.') ?></td>
                            <td><?= $row['stok'] ?> pcs</td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</body>
</html>
