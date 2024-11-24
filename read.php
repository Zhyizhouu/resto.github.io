<?php
include 'db.php';

// Query to get all bookings including the number of people and special requests
$sql = "SELECT id, name, datetime, people, special_request FROM bookings";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>View Bookings</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <h1>Bookings</h1>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Date & Time</th>
            <th>People</th> <!-- New column for number of people -->
            <th>Special Request</th> <!-- Updated column name -->
            <th>Actions</th>
        </tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['datetime']; ?></td>
            <td><?php echo $row['people']; ?></td> <!-- Display number of people -->
            <td><?php echo isset($row['special_request']) ? $row['special_request'] : 'N/A'; ?></td> <!-- Display special request -->
            <td>
                <a href="update.php?id=<?php echo $row['id']; ?>" class="button">Edit</a>
                <a href="delete.php?id=<?php echo $row['id']; ?>" class="button">Delete</a>
            </td>

        </tr>
        <?php endwhile; ?>
    </table>
    <a href="create.php" class="button">Add New Booking</a>
    <a href="index.html" class="button">Back to Admin Dashboard</a>


</body>
</html>
