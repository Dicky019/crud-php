<?php

include './components/header.php';


if (isset($data["data"]) || $data['success'] > 0) {
    // Menampilkan data
    include './components/index/cards.php';
} else {
    include './components/empty.php';
}


