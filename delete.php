<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM bookings WHERE id='$id'";
    if ($conn->query($sql) === TRUE) {
        echo "Booking deleted successfully";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<a href="read.php">Back to Bookings</a>

<script>
    document.querySelectorAll('a.button').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href');
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: 'smooth'
                });
            } else {
                window.location.href = this.getAttribute('href'); // Fallback for non-anchor links
            }
        });
    });
</script>

