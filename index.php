<?php
// Mengirim permintaan HTTP ke API
$post_title = null;
if (isset($_GET['title'])) {
    // Lakukan operasi dengan elemen 'title'
    $post_title = $_GET['title'];
    // ...
}
$apiUrl = $post_title != null ? "https://crud-php-production.up.railway.app/rest-api/read.php?title=$post_title" :  "https://crud-php-production.up.railway.app/rest-api/read.php"; // Ubah sesuai dengan URL API Anda
$response = file_get_contents($apiUrl);

// Mendekode data JSON yang diterima
$data = json_decode($response, true);

?>

<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/1.6.5/flowbite.min.css" rel="stylesheet" /> -->
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Kampus Toraja</title>
</head>

<body class="max-w-screen-xl items-center justify-between mx-auto my-4">

    <?php
    // echo $post_title;
    if ($data == null) {
        echo 'Permintaan API gagal.';
    } else {
        // if (isset($data["data"]) || $data['success'] > 0) {
            // Menampilkan data
            include './components/index/main.php';
        // } else {
        //     include './components/empty.php';
        // }
    }
    ?>
</body>

</html>