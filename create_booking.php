<?php
// Database connection
$host = 'localhost'; // Your database host
$db = 'booking_system'; // Your database name
$user = 'root'; // Your database username
$pass = ''; // Your database password

$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $datetime = $_POST['datetime'];
    $people = $_POST['people'];
    $special_request = $_POST['special_request'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO bookings (name, email, datetime, people, special_request) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $name, $email, $datetime, $people, $special_request);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Booking created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>

<a href="read.php">Go to Bookings</a>
