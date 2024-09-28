let correctAnswer = "";  // Kata yang benar dari backend
let userAnswer = [];
let totalScore = 0;

// Function untuk mengambil kata acak dari server (Node.js)
function getRandomWord() {
    fetch('/api/words/random')
        .then(response => response.json())
        .then(data => {
            correctAnswer = data.kata.toUpperCase();
            document.getElementById("question").innerText = data.clue;
            createTextboxes();
        });
}

// Function untuk membuat textboxes sesuai dengan kata yang diambil
function createTextboxes() {
    const textboxesDiv = document.getElementById("textboxes");
    textboxesDiv.innerHTML = "";  // Reset textboxes
    userAnswer = [];

    for (let i = 0; i < correctAnswer.length; i++) {
        let input = document.createElement("input");
        input.type = "text";
        input.maxLength = 1;
        input.setAttribute("data-index", i);

        // Huruf ke-3 dan ke-7 ditampilkan sebagai clue dan tidak bisa diubah
        if (i === 2 || i === 6) {
            input.value = correctAnswer[i];
            input.disabled = true;  // Disable clue
        }

        input.oninput = function () {
            userAnswer[i] = input.value.toUpperCase();
        };

        textboxesDiv.appendChild(input);
    }
}

// Function untuk submit jawaban dan menghitung skor
function submitAnswer() {
    totalScore = 0;

    // Validasi: pastikan semua textbox diisi
    if (userAnswer.length < correctAnswer.length || userAnswer.some(input => input === undefined || input === '')) {
        alert("Semua textbox harus diisi!");
        return;
    }

    // Kalkulasi skor berdasarkan jawaban
    for (let i = 0; i < correctAnswer.length; i++) {
        if (i === 2 || i === 6) continue;  // Skip clue boxes

        if (userAnswer[i] === correctAnswer[i]) {
            totalScore += 10;  // Jawaban benar
        } else {
            totalScore -= 2;   // Jawaban salah
        }
    }

    document.getElementById("result").innerText = `Poin yang anda dapat adalah ${totalScore}.`;

    // Menampilkan opsi simpan poin
    document.getElementById("saveSection").style.display = "block";
}

// Function untuk menyimpan skor ke server (Node.js)
function saveScore() {
    const name = document.getElementById("name").value;
    if (!name) {
        alert("Masukkan nama terlebih dahulu.");
        return;
    }

    fetch('/api/words/save-score', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ nama_user: name, total_point: totalScore })
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        restartGame();
    });
}

// Function untuk mengulang permainan tanpa menyimpan poin
function restartGame() {
    userAnswer = [];
    totalScore = 0;
    document.getElementById("result").innerText = "";
    document.getElementById("saveSection").style.display = "none";
    getRandomWord();  // Memulai permainan baru
}

// Memulai permainan dengan mendapatkan kata acak dari server
window.onload = getRandomWord;
