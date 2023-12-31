<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: DELETE");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'DELETE') :
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Invalid Request Method. HTTP method should be DELETE',
    ]);
    exit;
endif;

require 'Database.php';
$database = new Database();
$conn = $database->dbConnection();

$data = json_decode(file_get_contents("php://input"));

if (!isset($data->id)) {
    echo json_encode(['success' => 0, 'message' => 'Please provide the post ID.']);
    exit;
}

try {

    $fetch_post = "SELECT * FROM `kampus_toraja` WHERE id=:post_id";
    $fetch_stmt = $conn->prepare($fetch_post);
    $fetch_stmt->bindValue(':post_id', $data->id, PDO::PARAM_INT);
    $fetch_stmt->execute();

    if ($fetch_stmt->rowCount() > 0) :
        $row = $fetch_stmt->fetch(PDO::FETCH_ASSOC);
        $delete_post = "DELETE FROM `kampus_toraja` WHERE id=:post_id";
        $delete_post_stmt = $conn->prepare($delete_post);
        $delete_post_stmt->bindValue(':post_id', $data->id, PDO::PARAM_INT);

        $delete_image =  deleteImage($row["image"]);

        if ($delete_post_stmt->execute() && $delete_image) {
            echo json_encode([
                'success' => 1,
                'message' => 'Post Deleted successfully'
            ]);
            exit;
        }

        echo json_encode([
            'success' => 0,
            'message' => 'Post Not Deleted. Something is going wrong.'
        ]);
        exit;

    else :
        echo json_encode(['success' => 0, 'message' => 'Invalid ID. No kampus_toraja found by the ID.']);
        exit;
    endif;
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => 0,
        'message' => $e->getMessage()
    ]);
    exit;
}


function deleteImage($imagePath) {
    if (file_exists($imagePath)) {
        unlink($imagePath);
        // return "File gambar berhasil dihapus.";
        return true;
    } else {
        // return "File gambar tidak ditemukan.";
        return false;
    }
}
