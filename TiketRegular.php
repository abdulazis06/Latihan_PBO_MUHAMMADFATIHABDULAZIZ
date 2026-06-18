<?php
require_once 'Tiket.php';

class TiketRegular extends Tiket {
    private $tipe_audio;
    private $lokasi_baris;

    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $tipe_audio, $lokasi_baris) {
        // Memanggil constructor induk
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket);
        $this->tipe_audio = $tipe_audio;
        $this->lokasi_baris = $lokasi_baris;
    }

    // Overriding Tahap 5
    public function hitungTotalHarga() {
        return $this->jumlah_kursi * $this->harga_dasar_tiket;
    }

    public function tampilkanInfoFasilitas() {
        return "Audio: {$this->tipe_audio} | Baris: {$this->lokasi_baris}";
    }
}
?>
