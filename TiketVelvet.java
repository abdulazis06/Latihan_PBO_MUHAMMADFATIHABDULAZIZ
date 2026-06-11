public class TiketVelvet extends Tiket {
    // Properti tambahan khusus tiket Velvet
    private boolean bantalSelimutPack;
    private boolean layananButler;

    // Constructor
    public TiketVelvet(int idTiket, String namaFilm, String jadwalTayang, int jumlahKursi, int hargaDasarTiket, boolean bantalSelimutPack, boolean layananButler) {
        super(idTiket, namaFilm, jadwalTayang, jumlahKursi, hargaDasarTiket);
        this.bantalSelimutPack = bantalSelimutPack;
        this.layananButler = layananButler;
    }

    @Override
    public double hitungTotalHarga() {
        // Hint: Kalau mengacu ke contoh soal dosenmu di Tahap 2, 
        // overriding harga Velvet bakal dilakukan di Tahap 5.
        // Jadi sementara biarkan return harga dasar dulu.
        return hargaDasarTiket;
    }

    @Override
    public void tampilkanInfoFasilitas() {
        System.out.println("--- Fasilitas Studio Velvet ---");
        System.out.println("Bantal & Selimut : " + (bantalSelimutPack ? "Disediakan" : "Tidak Disediakan"));
        System.out.println("Layanan Butler   : " + (layananButler ? "Tersedia" : "Tidak Tersedia"));
    }
}
