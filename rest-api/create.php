<?php


header("Content-Type: application/json");
header("Acess-Control-Allow-Origin: *");
header("Acess-Control-Allow-Methods: POST");


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

// $data = json_decode(file_get_contents("php://input"));

///
// $fileName  =  $_FILES['image']['name'];
// $tempPath  =  $_FILES['image']['tmp_name'];
// $fileSize  =  $_FILES['image']['size'];

///
// $data = $_POST; 

if (!isset($_POST["title"]) || !isset($_POST["body"]) || !isset($_FILES['image']['name'])) :
    echo json_encode([
        'success' => 0,
        'message' => 'Please fill all the fields | title, body, image.',
    ]);
    exit;

elseif (empty(trim($_POST["title"])) || empty(trim($_POST["body"])) || empty(trim($_FILES['image']['name']))) :

    echo json_encode([
        'success' => 0,
        'message' => 'Oops! empty field detected. Please fill all the fields.',
    ]);
    exit;

endif;

try {

    $title = htmlspecialchars(trim($_POST["title"]));
    $body = htmlspecialchars(trim($_POST["body"]));
    // $image = htmlspecialchars(trim($data->image));
    // $image = $_FILES['image'];
    // $today = date("Y-m-d H:i:s");
    // $imagePath = 'uploads/' . basename($today . '-' . $image['name']);
    // move_uploaded_file($image['tmp_name'], $imagePath);
    $image = uploadImage();

    $query = "INSERT INTO `kampus_toraja`(title,body,image) VALUES(:title,:body,:image)";

    $stmt = $conn->prepare($query);

    $stmt->bindValue(':title', $title, PDO::PARAM_STR);
    $stmt->bindValue(':body', $body, PDO::PARAM_STR);
    $stmt->bindValue(':image', $image, PDO::PARAM_STR);

    if ($stmt->execute()) {

        http_response_code(201);
        echo json_encode([
            'success' => 1,
            'message' => 'Data Inserted Successfully.'
        ]);
        exit;
    }

    echo json_encode([
        'success' => 0,
        'message' => 'Data not Inserted.'
    ]);
    exit;
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'success' => 0,
        'message' => $e->getMessage()
    ]);
    exit;
}

function uploadImage()
{
    $image = $_FILES['image'];
    $today = date("Y-m-d-H:i:s");
    $imagePath = 'uploads/' . basename($today . '-' . $image['name']);
    move_uploaded_file($image['tmp_name'], $imagePath);

    return $imagePath;
}
