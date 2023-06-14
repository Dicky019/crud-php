<div class="grid grid-cols-4 gap-4 my-8">
    <?php
    foreach ($data['data'] as $kampus) {
        include './components/index/card.php';
    }
    ?>
</div>