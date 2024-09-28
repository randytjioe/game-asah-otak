<?php
session_start();
require 'config.php'; // Panggil konfigurasi database

function getRandomWord($pdo) {
    $stmt = $pdo->query("SELECT * FROM master_kata ORDER BY RAND() LIMIT 1");
    return $stmt->fetch();
}

function calculateScore($userAnswer, $correctAnswer) {
    $score = 0;
    for ($i = 0; $i < strlen($correctAnswer); $i++) {
        if ($i == 2 || $i == 6) continue; // Huruf petunjuk, tidak dihitung
        if ($userAnswer[$i] == $correctAnswer[$i]) {
            $score += 10; // Huruf benar
        } else {
            $score -= 2; // Huruf salah
        }
    }
    return $score;
}

if (!isset($_SESSION['word'])) {
    $_SESSION['word'] = getRandomWord($pdo);
}

$word = $_SESSION['word']['kata'];
$clue = $_SESSION['word']['clue'];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['answer'])) {
    $userAnswer = strtoupper(implode('', $_POST['answer']));
    $score = calculateScore($userAnswer, $word);
    $_SESSION['score'] = $score;
    $_SESSION['game_over'] = true;
    $_SESSION['user_answer'] = $userAnswer;
}

if (isset($_POST['save_score']) && isset($_POST['username'])) {
    $stmt = $pdo->prepare("INSERT INTO point_game (nama_user, total_point) VALUES (:nama_user, :total_point)");
    $stmt->execute([
        'nama_user' => $_POST['username'],
        'total_point' => $_SESSION['score']
    ]);
    session_destroy();
    header("Location: ../index.php");
    exit;
}

if (isset($_POST['play_again'])) {
    session_destroy();
    header("Location: ../index.php");
    exit;
}
?>
