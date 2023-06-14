<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan ID artikel dari permintaan POST
    $title = $_POST['title'];

    header('Location: index.php?title=' . $title);
    exit;
}
