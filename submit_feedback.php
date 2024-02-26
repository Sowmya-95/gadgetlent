<?php
$servername = "localhost";
$username = "skamath"; // Ensure these details are correct
$password = "Qwerty1!";
$dbname = "gadgetlent_feedback";

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Establish a connection to the database
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Validate and sanitize input data
    $name = isset($_POST['name']) ? $conn->real_escape_string(trim($_POST['name'])) : null;
    $rating = isset($_POST['rating']) ? $conn->real_escape_string(trim($_POST['rating'])) : null;
    $comments = isset($_POST['comments']) ? $conn->real_escape_string(trim($_POST['comments'])) : null;
    
    // Server-side validation for required fields
    if (empty($name) || is_null($rating)) { // Check if name or rating is empty
        die('Name and rating are required fields and cannot be empty.');
    }
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO feedbacks (name, rating, comments) VALUES (?, ?, ?)");
    $stmt->bind_param("sis", $name, $rating, $comments); // Assuming rating is an integer. Change "s" to "i" if so.
    
    // Execute the prepared statement
    if ($stmt->execute()) {
        echo "Feedback recorded successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If not POST request, display a message
    echo "Please submit the form.";
}
?>
