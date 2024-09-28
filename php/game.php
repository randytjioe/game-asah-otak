<?php
// Memastikan session_start hanya dipanggil jika sesi belum dimulai
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'config.php';

// Fungsi untuk mengambil kata acak dari database
function getRandomWord($pdo) {
    $stmt = $pdo->query("SELECT * FROM master_kata ORDER BY RAND() LIMIT 1");
    return $stmt->fetch();
}

// Fungsi untuk menghitung skor berdasarkan jawaban pengguna
function calculateScore($userAnswer, $correctAnswer) {
    $score = 0;
    for ($i = 0; $i < strlen($correctAnswer); $i++) {
        if ($i == 2 || $i == 6) continue; // Huruf petunjuk, tidak dihitung
        if ($userAnswer[$i] == $correctAnswer[$i]) {
            $score += 10; // Huruf benar
        } else {
            $score -= 2;  // Huruf salah
        }
    }
    return $score;
}

// Mengambil kata acak jika belum ada di sesi
if (!isset($_SESSION['word'])) {
    $_SESSION['word'] = getRandomWord($pdo);
}

// Mengambil kata dan clue dari sesi
$word = $_SESSION['word']['kata'];
$clue = $_SESSION['word']['clue'];

// Memproses jawaban pengguna jika form dikirim
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer'])) {
    $userAnswer = strtoupper(implode('', $_POST['answer']));
    $score = calculateScore($userAnswer, $word);
    $_SESSION['score'] = $score;
    $_SESSION['game_over'] = true;
    $_SESSION['user_answer'] = $userAnswer;
}

// Memproses penyimpanan skor jika pengguna ingin menyimpan skor
if (isset($_POST['save_score']) && isset($_POST['username'])) {
    $stmt = $pdo->prepare("INSERT INTO point_game (nama_user, total_point) VALUES (:nama_user, :total_point)");
    $stmt->execute([
        'nama_user' => $_POST['username'],
        'total_point' => $_SESSION['score']
    ]);
    
    // Hapus sesi setelah menyimpan skor
    session_unset();
    session_destroy();
    
    // Redirect ke halaman utama setelah menyimpan skor
    header("Location: /game-asah-otak/index.php");
    exit;
}

// Memproses ulangi permainan
if (isset($_POST['play_again'])) {
    // Hapus semua data sesi untuk memulai ulang permainan
    session_unset();
    session_destroy();
    
    // Redirect kembali ke halaman utama
    header("Location: /game-asah-otak/index.php");
    exit;
}
?>
