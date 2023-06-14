<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] !== 'POST') :
    http_response_code(405);
    echo json_encode([
        'success' => 0,
        'message' => 'Invalid Request Method. HTTP method should be POST',
    ]);
    exit;
endif;

require 'database.php';
$database = new Database();
$conn = $database->dbConnection();

// $_POST = json_decode(file_get_contents("php://input"));

if (!isset($_POST["id"])) {
    echo json_encode(['success' => 0, 'message' => 'Please provide the post ID.']);
    exit;
}

try {

    $fetch_post = "SELECT * FROM `kampus_toraja` WHERE id=:post_id";
    $fetch_stmt = $conn->prepare($fetch_post);
    $fetch_stmt->bindValue(':post_id', $_POST["id"], PDO::PARAM_INT);
    $fetch_stmt->execute();

    if ($fetch_stmt->rowCount() > 0) :

        $row = $fetch_stmt->fetch(PDO::FETCH_ASSOC);
        $post_title = isset($_POST['title']) ? $_POST['title'] : $row['title'];
        $post_body = isset($_POST['body']) ? $_POST['body'] : $row['body'];
        // if () {
        //     updateImage($row['image']);
        // }
        $post_image = isset($_FILES['image']['name']) ? updateImage($row['image']) : $row['image'];

        $update_query = "UPDATE `kampus_toraja` SET title = :title, body = :body, image = :image 
        WHERE id = :id";

        $update_stmt = $conn->prepare($update_query);

        $update_stmt->bindValue(':title', htmlspecialchars(strip_tags($post_title)), PDO::PARAM_STR);
        $update_stmt->bindValue(':body', htmlspecialchars(strip_tags($post_body)), PDO::PARAM_STR);
        $update_stmt->bindValue(':image', htmlspecialchars(strip_tags($post_image)), PDO::PARAM_STR);
        $update_stmt->bindValue(':id', $_POST["id"], PDO::PARAM_INT);


        if ($update_stmt->execute()) {

            echo json_encode([
                'success' => 1,
                'message' => 'Post updated successfully'
            ]);
            exit;
        }

        echo json_encode([
            'success' => 0,
            'message' => 'Post Not updated. Something is going wrong.'
        ]);
        exit;

    else :
        echo json_encode(['success' => 0, 'message' => 'Invalid ID. No Kmapus Toraja found by the ID.']);
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

function updateImage($imagePath)
{
    $deleteImage = deleteImage($imagePath);

    if ($deleteImage) {
        return uploadImage();
    }

    return null;
}

function uploadImage()
{
    $image = $_FILES['image'];
    $today = date("Y-m-d-H:i:s");
    $imagePath = 'uploads/' . basename($today . '-' . $image['name']);
    move_uploaded_file($image['tmp_name'], $imagePath);

    return $imagePath;
}

function deleteImage($imagePath)
{
    if (file_exists($imagePath)) {
        unlink($imagePath);
        // return "File gambar berhasil dihapus.";
        return true;
    } else {
        // return "File gambar tidak ditemukan.";
        return false;
    }
}
