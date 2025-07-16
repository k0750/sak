<?php
// Include the database connection
include('config.php');

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the email from the POST data
    $email = $_POST['email'];

    // Validate the email address
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Check if the email already exists in the database
        $query = "SELECT * FROM subscribers WHERE email = ?";
        if ($stmt = $conn->prepare($query)) {
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            // If the email already exists, show an error
            if ($result->num_rows > 0) {
                echo "You are already subscribed to the newsletter.";
            } else {
                // Insert the email into the database
                $insert_query = "INSERT INTO subscribers (email) VALUES (?)";
                if ($insert_stmt = $conn->prepare($insert_query)) {
                    $insert_stmt->bind_param("s", $email);
                    if ($insert_stmt->execute()) {
                        echo "Thank you for subscribing!";
                    } else {
                        echo "There was an error. Please try again later.";
                    }
                }
            }

            $stmt->close();
        }
    } else {
        echo "Please enter a valid email address.";
    }
}

$conn->close();
?>
