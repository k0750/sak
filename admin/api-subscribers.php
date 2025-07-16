<?php
session_start();
if (!$_SESSION['role'] == 'admin') {
    header("Location: login.php");
  } 

?>
<?php
// Include the database configuration file
include_once '../config.php';

// SQL query to get all emails
$sql = "SELECT email FROM subscribers";

$result = $conn->query($sql);

// Check if there are any results
if ($result->num_rows > 0) {
    $emails = [];
    
    // Fetch all emails into an array
    while ($row = $result->fetch_assoc()) {
        $emails[] = $row['email'];
    }

    // Return the emails as JSON
    echo json_encode($emails);
} else {
    echo json_encode(['message' => 'No emails found']);
}

// Close the database connection
$conn->close();
?>
