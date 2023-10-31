<?php
include('conn.php'); // Include your database connection file

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hostel_name = $_POST["hostel_name"];
    $description = $_POST["description"];
    $location = $_POST["location"];
    $image = $_POST["image"];

    // Insert data into the database
    if (empty($hostel_name) || empty($description) || empty($location) || empty($image)) {
        echo "Please fill out all the fields.";
    } else {
        $sql = "INSERT INTO hostels (hostel_name, description, hostel_location,image) VALUES ('$hostel_name', '$description', '$location','$image')";

        if ($conn->query($sql) === TRUE) {
            echo "Hostel added successfully!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Hostel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h1 {
            text-align: center;
        }

        form {
            width: 400px;
            margin: 0 auto;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Add Hostel</h1>
    <form method="post" action="">
        <label for="hostel_name">Hostel Name:</label>
        <input type="text" id="hostel_name" name="hostel_name" required><br>

        <label for="description">Description:</label>
        <textarea id="description" name="description" rows="4" required></textarea><br>

        <label for="location">Location:</label>
        <input type="text" id="location" name="location" required><br>

        <label for="image">Upload Profile Image:</label>
        <input type="file" id="image" name="image" accept="image/*"><br><br>

        <!-- <label for="amount">Amount:</label>
        <input type="number" id="amount" name="amount" required><br> -->

        <input type="submit" value="Add Hostel">
    </form>
</body>
</html>
