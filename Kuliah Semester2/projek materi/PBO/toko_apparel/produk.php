<?php
require_once 'koneksi.php';

class Katalog extends Database {
    
    public function tampilkanSemua($keyword = "") {
        if ($keyword != "") {
            $keyword = $this->conn->real_escape_string($keyword);
            $sql = "SELECT * FROM produk WHERE nama_produk LIKE '%$keyword%' OR kategori LIKE '%$keyword%'";
        } else {
            $sql = "SELECT * FROM produk";
        }

        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='table-responsive'>";
            echo "<table class='glass-table'>";
            echo "<thead>
                    <tr>
                        <th>ID</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga</th>
                        <th>Stok</th>
                    </tr>
                  </thead>";
            echo "<tbody>";
            
            while ($row = $result->fetch_assoc()) {
                $harga_rp = "Rp " . number_format($row['harga'], 0, ',', '.');
                $badge_class = ($row['kategori'] == 'Pakaian') ? 'badge-pakaian' : 'badge-aksesoris';

                echo "<tr>";
                echo "<td>#" . $row['id_produk'] . "</td>";
                echo "<td style='font-weight: 600; color: #fff;'>" . $row['nama_produk'] . "</td>";
                echo "<td><span class='badge {$badge_class}'>" . $row['kategori'] . "</span></td>";
                echo "<td>" . $harga_rp . "</td>";
                echo "<td>" . $row['stok'] . " pcs</td>";
                echo "</tr>";
            }
            
            echo "</tbody>";
            echo "</table>";
            echo "</div>";
        } else {
            echo "<div class='empty-state'><i class='fa-solid fa-box-open' style='font-size: 40px; margin-bottom: 10px; color: rgba(255,255,255,0.3);'></i><br>Produk tidak ditemukan, bro.</div>";
        }
    }
}

$kata_kunci = isset($_GET['cari']) ? $_GET['cari'] : "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Produk - Kuro Merch</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        
        body {
            background: linear-gradient(135deg, #0f0c29, #302b63, #24243e);
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
        }

        .glass-container {
            width: 100%; max-width: 1000px;
            background: rgba(255, 255, 255, 0.05); 
            backdrop-filter: blur(16px); -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1); 
            border-radius: 24px; 
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.5);
            padding: 40px; 
            display: flex; flex-direction: column; gap: 25px;
        }

        .header-content { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 20px; flex-wrap: wrap; gap: 15px; }
        
        /* Tombol Kembali & Judul */
        .title-group { display: flex; align-items: center; gap: 15px; }
        .title-group h2 { font-size: 24px; letter-spacing: 1px; }
        
        .btn-back {
            background: rgba(255, 255, 255, 0.1); color: #fff; text-decoration: none; padding: 10px 15px;
            border-radius: 12px; border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s;
            display: flex; align-items: center; justify-content: center;
        }
        .btn-back:hover { background: rgba(37, 117, 252, 0.2); border-color: #2575fc; box-shadow: 0 0 15px rgba(37, 117, 252, 0.3); transform: translateX(-5px); }

        .search-form { display: flex; gap: 10px; }
        .search-input { background: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.2); padding: 10px 18px; border-radius: 12px; color: #fff; outline: none; font-size: 14px; transition: all 0.3s; width: 250px; }
        .search-input::placeholder { color: rgba(255, 255, 255, 0.5); }
        .search-input:focus { border-color: #3498db; background: rgba(255, 255, 255, 0.1); box-shadow: 0 0 10px rgba(52, 152, 219, 0.3); width: 280px; }

        .btn-search { background: rgba(52, 152, 219, 0.2); color: #3498db; border: 1px solid rgba(52, 152, 219, 0.3); padding: 10px 15px; border-radius: 12px; cursor: pointer; transition: all 0.3s; }
        .btn-search:hover { background: #3498db; color: #fff; box-shadow: 0 0 15px rgba(52, 152, 219, 0.5); transform: translateY(-2px); }
        .btn-reset { background: rgba(231, 76, 60, 0.2); color: #e74c3c; border: 1px solid rgba(231, 76, 60, 0.3); text-decoration: none; padding: 10px 15px; border-radius: 12px; display: flex; align-items: center; transition: all 0.3s; }
        .btn-reset:hover { background: #e74c3c; color: #fff; box-shadow: 0 0 15px rgba(231, 76, 60, 0.5); }

        .table-responsive { width: 100%; overflow-x: auto; }
        .glass-table { width: 100%; border-collapse: collapse; }
        .glass-table th, .glass-table td { padding: 16px 20px; text-align: left; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .glass-table th { color: rgba(255, 255, 255, 0.7); font-weight: 600; text-transform: uppercase; font-size: 13px; letter-spacing: 1px; }
        .glass-table tr { transition: all 0.3s ease; }
        .glass-table tr:hover { background: rgba(255, 255, 255, 0.05); transform: translateY(-2px); }
        .glass-table td { color: rgba(255, 255, 255, 0.8); font-size: 15px; }

        .badge { padding: 6px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; display: inline-block; }
        .badge-pakaian { background: rgba(231, 76, 60, 0.2); color: #e74c3c; border: 1px solid rgba(231, 76, 60, 0.3); }
        .badge-aksesoris { background: rgba(52, 152, 219, 0.2); color: #3498db; border: 1px solid rgba(52, 152, 219, 0.3); }
        
        .empty-state { text-align: center; padding: 40px; color: rgba(255, 255, 255, 0.6); }
    </style>
</head>
<body>

    <div class="glass-container">
        <div class="header-content">
            <div class="title-group">
                <a href="index.php" class="btn-back" title="Kembali ke Dashboard">
                    <i class="fa-solid fa-arrow-left"></i>
                </a>
                <h2><i class="fa-solid fa-store"></i> Kuro Merch Catalog</h2>
            </div>
            
            <form method="GET" action="produk.php" class="search-form">
                <input type="text" name="cari" class="search-input" placeholder="Cari nama atau kategori..." value="<?= htmlspecialchars($kata_kunci) ?>">
                <button type="submit" class="btn-search" title="Cari"><i class="fa-solid fa-magnifying-glass"></i></button>
                
                <?php if($kata_kunci != ""): ?>
                    <a href="produk.php" class="btn-reset" title="Reset Pencarian"><i class="fa-solid fa-xmark"></i></a>
                <?php endif; ?>
            </form>
        </div>

        <?php
            $katalog = new Katalog();
            $katalog->tampilkanSemua($kata_kunci);
        ?>
    </div>

</body>
</html>
