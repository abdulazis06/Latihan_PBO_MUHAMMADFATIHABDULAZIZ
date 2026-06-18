<?php
require_once 'Tiket.php';

class TiketVelvet extends Tiket {
    private $bantal_selimut_pack;
    private $layanan_butler;

    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $bantal_selimut_pack, $layanan_butler) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket);
        $this->bantal_selimut_pack = $bantal_selimut_pack;
        $this->layanan_butler = $layanan_butler;
    }

    // Overriding Tahap 5
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->harga_dasar_tiket) * 1.50;
    }

    public function tampilkanInfoFasilitas() {
        $selimut = $this->bantal_selimut_pack ? "Ya" : "Tidak";
        $butler = $this->layanan_butler ? "Ya" : "Tidak";
        return "Bantal/Selimut: {$selimut} | Butler: {$butler}";
    }
}
?>
