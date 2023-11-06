<?php
session_start();
include('conn.php'); // Include your database connection code

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["book"])) {
    $hostelId = $_POST["hostel_id"]; // Get the selected hostel's ID
    $checkInDate = $_POST["check_in_date"];
    $checkOutDate = $_POST["check_out_date"];
    $userId = $_SESSION['user_id']; // Assume you have a user ID in the session

    // Perform validation and additional checks if needed

    // Check if the selected dates are available
    $availabilityCheck = "SELECT * FROM bookings WHERE hostel_id = $hostelId 
                          AND ((check_in_date <= '$checkInDate' AND check_out_date >= '$checkInDate') 
                          OR (check_in_date <= '$checkOutDate' AND check_out_date >= '$checkOutDate'))";
    $result = $conn->query($availabilityCheck);

    if ($result->num_rows > 0) {
        echo "The selected dates are not available for booking. Please choose different dates.";
    } else {
        // Dates are available, proceed with booking
        $insertBooking = "INSERT INTO bookings (user_id, hostel_id, check_in_date, check_out_date) 
                          VALUES ($userId, $hostelId, '$checkInDate', '$checkOutDate')";

        if ($conn->query($insertBooking) === TRUE) {
            echo "Hostel booked successfully!";
        } else {
            echo "Error: " . $insertBooking . "<br>" . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Hostel Booking</title>
</head>
<body>
    <h2>Hostel Booking</h2>
    <form action="" method="POST">
        <!-- Add input fields for selecting hostel, check-in, check-out dates, etc. -->
        <label for="hostel">Select a Hostel:</label>
        <select name="hostel_id" id="hostel">
            <!-- Populate options dynamically from the database -->
            <?php
            $hostelsQuery = "SELECT * FROM hostels";
            $result = $conn->query($hostelsQuery);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id'] . "'>" . $row['name'] . "</option>";
            }
            ?>
        </select>

        <label for="check-in">Check-in Date:</label>
        <input type="date" name="check_in_date" id="check-in" required>

        <label for="check-out">Check-out Date:</label>
        <input type="date" name="check_out_date" id="check-out" required>

        <input type="submit" name="book" value="Book Hostel">
    </form>
</body>
</html>
