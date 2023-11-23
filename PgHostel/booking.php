<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Include your database connection file
include('conn.php');

// Retrieve user details from the session
$username = $_SESSION['username'];

// Retrieve booking details from the form
// $pg_name = mysqli_real_escape_string($conn, $_POST['pg_name']);
// $room_type = mysqli_real_escape_string($conn, $_POST['room_type']);
// $check_in = $_POST['check_in'];
// $check_out = $_POST['check_out'];

// Add additional fields as needed


if (isset($_POST['check_in'])) {
    $check_in = $_POST['check_in'];

// Get user_id using the username
$user_query = "SELECT user_id FROM users WHERE username = '$username'";
$user_result = $conn->query($user_query);

if ($user_result->num_rows == 1) {
    $user_data = $user_result->fetch_assoc();
    $user_id = $user_data['user_id'];

    // Insert the booking into the database
    $insert_query = "INSERT INTO bookings (user_id,  booking_date) 
                     VALUES ('$user_id', '$check_in')";

    if ($conn->query($insert_query) === TRUE) {
        echo '<script>alert("Booking successful!");</script>';
    } else {
        echo "Error: " . $insert_query . "<br>" . $conn->error;
    }
}
}
    // Redirect to a confirmation page
//     header("Location: booking_confirmation.php");
//     exit();
// } else {
//     echo "Error: User not found";
// }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PG Booking</title>
</head>
<body>
    <h2>PG Booking Form</h2>
    <form action="booking.php" method="post">   

        <!-- <label for="room_type">Room Type:</label>
        <select id="room_type" name="room_type" required>
            <option value="single">Single Room</option>
            <option value="double">Double Room</option>
            <option value="shared">Shared Room</option>
        </select> -->

        <label for="check_in">Booking Date:</label>
        <input type="date" id="check_in" name="check_in" value="<?php echo date('Y-m-d'); ?>" required>
        
        <input type="submit" value="Book Now">
    </form>
</body>
</html>

