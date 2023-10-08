<?php
include('conn.php'); // Include your database connection file

session_start(); // Start the session to access user data

// if (empty($_SESSION['username'])) {
//     // Redirect to the login page if the user is not logged in
//     header('Location: login.php');
//     exit();
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the updated profile information from the form
    $newName = $_POST['newName'];
    $newEmail = $_POST['newEmail'];
    $newPhone = $_POST['newPhone'];

    // Update the user's profile in the database
    $username = $_SESSION['username']; // Get the username from the session

    $sql = "UPDATE users SET name='$newName', email='$newEmail', phone='$newPhone' WHERE username='$username'";

    if ($conn->query($sql) === TRUE) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . $conn->error;
    }
}

// Retrieve the user's current profile data
$username = $_SESSION['username']; // Get the username from the session
$sql = "SELECT * FROM users WHERE username='$username'";
$result = $conn->query($sql);

if ($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    $currentName = $row['name'];
    $currentEmail = $row['email'];
    $currentPhone = $row['phone'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
</head>
<body>
    <h1>Edit Your Profile</h1>
    <form method="POST" action="">
        <label for="newName">Name:</label>
        <input type="text" id="newName" name="newName" value="<?php echo $currentName; ?>" required><br>

        <label for="newEmail">Email:</label>
        <input type="email" id="newEmail" name="newEmail" value="<?php echo $currentEmail; ?>" required><br>

        <label for="newPhone">Phone:</label>
        <input type="text" id="newPhone" name="newPhone" value="<?php echo $currentPhone; ?>" required><br>

        <input type="submit" value="Update Profile">
    </form>
    <a href="logout.php">Logout</a>
</body>
</html>
