<?php
// proses_checkout.php
require_once 'koneksi.php';

// Atur header biar outputnya berformat JSON
header('Content-Type: application/json');

// Bikin class OOP buat nanganin Checkout
class Checkout extends Database {
    public function kurangiStok($id_produk) {
        // Query UPDATE buat ngurangin stok sebanyak 1 per klik,
        // dengan syarat stoknya harus lebih dari 0
        $sql = "UPDATE produk SET stok = stok - 1 WHERE id_produk = '$id_produk' AND stok > 0";
        return $this->conn->query($sql);
    }
}

// Tangkap data JSON yang dikirim dari JavaScript
$data_keranjang = json_decode(file_get_contents("php://input"), true);

// Kalau datanya ada, proses satu per satu
if (!empty($data_keranjang)) {
    $proses_db = new Checkout();
    $status_berhasil = true;

    // Looping semua barang yang ada di keranjang
    foreach ($data_keranjang as $item) {
        $id = $item['id'];
        
        // Panggil fungsi kurangiStok
        $eksekusi = $proses_db->kurangiStok($id);
        
        // Kalau ada satu aja query yang gagal, ubah status jadi false
        if (!$eksekusi) {
            $status_berhasil = false;
        }
    }

    if ($status_berhasil) {
        echo json_encode(["status" => "success", "pesan" => "Checkout sukses! Stok di database udah berkurang otomatis."]);
    } else {
        echo json_encode(["status" => "error", "pesan" => "Ada masalah saat memproses database."]);
    }
} else {
    echo json_encode(["status" => "error", "pesan" => "Keranjang masih kosong, bro!"]);
}
?>
