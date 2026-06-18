<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Tayang - Glass UI</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body {
            background: linear-gradient(45deg, #0f2027, #203a43, #2c5364, #8f002b);
            background-size: 400% 400%; animation: gradientBG 15s ease infinite;
            color: #fff; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 40px 20px;
        }
        @keyframes gradientBG { 0% { background-position: 0% 50%; } 50% { background-position: 100% 50%; } 100% { background-position: 0% 50%; } }
        
        .glass-container {
            width: 100%; max-width: 1100px;
            background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 24px; box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3);
            padding: 40px; display: flex; flex-direction: column; gap: 30px;
        }

        .header-content { display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid rgba(255, 255, 255, 0.1); padding-bottom: 20px; }
        .header-content h2 { font-size: 24px; text-shadow: 0 0 10px rgba(255,255,255,0.3); }
        .btn-back {
            background: rgba(255, 255, 255, 0.1); color: #fff; text-decoration: none; padding: 10px 20px;
            border-radius: 12px; font-weight: 600; border: 1px solid rgba(255, 255, 255, 0.2); transition: all 0.3s; display: flex; align-items: center; gap: 10px;
        }
        .btn-back:hover { background: rgba(0, 229, 255, 0.2); border-color: #00e5ff; box-shadow: 0 0 15px rgba(0, 229, 255, 0.3); transform: translateX(-5px); }

        .table-responsive { width: 100%; overflow-x: auto; }
        .glass-table { width: 100%; border-collapse: collapse; }
        .glass-table th, .glass-table td { padding: 18px 20px; text-align: left; border-bottom: 1px solid rgba(255, 255, 255, 0.05); }
        .glass-table th { color: rgba(255, 255, 255, 0.9); font-weight: 600; text-transform: uppercase; font-size: 14px; letter-spacing: 1px; }
        .glass-table tr { transition: all 0.3s ease; }
        .glass-table tr:hover { background: rgba(255, 255, 255, 0.08); transform: scale(1.01); }
        .glass-table td { color: rgba(255, 255, 255, 0.7); font-size: 15px; }

        .badge-studio {
            background: rgba(255, 255, 255, 0.1); padding: 6px 12px; border-radius: 8px; font-weight: 600; color: #00e5ff; border: 1px solid rgba(0, 229, 255, 0.3);
        }
    </style>
</head>
<body>
    <div class="glass-container">
        <div class="header-content">
            <h2><i class="fa-solid fa-calendar-days"></i> Manajemen Jadwal Tayang</h2>
            <a href="index.php" class="btn-back"><i class="fa-solid fa-house"></i> Kembali ke Dashboard</a>
        </div>
        <div class="table-responsive">
            <table class="glass-table">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Film</th>
                        <th>Studio</th>
                        <th>Harga Tiket</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>26 Mei 2026</td>
                        <td>14:00 WIB</td>
                        <td style="font-weight: 600; color: #fff;">Inception</td>
                        <td><span class="badge-studio">Studio 1 (IMAX)</span></td>
                        <td>Rp 65.000</td>
                    </tr>
                    <tr>
                        <td>26 Mei 2026</td>
                        <td>16:30 WIB</td>
                        <td style="font-weight: 600; color: #fff;">Chainsaw Man: Reze Arc</td>
                        <td><span class="badge-studio">Studio 2 (Reguler)</span></td>
                        <td>Rp 45.000</td>
                    </tr>
                    <tr>
                        <td>26 Mei 2026</td>
                        <td>19:00 WIB</td>
                        <td style="font-weight: 600; color: #fff;">The Batman</td>
                        <td><span class="badge-studio">Studio 1 (IMAX)</span></td>
                        <td>Rp 65.000</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
