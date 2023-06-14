<tr>
    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
        <?php echo $kampus['id'] ?>
    </th>
    <td class="px-6 py-4">
        <img class="rounded-lg w-full h-20 object-cover" src="<?php echo 'http://localhost:8888/crud-php/rest-api/' . $kampus['image'] ?>" alt="" />
    </td>
    <td class="px-6 py-4">
        <?php echo $kampus['title'] ?>
    </td>
    <td class="px-6 py-4">
        <?php echo $kampus['body'] ?>
    </td>
    <td class="px-6 py-4 flex gap-4">

        <a href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline ">Edit</a>
        <form method="POST" action="delete.php">
            <input type="number" value="<?php echo $kampus['id'] ?>" name="id" id="id" hidden>
            <button type="submit" href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</button>
        </form>
        <!-- <a href="#" class="font-medium text-red-600 dark:text-red-500 hover:underline">Delete</a> -->
    </td>
</tr>