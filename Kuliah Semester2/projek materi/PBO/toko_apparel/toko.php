<?php
// toko.php - Sisi Pembeli (Katalog)
require_once 'koneksi.php';

class Storefront extends Database {
    public function tampilkanKatalog($keyword = "", $kategori = "") {
        // Melindungi dari SQL Injection
        $keyword = $this->conn->real_escape_string($keyword);
        $kategori = $this->conn->real_escape_string($kategori);

        $sql = "SELECT * FROM produk WHERE stok > 0";
        
        // Logika Filter dan Pencarian
        if ($kategori != "") {
            $sql .= " AND kategori = '$kategori'";
        }
        if ($keyword != "") {
            $sql .= " AND nama_produk LIKE '%$keyword%'";
        }
        
        $sql .= " ORDER BY id_produk DESC";
        $result = $this->conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='product-grid'>";
            while ($row = $result->fetch_assoc()) {
                $harga_rp = "Rp " . number_format($row['harga'], 0, ',', '.');
                $badge_class = ($row['kategori'] == 'Pakaian') ? 'badge-pakaian' : 'badge-aksesoris';
                $icon = ($row['kategori'] == 'Pakaian') ? 'fa-shirt' : 'fa-glasses';

                echo "
                <div class='product-card'>
                    <div class='product-image'><i class='fa-solid {$icon}'></i></div>
                    <div class='product-info'>
                        <span class='badge {$badge_class}'>{$row['kategori']}</span>
                        <h3 class='product-title'>{$row['nama_produk']}</h3>
                        <p class='product-price'>{$harga_rp}</p>
                        <div class='product-footer'>
                            <span class='product-stock'>Sisa: {$row['stok']} pcs</span>
                            <button class='btn-buy' onclick=\"tambahKeKeranjang('{$row['id_produk']}', '{$row['nama_produk']}', {$row['harga']})\">
                                <i class='fa-solid fa-cart-plus'></i> Beli
                            </button>
                        </div>
                    </div>
                </div>";
            }
            echo "</div>";
        } else {
            echo "<div class='empty-state'><i class='fa-solid fa-box-open' style='font-size:40px; margin-bottom:10px;'></i><br>Produk tidak ditemukan.</div>";
        }
    }
}

$cari = isset($_GET['cari']) ? $_GET['cari'] : "";
$kategori_aktif = isset($_GET['kategori']) ? $_GET['kategori'] : "";
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kuro Merch - Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); color: #fff; min-height: 100vh; }
        
        .navbar { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px); border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding: 15px 50px; display: flex; justify-content: space-between; align-items: center; position: sticky; top: 0; z-index: 100; }
        .brand { font-size: 24px; font-weight: 700; color: #fff; text-decoration: none; }
        .nav-menu { display: flex; gap: 20px; align-items: center; }
        .btn-nav { color: rgba(255,255,255,0.8); text-decoration: none; font-weight: 600; padding: 8px 15px; border-radius: 8px; transition: 0.3s; display: flex; align-items: center; gap: 8px; border: 1px solid transparent; }
        .btn-nav:hover { background: rgba(255,255,255,0.1); color: #fff; border-color: rgba(255,255,255,0.2); }
        .cart-icon { background: rgba(37, 117, 252, 0.2); color: #2575fc !important; border: 1px solid rgba(37, 117, 252, 0.3); position: relative; }
        .cart-count { position: absolute; top: -5px; right: -5px; background: #e74c3c; color: #fff; font-size: 11px; padding: 2px 7px; border-radius: 50%; font-weight: bold; }

        .container { max-width: 1200px; margin: 30px auto; padding: 0 20px; }
        
        /* Filter & Search Bar */
        .toolbar { background: rgba(255, 255, 255, 0.05); padding: 20px; border-radius: 15px; border: 1px solid rgba(255, 255, 255, 0.1); display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; flex-wrap: wrap; gap: 15px; }
        .categories { display: flex; gap: 10px; }
        .cat-btn { padding: 8px 16px; border-radius: 20px; text-decoration: none; font-size: 14px; font-weight: 600; color: #fff; background: rgba(255,255,255,0.1); border: 1px solid rgba(255,255,255,0.2); transition: 0.3s; }
        .cat-btn:hover, .cat-btn.active { background: #2575fc; border-color: #2575fc; box-shadow: 0 0 15px rgba(37, 117, 252, 0.4); }
        .search-form { display: flex; gap: 10px; }
        .search-input { padding: 10px 15px; border-radius: 10px; border: 1px solid rgba(255,255,255,0.2); background: rgba(0,0,0,0.2); color: #fff; outline: none; width: 250px; }
        .btn-search { padding: 10px 15px; border-radius: 10px; border: none; background: #2575fc; color: #fff; cursor: pointer; font-weight: bold; }

        .product-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px; }
        .product-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 15px; overflow: hidden; transition: 0.3s; display: flex; flex-direction: column; }
        .product-card:hover { transform: translateY(-5px); box-shadow: 0 10px 20px rgba(0,0,0,0.3); border-color: rgba(37, 117, 252, 0.4); }
        .product-image { height: 160px; background: rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; font-size: 50px; color: rgba(255,255,255,0.2); transition: 0.3s; }
        .product-card:hover .product-image { color: #2575fc; }
        .product-info { padding: 20px; display: flex; flex-direction: column; flex: 1; }
        .product-title { font-size: 15px; margin: 10px 0; }
        .product-price { font-size: 18px; font-weight: 700; color: #00e5ff; margin-bottom: 15px; }
        .product-footer { display: flex; justify-content: space-between; align-items: center; margin-top: auto; }
        .product-stock { font-size: 12px; color: rgba(255,255,255,0.5); }
        .btn-buy { background: #2575fc; color: #fff; border: none; padding: 8px 15px; border-radius: 8px; font-weight: 600; cursor: pointer; transition: 0.3s; }
        .btn-buy:hover { background: #1b5bbf; }
        .badge { padding: 4px 10px; border-radius: 12px; font-size: 11px; font-weight: 600; display: inline-block; width: fit-content; }
        .badge-pakaian { background: rgba(231, 76, 60, 0.2); color: #e74c3c; border: 1px solid rgba(231, 76, 60, 0.3); }
        .badge-aksesoris { background: rgba(52, 152, 219, 0.2); color: #3498db; border: 1px solid rgba(52, 152, 219, 0.3); }
        .empty-state { text-align: center; padding: 50px; color: rgba(255,255,255,0.5); width: 100%; grid-column: 1 / -1; }
    </style>
</head>
<body>

    <nav class="navbar">
        <a href="toko.php" class="brand"><i class="fa-solid fa-shirt"></i> KURO</a>
        <div class="nav-menu">
            <a href="index.php" class="btn-nav"><i class="fa-solid fa-user-shield"></i> Mode Admin</a>
            <a href="keranjang.php" class="btn-nav cart-icon">
                <i class="fa-solid fa-cart-shopping"></i> Keranjang
                <span class="cart-count" id="jumlah-keranjang">0</span>
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="toolbar">
            <div class="categories">
                <a href="toko.php" class="cat-btn <?= ($kategori_aktif == "") ? 'active' : '' ?>">Semua</a>
                <a href="toko.php?kategori=Pakaian" class="cat-btn <?= ($kategori_aktif == "Pakaian") ? 'active' : '' ?>">Pakaian</a>
                <a href="toko.php?kategori=Aksesoris" class="cat-btn <?= ($kategori_aktif == "Aksesoris") ? 'active' : '' ?>">Aksesoris</a>
            </div>
            <form method="GET" action="toko.php" class="search-form">
                <input type="text" name="cari" class="search-input" placeholder="Cari nama produk..." value="<?= htmlspecialchars($cari) ?>">
                <button type="submit" class="btn-search"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>

        <?php
            $store = new Storefront();
            $store->tampilkanKatalog($cari, $kategori_aktif);
        ?>
    </div>

    <script>
        // Memuat jumlah keranjang dari LocalStorage saat halaman dibuka
        let cart = JSON.parse(localStorage.getItem('kuro_cart')) || [];
        document.getElementById('jumlah-keranjang').innerText = cart.length;

        function tambahKeKeranjang(id, nama, harga) {
            cart.push({ id: id, nama: nama, harga: harga });
            localStorage.setItem('kuro_cart', JSON.stringify(cart));
            document.getElementById('jumlah-keranjang').innerText = cart.length;
            alert(`Produk ${nama} berhasil ditambahkan ke keranjang!`);
        }
    </script>
</body>
</html>

