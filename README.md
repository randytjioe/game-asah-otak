
# Asah Otak Game - Jawaban Soal Nomor 1-8 (Node.js Backend)

## Deskripsi
Proyek ini adalah implementasi permainan **Asah Otak** yang sesuai dengan soal nomor 1 hingga 8 yang diberikan. Permainan ini menampilkan kata secara acak, meminta pemain untuk menebak kata tersebut, menghitung skor, dan menyimpan hasilnya ke database.

## Struktur Folder
```bash
/asah_otak_game
├── /css
│   └── style.css                 # (Opsional) File CSS untuk styling
├── /js
│   └── script.js                 # (Opsional) File JavaScript untuk interaksi frontend
├── /server
│   ├── app.js                    # File utama Node.js untuk backend
│   └── database.sql              # File SQL untuk membuat tabel dan contoh data
├── /public
│   ├── index.html                # Halaman utama HTML untuk permainan
├── /routes
│   └── words.js                  # Routes untuk mengambil kata acak dan menyimpan skor
└── README.md                     # Dokumentasi proyek ini
```

## Soal 1: Mengambil Kata Secara Acak dari Database (Node.js Backend)
Pada **/routes/words.js**, kata acak diambil dari tabel `master_kata` di database menggunakan query berikut:

```javascript
router.get('/random', (req, res) => {
    const sql = 'SELECT * FROM master_kata ORDER BY RAND() LIMIT 1';
    db.query(sql, (err, result) => {
        if (err) throw err;
        res.json(result[0]);
    });
});
```
Kata yang diambil akan dikirimkan ke frontend dalam format JSON untuk ditampilkan kepada pemain.

## Soal 2: Menampilkan Textbox dengan Huruf Clue dan Menghitung Skor

- **2a.** Jumlah textbox sesuai dengan jumlah huruf dari kata yang diambil secara acak.
- **2b.** Huruf ke-3 dan ke-7 ditampilkan sebagai clue, tidak bisa diubah.
- **2c.** Setiap huruf yang benar mendapat +10 poin, dan setiap huruf yang salah dikurangi 2 poin.
- **2d.** Contoh penghitungan: Jika jawabannya **LEMAR** dan pengguna menjawab **KEMIRI**, total poin yang didapat adalah 26.

## Soal 3: Validasi Pengisian Textbox
Semua textbox harus diisi sebelum jawaban dikirimkan. Validasi dilakukan di frontend untuk memastikan tidak ada textbox yang kosong:

```javascript
if (userAnswer.some(input => input === '')) {
    alert("Semua textbox harus diisi!");
    return;
}
```

## Soal 4: Permainan Berakhir Setelah Submit
Setelah pemain mengisi semua textbox dan menekan tombol **Submit**, permainan berakhir, skor dihitung, dan hasil ditampilkan.

## Soal 5: Menampilkan Pesan Poin yang Diperoleh
Setelah skor dihitung, pesan ditampilkan seperti ini:
```javascript
document.getElementById("result").innerText = `Poin yang anda dapat adalah ${totalScore}.`;
```

## Soal 6: Pilihan "Simpan Poin" atau "Ulangi"
Setelah hasil skor ditampilkan, pengguna diberikan pilihan untuk:
- **Simpan Poin**: Menyimpan skor ke database.
- **Ulangi**: Memulai permainan baru tanpa menyimpan skor.

## Soal 7: Menyimpan Poin ke Database (Node.js Backend)
Jika pemain memilih **Simpan Poin**, nama pemain dan skor dikirim ke backend (`/api/words/save-score`) untuk disimpan di database `point_game`. Berikut adalah query SQL yang digunakan:

```javascript
router.post('/save-score', (req, res) => {
    const { nama_user, total_point } = req.body;
    const sql = 'INSERT INTO point_game (nama_user, total_point) VALUES (?, ?)';
    db.query(sql, [nama_user, total_point], (err, result) => {
        if (err) throw err;
        res.send('Poin tersimpan!');
    });
});
```

## Soal 8: Memulai Ulang Permainan
Jika pemain memilih **Ulangi**, permainan dimulai kembali tanpa menyimpan data skor yang sebelumnya.

```javascript
function restartGame() {
    userAnswer = [];
    totalScore = 0;
    document.getElementById("result").innerText = "";
    document.getElementById("saveSection").style.display = "none";
    getRandomWord();  // Mengambil kata baru
}
```

## Cara Menjalankan Proyek

1. **Setup Database**: Buat database MySQL dan jalankan file SQL di `/db/database.sql` untuk membuat tabel `master_kata` dan `point_game`, serta menambahkan contoh data.
2. **Instalasi Node.js**: Install dependensi Node.js yang diperlukan:
    ```bash
    npm install express mysql body-parser cors
    ```
3. **Frontend**: Buka file `index.html` di folder `/public` di browser untuk menjalankan permainan.
4. **Backend**: Jalankan server Node.js:
    ```bash
    node server/app.js
    ```

## Kebutuhan Sistem

- **Node.js** 12.x atau lebih tinggi
- **MySQL** 5.x atau lebih tinggi
- Web browser modern (Chrome, Firefox, dll.)

## Lisensi
Proyek ini dibuat untuk tujuan edukasi dan dapat digunakan sesuai kebutuhan.
# game-asah-otak
