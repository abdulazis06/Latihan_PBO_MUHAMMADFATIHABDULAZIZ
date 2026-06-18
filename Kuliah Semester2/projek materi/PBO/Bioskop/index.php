<?php
// index.php - Dashboard Bioskop Glassmorphism & Animated
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bioskop Pro - Glass UI</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        /* --- ANIMATED BACKGROUND --- */
        body {
            background: linear-gradient(45deg, #0f2027, #203a43, #2c5364, #8f002b);
            background-size: 400% 400%;
            animation: gradientBG 15s ease infinite;
            color: #fff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Ornamen Lingkaran Bercahaya di Belakang Kaca */
        .circle {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            z-index: -1;
            animation: float 10s infinite ease-in-out;
        }
        .circle-1 { width: 300px; height: 300px; background: #ff0055; top: -50px; left: -50px; }
        .circle-2 { width: 400px; height: 400px; background: #00e5ff; bottom: -100px; right: -50px; animation-delay: -5s; }

        @keyframes float {
            0%, 100% { transform: translateY(0) scale(1); }
            50% { transform: translateY(-30px) scale(1.1); }
        }

        /* --- CONTAINER KACA (GLASSMORPHISM) --- */
        .glass-container {
            width: 90%;
            max-width: 1200px;
            min-height: 80vh;
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3);
            display: flex;
            overflow: hidden;
            z-index: 10;
        }

        /* --- SIDEBAR KACA --- */
        .sidebar {
            width: 260px;
            background: rgba(255, 255, 255, 0.02);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            padding: 30px 20px;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .brand {
            font-size: 24px;
            font-weight: 700;
            color: #fff;
            text-shadow: 0 0 10px rgba(255,255,255,0.5);
            margin-bottom: 30px;
            text-align: center;
        }

        .nav-link {
            text-decoration: none;
            color: rgba(255, 255, 255, 0.7);
            padding: 12px 20px;
            border-radius: 12px;
            font-weight: 600;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            overflow: hidden;
        }

        .nav-link:hover, .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.15);
            box-shadow: 0 0 15px rgba(255, 255, 255, 0.1);
            transform: translateX(10px);
        }

        .nav-link.active::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            height: 100%;
            width: 4px;
            background: #00e5ff;
            box-shadow: 0 0 10px #00e5ff;
        }

        /* --- KONTEN UTAMA --- */
        .content {
            flex: 1;
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 30px;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            padding-bottom: 20px;
        }

        .user-profile {
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 20px;
            font-weight: 600;
            border: 1px solid rgba(255, 255, 255, 0.2);
            cursor: pointer;
            transition: 0.3s;
        }

        .user-profile:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* --- CARD MENU (ANIMATED GLASS) --- */
        .card-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.05);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-top: 1px solid rgba(255, 255, 255, 0.3);
            border-left: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            padding: 30px;
            text-decoration: none;
            color: #fff;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            position: relative;
            overflow: hidden;
        }

        /* Efek Kilap Kaca Pas Di-hover */
        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 50%;
            height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0) 100%);
            transform: skewX(-25deg);
            transition: all 0.7s ease;
        }

        .glass-card:hover {
            transform: translateY(-12px);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.4), 0 0 20px rgba(0, 229, 255, 0.3);
            border-color: rgba(0, 229, 255, 0.5);
        }

        .glass-card:hover::before {
            left: 200%;
        }

        .card-icon {
            font-size: 40px;
            margin-bottom: 15px;
            background: -webkit-linear-gradient(#00e5ff, #ff0055);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transition: transform 0.4s;
        }

        .glass-card:hover .card-icon {
            transform: scale(1.2) rotate(5deg);
        }

        .glass-card h3 {
            font-size: 22px;
            margin-bottom: 10px;
        }

        .glass-card p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.7);
            line-height: 1.6;
        }

    </style>
</head>
<body>

    <div class="circle circle-1"></div>
    <div class="circle circle-2"></div>

    <div class="glass-container">
        
        <div class="sidebar">
            <div class="brand">
                <i class="fa-solid fa-film"></i> CINE-X
            </div>
            <a href="index.php" class="nav-link active"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a href="film.php" class="nav-link"><i class="fa-solid fa-clapperboard"></i> Data Film</a>
            <a href="jadwal.php" class="nav-link"><i class="fa-solid fa-calendar-days"></i> Jadwal Tayang</a>
            <a href="booking.php" class="nav-link"><i class="fa-solid fa-ticket"></i> Booking Tiket</a>
        </div>

        <div class="content">
            <div class="header">
                <div>
                    <h2>Selamat Datang, Admin!</h2>
                    <p style="color: rgba(255,255,255,0.7); font-size: 14px;">Monitor seluruh aktivitas bioskop hari ini.</p>
                </div>
                <div class="user-profile">
                    <i class="fa-solid fa-user-astronaut"></i> Fatih
                </div>
            </div>

            <div class="card-grid">
                <a href="film.php" class="glass-card">
                    <i class="fa-solid fa-video card-icon"></i>
                    <h3>Kelola Film</h3>
                    <p>Konfigurasi database film, tambah daftar tayang baru, dan atur detail genre.</p>
                </a>

                <a href="jadwal.php" class="glass-card">
                    <i class="fa-solid fa-clock card-icon"></i>
                    <h3>Atur Jadwal</h3>
                    <p>Sinkronisasi waktu tayang antar studio biar gak ada jadwal yang bentrok.</p>
                </a>

                <a href="booking.php" class="glass-card">
                    <i class="fa-solid fa-receipt card-icon"></i>
                    <h3>Cek Booking</h3>
                    <p>Pantau tiket terjual, kursi yang kosong, dan konfirmasi pembayaran penonton.</p>
                </a>
            </div>
        </div>

    </div>

</body>
</html>
