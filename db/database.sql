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
