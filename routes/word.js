
const express = require('express');
const router = express.Router();
const mysql = require('mysql');

// Koneksi ke database
const db = mysql.createConnection({
    host: 'localhost',
    user: 'root',  // Sesuaikan dengan user MySQL Anda
    password: '',  // Sesuaikan dengan password MySQL Anda
    database: 'asah_otak'
});

db.connect((err) => {
    if (err) {
        throw err;
    }
    console.log('Connected to database');
});

// Mengambil kata acak dari database
router.get('/random', (req, res) => {
    const sql = 'SELECT * FROM master_kata ORDER BY RAND() LIMIT 1';
    db.query(sql, (err, result) => {
        if (err) throw err;
        res.json(result[0]);
    });
});

// Menyimpan skor ke database
router.post('/save-score', (req, res) => {
    const { nama_user, total_point } = req.body;
    const sql = 'INSERT INTO point_game (nama_user, total_point) VALUES (?, ?)';
    db.query(sql, [nama_user, total_point], (err, result) => {
        if (err) throw err;
        res.send('Poin tersimpan!');
    });
});

module.exports = router;
