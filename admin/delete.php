<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Mendapatkan ID artikel dari permintaan POST
    $id = $_POST['id'];

    // Membuat data body permintaan
    $data = [
        'id' => $id,
    ];
    $dataJson = json_encode($data);

    // Membuat permintaan DELETE ke API
    $apiUrl = 'http://localhost/crud-php/rest-api/delete.php'; // Ubah sesuai dengan URL API Anda
    $options = [
        'http' => [
            'method' => 'DELETE',
            'header' => 'Content-Type: application/json',
            'content' => $dataJson,
        ],
    ];
    $context = stream_context_create($options);
    $result = file_get_contents($apiUrl, false, $context);

    // Menampilkan pesan hasil penghapusan
    // echo $result;

    header('Location: index.php?id=' . $id);
    exit;
}
