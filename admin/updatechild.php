<?php
session_start();
if (!$_SESSION['role'] == 'admin') {
    header("Location: login.php");
  } 

?>
<?php
include_once '../config.php';
// Collect data from AJAX request

if (isset($_POST['idd'])) {
    $del = $_POST['idd'];
    // Prepare SQL query to delete the child record
    $sql = "DELETE FROM children WHERE id = ?";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        die('Statement preparation failed: ' . $conn->error);
    }
    // Bind the ID parameter to the prepared statement
    $stmt->bind_param("i", $del); // "i" indicates the parameter type is an integer
    // Execute the query
    if ($stmt->execute()) {
        echo "Child deleted successfully";
    } else {
        echo "Error deleting child: " . $stmt->error;
    }
    // Close the statement and connection
    $stmt->close();
    $conn->close();
} elseif (isset($_POST['id'])) {
    $id = $_POST['id'];
$name = $_POST['name'];
$age = $_POST['age'];
$gender = $_POST['gender'];
$county = $_POST['county'];
$goal = $_POST['goal'];
$future_aspiration = $_POST['future_aspiration'];
$how_joined = $_POST['how_joined'];
    $sql = "UPDATE children SET name=?, age=?, gender=?, county=?, goal=?, future_aspiration=?, how_joined=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sisssssi", $_POST['name'], $_POST['age'], $gender, $county, $goal, $future_aspiration, $how_joined, $id);
    
    if ($stmt->execute()) {
        echo "Child information updated successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    $stmt->close();
    $conn->close();
} else{
    echo "bad request";
}

?>
