<?php
include 'db.php';

$id = $_GET['id'];

// Query to get the booking history
$sql = "SELECT * FROM booking_history WHERE id='$id' ORDER BY updated_at DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Booking History</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Booking History for ID: <?php echo $id; ?></h1>
    <table border="1">
        <tr>
            <th>Previous Name</th>
            <th>Previous Date & Time</th>
            <th>Previous People</th>
            <th>Previous Special Request</th>
            <th>Updated At</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['datetime']; ?></td>
            <td><?php echo $row['people']; ?></td>
            <td><?php echo isset($row['special_request']) ? $row['special_request'] : 'N/A'; ?></td>
            <td><?php echo $row['updated_at']; ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="read.php">Back to Bookings</a>
</body>
</html>
