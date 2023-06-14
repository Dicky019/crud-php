<?php include '../components/header.php'; ?>

<center class="my-8">
    <img class="w-full h-[500px] object-cover rounded-lg my-4" src="<?php echo 'http://localhost:8888/crud-php/rest-api/' . $data["data"]['image'] ?>" alt="">
</center>

<h1 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
    <?php echo $data["data"]['title'] ?>
</h1>
<p class="mb-3 text-ellipsis overflow-hidden h-40 font-normal text-gray-700 dark:text-gray-400">
    <?php echo $data["data"]['body'] ?>
</p>

<a href="http://localhost:8888/crud-php/" class="px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Back Home
</a>