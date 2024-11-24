<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $people = $_POST['people'];
    $special_request = $_POST['special_request'];

    // Combine date and time into a single datetime string
    $datetime = $date . ' ' . $time;

    // Fetch the current booking details before updating
    $current_booking_result = $conn->query("SELECT * FROM bookings WHERE id='$id'");

    if ($current_booking_result) {
        $current_booking = $current_booking_result->fetch_assoc();
        if (!$current_booking) {
            die("No booking found with ID: $id");
        }
    } else {
        die("Error fetching booking: " . $conn->error);
    }

    // Insert the current booking details into the history table
    $sql_history = "INSERT INTO booking_history (name, datetime, people, special_request) 
                    VALUES ('{$current_booking['name']}', '{$current_booking['datetime']}', '$people', '$special_request')";
    
    if (!$conn->query($sql_history)) {
        echo "Error inserting into history: " . $conn->error;
    }

    // Update the booking
    $sql = "UPDATE bookings SET name='$name', datetime='$datetime', people='$people', special_request='$special_request' WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Booking updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $result = $conn->query("SELECT * FROM bookings WHERE id='$id'");
        
        if ($result) {
            $booking = $result->fetch_assoc();
            if (!$booking) {
                die("No booking found with ID: $id");
            }
        } else {
            die("Error fetching booking: " . $conn->error);
        }
    } else {
        die("No ID specified.");
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Booking</title>
    <link rel="stylesheet" href="css/styles.css"> <!-- Link to your CSS file -->
</head>
<body>
    <div class="container"> <!-- Add a container for styling -->
        <h1>Update Booking</h1>
        <form method="POST" action="">
            <input type="hidden" name="id" value="<?php echo isset($booking) ? $booking['id'] : ''; ?>">
            <label for="name">Name:</label>
            <input type="text" name="name" value="<?php echo isset($booking) ? $booking['name'] : ''; ?>" required><br>
            
            <label for="date">Date:</label>
            <input type="date" name="date" value="<?php echo isset($booking) ? date('Y-m-d', strtotime($booking['datetime'])) : ''; ?>" required><br>
            
            <label for="time">Time:</label>
            <input type="time" name="time" value="<?php echo isset($booking) ? date('H:i', strtotime($booking['datetime'])) : ''; ?>" required><br>
            
            <label for="people">Number of People:</label>
            <input type="number" name="people" value="<?php echo isset($booking) ? $booking['people'] : ''; ?>" required><br>
            
            <label for="special_request">Special Request:</label>
            <textarea name="special_request" rows="4" cols="50"><?php echo isset($booking) ? $booking['special_request'] : ''; ?></textarea><br>
            
            <input type="submit" value="Update Booking">
        </form>
        <a href="read.php">Back to Bookings</a>
    </div>
</body>
</html>
