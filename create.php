<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];
    $special_request = $_POST['special_request'];

    // Combine date and time into a single datetime string
    $datetime = $date . ' ' . $time;

    // Insert the new booking into the database
    $sql = "INSERT INTO bookings (name, datetime, people, special_request) 
            VALUES ('$name', '$datetime', '$people', '$special_request')";

    if ($conn->query($sql) === TRUE) {
        echo "New booking created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<a href="read.php">Back to Bookings</a>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Create Booking</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container"> <!-- Add a container for styling -->
        <h1>Create Booking</h1>
        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" name="name" required><br>
            
            <label for="date">Date:</label>
            <input type="date" name="date" required><br>
            
            <label for="time">Time:</label>
            <input type="time" name="time" required><br>
            
            <label for="people">Number of People:</label>
            <input type="number" name="people" required><br>
            
            <label for="special_request">Special Request:</label>
            <textarea name="special_request" rows="4" cols="50"></textarea><br>
            
            <input type="submit" value="Create Booking">
        </form>
        <a href="read.php">Back to Bookings</a>
    </div>
</body>
</html>
