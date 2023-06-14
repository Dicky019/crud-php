<nav class="bg-white border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
        <a href="http://localhost/crud-php/" class="flex items-center">
            <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo" />
            <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Kampus Toraja</span>
        </a>
    </div>
</nav>

<center class="my-8">
    <img class="w-full h-[500px] object-cover rounded-lg my-4" src="<?php echo 'http://localhost/crud-php/rest-api/' . $data["data"]['image'] ?>" alt="">
</center>

<h1 class="mb-2 text-4xl font-bold tracking-tight text-gray-900 dark:text-white">
    <?php echo $data["data"]['title'] ?>
</h1>
<p class="mb-3 text-ellipsis overflow-hidden h-40 font-normal text-gray-700 dark:text-gray-400">
    <?php echo $data["data"]['body'] ?>
</p>

<a href="http://localhost/crud-php/" class="px-5 py-3 text-base font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
    Back Home
</a>