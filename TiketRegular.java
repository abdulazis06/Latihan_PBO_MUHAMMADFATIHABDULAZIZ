public class TiketRegular extends Tiket {
    // Properti tambahan khusus tiket Regular
    private String tipeAudio;
    private String lokasiBaris;

    // Constructor
    public TiketRegular(int idTiket, String namaFilm, String jadwalTayang, int jumlahKursi, int hargaDasarTiket, String tipeAudio, String lokasiBaris) {
        // 'super' digunakan untuk memanggil constructor dari kelas induk (Tiket)
        super(idTiket, namaFilm, jadwalTayang, jumlahKursi, hargaDasarTiket);
        this.tipeAudio = tipeAudio;
        this.lokasiBaris = lokasiBaris;
    }

    // Wajib meng-override (menimpa) metode abstrak dari kelas induk
    @Override
    public double hitungTotalHarga() {
        // Untuk sementara kita kembalikan harga dasarnya dulu
        return hargaDasarTiket; 
    }

    @Override
    public void tampilkanInfoFasilitas() {
        System.out.println("--- Fasilitas Studio Regular ---");
        System.out.println("Tipe Audio   : " + tipeAudio);
        System.out.println("Lokasi Baris : " + lokasiBaris);
    }
}
