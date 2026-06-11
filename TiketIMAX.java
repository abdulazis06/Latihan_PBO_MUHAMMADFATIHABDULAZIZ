public class TiketIMAX extends Tiket {
    // Properti tambahan khusus tiket IMAX
    private String kacamata3dId;
    private boolean efekGerakFitur;

    // Constructor
    public TiketIMAX(int idTiket, String namaFilm, String jadwalTayang, int jumlahKursi, int hargaDasarTiket, String kacamata3dId, boolean efekGerakFitur) {
        super(idTiket, namaFilm, jadwalTayang, jumlahKursi, hargaDasarTiket);
        this.kacamata3dId = kacamata3dId;
        this.efekGerakFitur = efekGerakFitur;
    }

    @Override
    public double hitungTotalHarga() {
        // IMAX biasanya ada biaya tambahan, tapi sementara kita pakai harga dasar
        return hargaDasarTiket;
    }

    @Override
    public void tampilkanInfoFasilitas() {
        System.out.println("--- Fasilitas Studio IMAX ---");
        System.out.println("ID Kacamata 3D : " + kacamata3dId);
        System.out.println("Efek Gerak     : " + (efekGerakFitur ? "Tersedia" : "Tidak Tersedia"));
    }
}
