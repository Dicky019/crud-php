<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json; charset=UTF-8");


if ($_SERVER['REQUEST_METHOD'] !== 'GET') :
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Invalid Request Method. HTTP method should be GET',
    ]);
    exit;
endif;

require 'Database.php';
$database = new Database();
$conn = $database->dbConnection();
$post_id = null;
$post_title = null;

if (isset($_GET['id'])) {
    $post_id = filter_var($_GET['id'], FILTER_VALIDATE_INT, [
        'options' => [
            'default' => 'all_posts',
            'min_range' => 1
        ]
    ]);
}
if (isset($_GET['title'])) {
    $post_title = $_GET['title'];
}

try {

    $sql = is_numeric($post_id) ? "SELECT * FROM `kampus_toraja` WHERE id='$post_id'" : "SELECT * FROM `kampus_toraja`";

    $stmt = $conn->prepare($sql);

    $stmt->execute();

    if ($stmt->rowCount() > 0) :

        $data = null;
        if (is_numeric($post_id)) {
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        if ($post_title != null) {
            $searchResults = [];

            // Melakukan pencarian berdasarkan judul artikel
            foreach ($data as $article) {
                if (strpos(strtolower($article['title']), strtolower($post_title)) !== false) {
                    $searchResults[] = $article;
                }
            }

            $data = $searchResults;
        }

        echo json_encode([
            'success' => 1,
            'data' => $data,
        ]);

    else :
        echo json_encode([
            'success' => 0,
            'message' => 'No Result Found!',
        ]);
    endif;
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => 0,
        'message' => $e->getMessage()
    ]);
    exit;
}
