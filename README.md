
# Asah Otak Game - Setup Guide for Windows with XAMPP

## Deskripsi
Proyek ini adalah implementasi permainan **Asah Otak**, di mana pengguna bisa menebak kata berdasarkan petunjuk (clue). Skor dihitung berdasarkan seberapa akurat jawaban yang diberikan.

Proyek ini menggunakan **PHP** sebagai backend, **MySQL** sebagai database, dan **Apache** sebagai server web. Berikut adalah langkah-langkah untuk menjalankan proyek ini menggunakan **XAMPP** di **Windows**.

## Struktur Folder
```
/asah_otak_game
├── /css
│   └── style.css                # File CSS untuk styling
├── /php
│   ├── game.php                 # File utama PHP untuk game logic
│   └── config.php               # File konfigurasi database
├── /db
│   └── database.sql             # File SQL untuk membuat tabel dan contoh data
├── index.php                    # Halaman utama untuk mengarahkan ke game
└── README.md                    # Dokumentasi proyek ini
```

## Langkah-langkah Menjalankan Proyek di Windows dengan XAMPP

### 1. **Pindahkan Proyek ke Direktori XAMPP**
- Pindahkan folder proyek **asah_otak_game** ke direktori **htdocs** di **XAMPP**. Secara default, direktori **htdocs** terletak di:
  ```
  C:\xampp\htdocs\
  ```
  
  Pindahkan proyek dengan cara **copy-paste** folder **asah_otak_game** ke dalam folder **htdocs**.

### 2. **Jalankan XAMPP dan Aktifkan Apache & MySQL**
1. Buka **XAMPP Control Panel**.
2. Klik tombol **Start** pada **Apache** dan **MySQL**.
   
   Jika Apache dan MySQL berhasil berjalan, Anda akan melihat teks berwarna hijau bertuliskan **Running**.

### 3. **Setup Database di MySQL (phpMyAdmin)**
1. Buka browser dan akses **phpMyAdmin** melalui URL:
   ```
   http://localhost/phpmyadmin/
   ```

2. Di **phpMyAdmin**:
   - Buat database baru dengan nama **asah_otak**.
   - Pilih tab **SQL** dan jalankan perintah berikut untuk membuat tabel **master_kata** dan **point_game**:

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
   ('LEMARI', 'Aku tempat menyimpan pakaian?'),
   ('MEJA', 'Aku tempat bekerja di kantor?');
   ```

### 4. **Akses Proyek di Browser**
- Setelah Apache dan MySQL berjalan, Anda dapat mengakses proyek melalui browser. Buka URL berikut di browser:
  ```
  http://localhost/asah_otak_game/index.php
  ```

### 5. **Permainan**
- Anda akan melihat halaman permainan, di mana petunjuk (clue) akan diberikan, dan pengguna harus mengisi huruf yang benar.
- Setelah permainan selesai, pengguna bisa menyimpan skor atau memulai permainan baru.

## Kebutuhan Sistem
- **XAMPP** terinstal di **Windows**.
- Web browser modern untuk mengakses permainan.

