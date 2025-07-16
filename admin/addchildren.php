<?php
session_start();
if (!$_SESSION['role'] == 'admin') {
    header("Location: login.php");
  } 

?>
<?php
include_once('../config.php');

// Define the upload directory
$target_dir = "../uploads/";

// Check if the directory exists, if not, create it
if (!is_dir($target_dir)) {
    if (!mkdir($target_dir, 0777, true)) {
        die("Failed to create upload directory.");
    }
}

// Handling file upload
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $target_file = $target_dir . basename($_FILES['image']['name']);
    
    if (!move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
        die("Error uploading image.");
    }
    $target_file = "uploads/" .basename($_FILES['image']['name']);
} else {
    die("No image uploaded.");
}
// Collect form data
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$county = $_POST['county'];
$goal = $_POST['goal'];
$future_aspiration = $_POST['future_aspiration'];
$how_joined = $_POST['how_joined'];

// Insert into database
$sql = "INSERT INTO children (name, age, gender, county, goal, future_aspiration, how_joined, image_path)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sissssss", $name, $age, $gender, $county, $goal, $future_aspiration, $how_joined, $target_file);

if ($stmt->execute()) {
    echo "Child added successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
