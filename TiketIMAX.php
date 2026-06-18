<?php
require_once 'Tiket.php';

class TiketIMAX extends Tiket {
    private $kacamata_3d_id;
    private $efek_gerak_fitur;

    public function __construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket, $kacamata_3d_id, $efek_gerak_fitur) {
        parent::__construct($id_tiket, $nama_film, $jadwal_tayang, $jumlah_kursi, $harga_dasar_tiket);
        $this->kacamata_3d_id = $kacamata_3d_id;
        $this->efek_gerak_fitur = $efek_gerak_fitur;
    }

    // Overriding Tahap 5
    public function hitungTotalHarga() {
        return ($this->jumlah_kursi * $this->harga_dasar_tiket) + 35000;
    }

    public function tampilkanInfoFasilitas() {
        $gerak = $this->efek_gerak_fitur ? "Ya" : "Tidak";
        return "ID Kacamata: {$this->kacamata_3d_id} | Efek Gerak: {$gerak}";
    }
}
?>
