public abstract class Tiket {
    
    // Properti/Atribut Terenkapsulasi (protected)
    // Nilainya dipetakan dari struktur tabel database Tahap 1
    protected int idTiket;
    protected String namaFilm;
    protected String jadwalTayang; 
    protected int jumlahKursi;
    protected int hargaDasarTiket;

    // Constructor untuk inisialisasi awal saat objek dibuat nanti
    public Tiket(int idTiket, String namaFilm, String jadwalTayang, int jumlahKursi, int hargaDasarTiket) {
        this.idTiket = idTiket;
        this.namaFilm = namaFilm;
        this.jadwalTayang = jadwalTayang;
        this.jumlahKursi = jumlahKursi;
        this.hargaDasarTiket = hargaDasarTiket;
    }

    // Metode Abstrak (Tanpa Isi/Body)
    // Wajib diimplementasikan nanti oleh kelas turunannya
    public abstract double hitungTotalHarga();
    public abstract void tampilkanInfoFasilitas();

    // =========================================
    // Opsional: Getter untuk mengambil data
    // =========================================
    public int getIdTiket() { return idTiket; }
    public String getNamaFilm() { return namaFilm; }
    public String getJadwalTayang() { return jadwalTayang; }
    public int getJumlahKursi() { return jumlahKursi; }
    public int getHargaDasarTiket() { return hargaDasarTiket; }
}
