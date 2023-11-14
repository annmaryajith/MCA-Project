<?php
include('conn.php'); // Include your database connection code
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Room</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
        }

        form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            background-color: #fff;
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input,
        select {
            width: calc(100% - 10px);
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .error {
            color: red;
            margin-bottom: 10px;
        }

        input[type="submit"] {
            background-color: #000;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <?php
    if (isset($_SESSION['username'])) {
        $username = $_SESSION['username'];
        echo "Welcome, $username! Manage your hostels here.";

        // Retrieve the hostel owner's details from the database
        $owner_query = "SELECT * FROM hostel_owners1 WHERE username = '$username'";
        $owner_result = $conn->query($owner_query);

        if ($owner_result->num_rows > 0) {
            $owner_row = $owner_result->fetch_assoc();
            $hostel_owner = $owner_row['username'];

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_room'])) {
                $room_number = $_POST['room_number'];
                $room_type = $_POST['room_type'];
                $price = $_POST['price'];

                // Insert room details into the hostel_rooms table
                $insert_room_sql = "INSERT INTO hostel_rooms (hostel_name, room_number, room_type, price) VALUES ('$hostel_owner', '$room_number', '$room_type', $price)";

                if ($conn->query($insert_room_sql) === TRUE) {
                    echo '<script>alert("Room added successfully!");</script>';
                } else {
                    echo "Error adding room: " . $conn->error;
                }
            }

            // Display Add Room Form
            echo '<h2>Add Room</h2>';
            echo '<form method="post" action="" id="addRoomForm">';
            echo '<label for="room_number">Room Number:</label>';
            echo '<input type="text" name="room_number" id="room_number" placeholder="Room Number" required>';
            echo '<span id="roomNumberError" class="error"></span><br>';

            echo '<label for="room_type">Room Type:</label>';
            echo '<select name="room_type" id="room_type" required>';
            echo "<option value=''>Select Room Type</option>"; // Placeholder
            // Fetching room types from the database
            $sql = "SELECT DISTINCT hostel_roomtype FROM hostel_roomtype"; // Modify this query based on your database structure
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['hostel_roomtype'] . "'>" . $row['hostel_roomtype'] . "</option>";
                }
            }
            echo '</select>';
            echo '<span id="roomTypeError" class="error"></span><br>';

            echo '<label for="price">Price:</label>';
            echo '<input type="number" name="price" id="price" placeholder="Price" required>';
            echo '<span id="priceError" class="error"></span><br>';

            echo '<input type="submit" name="add_room" value="Add Room">';
            echo '</form>';
        } else {
            echo "Hostel owner details not found.";
        }
    } else {
        echo "Please log in as a hostel owner.";
    }
    ?>

</body>

</html>
