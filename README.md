
# Asah Otak Game - Setup Guide for Linux with Apache

## Deskripsi
Proyek ini adalah implementasi permainan **Asah Otak**, di mana pengguna bisa menebak kata berdasarkan petunjuk (clue). Skor dihitung berdasarkan seberapa akurat jawaban yang diberikan.

Proyek ini menggunakan **PHP** sebagai backend, **MySQL** sebagai database, dan **Apache** sebagai server web. Berikut adalah langkah-langkah untuk menjalankan proyek ini di Linux dengan **Apache** yang telah terinstall.

## Struktur Folder
```
/asah_otak_game
├── /css
│   └── style.css                # File CSS untuk styling
├── /js
│   └── script.js                # (Opsional) JavaScript jika diperlukan
├── /php
│   ├── game.php                 # File utama PHP untuk game logic
│   └── config.php               # File konfigurasi database
├── /db
│   └── database.sql             # File SQL untuk membuat tabel dan contoh data
├── index.php                    # Halaman utama untuk mengarahkan ke game
└── README.md                    # Dokumentasi proyek ini
```

## Langkah-langkah Menjalankan Proyek

### 1. Setup Proyek di Apache
- Pindahkan folder proyek **asah_otak_game** ke direktori **Apache** di `/var/www/html/`:
  ```bash
  sudo mv /path/to/asah_otak_game /var/www/html/
  ```

- Ubah permission folder agar bisa diakses oleh Apache:
  ```bash
  sudo chown -R www-data:www-data /var/www/html/asah_otak_game
  sudo chmod -R 755 /var/www/html/asah_otak_game
  ```

### 2. Setup Database MySQL
- Buka **MySQL** di terminal:
  ```bash
  mysql -u root -p
  ```

- Buat database dan tabel yang diperlukan dengan menjalankan file SQL di **/db/database.sql**:
  ```sql
  CREATE DATABASE asah_otak;

  USE asah_otak;

  -- Tabel untuk menyimpan kata dan clue
  CREATE TABLE master_kata (
      id INT(11) AUTO_INCREMENT PRIMARY KEY,
      kata VARCHAR(255),
      clue VARCHAR(255)
  );

  -- Tabel untuk menyimpan skor permainan
  CREATE TABLE point_game (
      id INT(11) AUTO_INCREMENT PRIMARY KEY,
      nama_user VARCHAR(255),
      total_point INT(11)
  );

  -- Tambahkan data awal untuk game
  INSERT INTO master_kata (kata, clue) VALUES 
  ('LEMAR', 'Aku tempat menyimpan pakaian?'),
  ('MEJA', 'Aku tempat bekerja di kantor?');
  ```

### 3. Konfigurasi Apache untuk Proyek
- Pastikan Apache diatur untuk melayani file PHP. Restart Apache setelah melakukan konfigurasi:
  ```bash
  sudo systemctl restart apache2
  ```

- Cek apakah PHP sudah berjalan di Apache dengan membuat file tes:
  ```bash
  sudo nano /var/www/html/test.php
  ```

- Tambahkan kode berikut ke file `test.php`:
  ```php
  <?php phpinfo(); ?>
  ```

- Buka browser dan akses `http://localhost/test.php`. Jika halaman informasi PHP muncul, itu berarti PHP sudah berjalan dengan benar.

### 4. Akses Proyek di Browser
- Buka browser dan akses proyek melalui URL:
  ```
  http://localhost/asah_otak_game/index.php
  ```

### 5. Permainan
- Anda akan melihat halaman permainan, di mana petunjuk akan diberikan, dan pengguna harus mengisi huruf yang benar.
- Setelah permainan selesai, pengguna bisa menyimpan skor atau memulai permainan baru.

## Kebutuhan Sistem
- **Linux** dengan **Apache** terinstall.
- **PHP** dan **MySQL**.
- Web browser modern untuk mengakses permainan.

## Lisensi
Proyek ini dibuat untuk tujuan edukasi dan dapat digunakan sesuai kebutuhan.

