<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja - Kuro Merch</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body { background: linear-gradient(135deg, #0f0c29, #302b63, #24243e); color: #fff; min-height: 100vh; padding: 40px 20px; display: flex; justify-content: center; }
        
        .glass-container { width: 100%; max-width: 900px; background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 30px; box-shadow: 0 20px 40px rgba(0,0,0,0.3); }
        
        .header { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255,255,255,0.1); padding-bottom: 20px; margin-bottom: 20px; }
        .btn-back { color: #fff; text-decoration: none; padding: 8px 15px; background: rgba(255,255,255,0.1); border-radius: 8px; transition: 0.3s; display: flex; align-items: center; gap: 8px; }
        .btn-back:hover { background: rgba(255,255,255,0.2); }

        .table-responsive { width: 100%; overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 15px; text-align: left; border-bottom: 1px solid rgba(255,255,255,0.05); }
        th { color: rgba(255,255,255,0.7); font-weight: 600; text-transform: uppercase; font-size: 13px; }
        .btn-hapus { color: #e74c3c; cursor: pointer; background: none; border: none; font-size: 16px; }
        
        .checkout-box { margin-top: 30px; display: flex; justify-content: space-between; align-items: center; background: rgba(0,0,0,0.2); padding: 20px; border-radius: 15px; }
        .total-price { font-size: 24px; font-weight: 700; color: #00e5ff; }
        .btn-checkout { background: #2ecc71; color: #fff; border: none; padding: 12px 25px; border-radius: 10px; font-size: 16px; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn-checkout:hover { background: #27ae60; box-shadow: 0 0 15px rgba(46, 204, 113, 0.4); }
    </style>
</head>
<body>

    <div class="glass-container">
        <div class="header">
            <h2><i class="fa-solid fa-cart-shopping"></i> Keranjang Belanja</h2>
            <a href="toko.php" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali Belanja</a>
        </div>

        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="cart-data">
                    </tbody>
            </table>
        </div>

        <div class="checkout-box">
            <div>
                <p style="color: rgba(255,255,255,0.6); font-size: 14px;">Total Pembayaran</p>
                <div class="total-price" id="total-harga">Rp 0</div>
            </div>
            <button class="btn-checkout" onclick="prosesCheckout()"><i class="fa-solid fa-check-double"></i> Proses Checkout</button>
        </div>
    </div>

    <script>
        let cart = JSON.parse(localStorage.getItem('kuro_cart')) || [];
        
        function renderCart() {
            const tbody = document.getElementById('cart-data');
            const totalEl = document.getElementById('total-harga');
            tbody.innerHTML = '';
            let total = 0;

            if (cart.length === 0) {
                tbody.innerHTML = '<tr><td colspan="4" style="text-align:center; padding: 30px;">Keranjang masih kosong.</td></tr>';
                totalEl.innerText = 'Rp 0';
                return;
            }

            cart.forEach((item, index) => {
                total += item.harga;
                let hargaRp = "Rp " + item.harga.toLocaleString('id-ID');
                
                tbody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td style="font-weight: 600;">${item.nama}</td>
                        <td>${hargaRp}</td>
                        <td><button class="btn-hapus" onclick="hapusItem(${index})"><i class="fa-solid fa-trash"></i></button></td>
                    </tr>
                `;
            });

            totalEl.innerText = "Rp " + total.toLocaleString('id-ID');
        }

        function hapusItem(index) {
            cart.splice(index, 1);
            localStorage.setItem('kuro_cart', JSON.stringify(cart));
            renderCart();
        }

        function prosesCheckout() {
            if (cart.length === 0) {
                alert("Pilih barang dulu sebelum checkout!");
                return;
            }

            // Minta konfirmasi biar lebih realistis
            let konfirmasi = confirm("Yakin mau memproses pesanan ini?");
            if (!konfirmasi) return;

            // Proses "Ngobrol" ke PHP (Back-End) pakai Fetch API
            fetch('proses_checkout.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(cart) // Kirim data keranjang lu
            })
            .then(response => response.json()) // Nangkep jawaban dari PHP
            .then(data => {
                if(data.status === 'success') {
                    alert(data.pesan); // Munculin alert sukses
                    localStorage.removeItem('kuro_cart'); // Kosongkan keranjang di browser
                    window.location.href = "toko.php"; // Balik ke toko
                } else {
                    alert(data.pesan); // Munculin alert gagal
                }
            })
            .catch((error) => {
                console.error('Error:', error);
                alert("Waduh, koneksi ke server bermasalah nih.");
            });
        }

        // Panggil fungsi saat halaman dimuat
        renderCart();
    </script>
</body>
</html>

