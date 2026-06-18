<?php

class Database {
    // Properti untuk menyimpan konfigurasi database
    private $host = "localhost";
    private $username = "root";
    private $password = ""; // Kosongkan jika menggunakan bawaan Laragon/XAMPP
    private $database = "bioskop";
    public $conn;

    // Constructor otomatis berjalan saat objek dibuat
    public function __construct() {
        // Membuat koneksi menggunakan MySQLi secara OOP
        $this->conn = new mysqli($this->host, $this->username, $this->password, $this->database);

        // Memeriksa apakah koneksi berhasil atau error
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        } else {
            //echo "Koneksi ke database 'bioskop' berhasil! <br>";
        }
    }
}

// Membuat objek dari class Database untuk mengetes koneksinya
$db = new Database();

?>
