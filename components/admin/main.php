<?php

include '../components/admin/header.php';



if (isset($data["data"]) || $data['success'] > 0) {
    // Menampilkan data
    include '../components/admin/table.php';
} else {
    include '../components/empty.php';
}