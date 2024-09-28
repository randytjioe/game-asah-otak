<?php
session_start();
require 'php/game.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asah Otak Game</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <h1>Asah Otak Game</h1>
    <?php if (!isset($_SESSION['game_over'])): ?>
        <p class="clue"><?php echo $clue; ?></p>
        <form method="post">
            <?php
            for ($i = 0; $i < strlen($word); $i++) {
                if ($i == 2 || $i == 6) {
                    echo '<input type="text" name="answer[]" value="' . $word[$i] . '" readonly>';
                } else {
                    echo '<input type="text" name="answer[]" maxlength="1" required>';
                }
            }
            ?>
            <br>
            <input type="submit" value="Jawab">
        </form>
    <?php else: ?>
        <p>Poin yang Anda dapat adalah <?php echo $_SESSION['score']; ?></p>
        <p>Jawaban yang benar: <?php echo $word; ?></p>
        <p>Jawaban Anda: 
            <?php
            for ($i = 0; $i < strlen($word); $i++) {
                $class = ($_SESSION['user_answer'][$i] == $word[$i]) ? 'correct' : 'incorrect';
                echo "<span class='$class'>{$_SESSION['user_answer'][$i]}</span>";
            }
            ?>
        </p>
        <form method="post">
            <input type="submit" name="save_score" value="Simpan Poin">
            <input type="submit" name="play_again" value="Ulangi">
        </form>
    <?php endif; ?>
<script>
    <?php if (isset($_POST['save_score'])): ?>
    let username = prompt("Masukkan nama Anda:");
    if (username) {
        let form = document.createElement('form');
        form.method = 'post';
        form.innerHTML = '<input type="hidden" name="save_score" value="1"><input type="hidden" name="username" value="' + username + '">';
        document.body.appendChild(form);
        form.submit();
    }
    <?php endif; ?>
    </script>
</body>
</html>
