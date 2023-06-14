<?php
// Mengirim permintaan HTTP ke API
$post_id = $_GET['id'];

$apiUrl = "http://localhost/crud-php/rest-api/read.php" . "?id=$post_id"; // Ubah sesuai dengan URL API Anda
$response = file_get_contents($apiUrl);

// Mendekode data JSON yang diterima
$data = json_decode($response, true);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Kampus Toraja - Edit</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        function setFileName(event) {
            var fileName = event.target.files[0].name;
            var inputText = document.getElementById('fileNameInput');
            inputText.value = fileName;
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addArticleForm').submit(function(e) {
                e.preventDefault();
                var title = $('#title').val();
                var id = $('#id').val();
                var body = $('#body').val();
                var image = $('#image')[0].files[0];

                var formData = new FormData();
                formData.append('title', title);
                formData.append('id', id);
                formData.append('body', body);
                formData.append('image', image);

                $.ajax({
                    url: 'http://localhost/crud-php/rest-api/update.php',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        console.log(response);
                        alert('Kampus Toraja berhasil diubah.');
                        // Tambahkan logika lain sesuai kebutuhan, misalnya redireksi ke halaman lain
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                        alert('Terjadi kesalahan saat mengubah.');
                    }
                });
            });
        });
    </script>
</head>

<body class="max-w-screen-xl items-center justify-between mx-auto my-4">
    <?php include '../../components/admin/header.php'; ?>

    <form id="addArticleForm" enctype="multipart/form-data" class="my-8">
        <input type="text" id="id" name="id" value="<?php echo $data['data']['id'] ?>" hidden>
        <div class="mb-6">
            <label for="image" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Image </label>
            <input type="file" id="image" name="image" accept="image/png, image/jpeg" onchange="setFileName(event)" hidden>
            <div class="flex">
                <label for="image" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Pilih</label>
                <input type="text" name="fileNameInput" id="fileNameInput" readonly class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Image.." required>
            </div>
        </div>

        <div class="mb-6">
            <label for="title" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
            <input value="<?php echo $data['data']['title'] ?>" id="title" name="title" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:shadow-sm-light" placeholder="Universitas DIPA Makassar" required>
        </div>

        <div class="mb-6">
            <label for="body" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Body</label>
            <textarea id="body" name="body" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Body..."><?php echo $data['data']['body'] ?></textarea>
        </div>

        <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Edit</button>
    </form>


</body>

</html>