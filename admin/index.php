<?php
// Mengirim permintaan HTTP ke API
$apiUrl = "http://localhost/crud-php/rest-api/read.php"; // Ubah sesuai dengan URL API Anda
$response = file_get_contents($apiUrl);

// Mendekode data JSON yang diterima
$data = json_decode($response, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kampus Toraja</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="max-w-screen-xl items-center justify-between mx-auto my-4">

    <?php
    // echo $apiUrl;
    if ($data == null) {
        echo 'Permintaan API gagal.';
    } else {
        // if (isset($data["data"]) || $data['success'] > 0) {
            // Menampilkan data
            include '../components/admin/main.php';
        // } else {
        //     include '../components/empty.php';
        // }
    }
    ?>
</body>

</html>