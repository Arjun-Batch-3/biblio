<?php
session_start();
// Connect to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblio";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Decode JSON input
$data = json_decode(file_get_contents('php://input'), true);
$imageData = $data['image'];

// Extract base64 string and save the image to a file
$imageData = str_replace('data:image/png;base64,', '', $imageData);
$imageData = str_replace(' ', '+', $imageData);
$imageDecoded = base64_decode($imageData);
$fileName = 'paintings/' . uniqid() . '.png';
file_put_contents($fileName, $imageDecoded);

// Save file path to the database
$user_id = $_SESSION['client']['id'];
$book_fest_id = $_SESSION['client']['book_fest_id'];
$book_fest_id = $_SESSION['client']['book_fest_id'];

// Get coverDesignReqId from session
$coverDesignReqId = $_SESSION['coverDesignReqId'];


$sql = "INSERT INTO paintings (user_id, image_path, book_fest_id, cover_design_req_id) VALUES ($user_id, '$fileName', '$book_fest_id', '$coverDesignReqId')";
if ($conn->query($sql) === TRUE) {
  echo json_encode(["status" => "success", "message" => "Image saved"]);
} else {
  echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
}

$conn->close();
?>
