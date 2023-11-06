<?php
include('conn.php'); // Include your database connection code
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Welcome, $username! Manage your hostels here.";

    // Retrieve the hostel owner's details from the database
    $owner_query = "SELECT * FROM hostel_owners WHERE username = '$username'";
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
                echo "Room added successfully!";
            } else {
                echo "Error adding room: " . $conn->error;
            }
        }

        // Display Add Room Form
        echo '
        <h2>Add Room</h2>
        <form method="post" action="" id="addRoomForm">
    <input type="text" name="room_number" id="room_number" placeholder="Room Number" required>
    <span id="roomNumberError" class="error"></span>

    <input type="text" name="room_type" id="room_type" placeholder="Room Type" required>
    <span id="roomTypeError" class="error"></span>

    <input type="number" name="price" id="price" placeholder="Price" required>
    <span id="priceError" class="error"></span>

    <input type="submit" name="add_room" value="Add Room">
</form>
<script>
    const addRoomForm = document.getElementById("addRoomForm");
    const roomNumber = document.getElementById("room_number");
    const roomType = document.getElementById("room_type");
    const price = document.getElementById("price");
    const roomNumberError = document.getElementById("roomNumberError");
    const roomTypeError = document.getElementById("roomTypeError");
    const priceError = document.getElementById("priceError");

    addRoomForm.addEventListener("submit", function (event) {
        let isValid = true;

        if (roomNumber.value.trim() === "") {
            roomNumberError.textContent = "Room Number is required.";
            isValid = false;
        } else {
            roomNumberError.textContent = "";
        }

        if (roomType.value.trim() === "") {
            roomTypeError.textContent = "Room Type is required.";
            isValid = false;
        } else {
            roomTypeError.textContent = "";
        }

        if (isNaN(price.value) || price.value <= 0) {
            priceError.textContent = "Price must be a valid positive number.";
            isValid = false;
        } else {
            priceError.textContent = "";
        }

        if (!isValid) {
            event.preventDefault(); // Prevent form submission if there are validation errors.
        }
    });
</script>
        ';
    } else {
        echo "Hostel owner details not found.";
    }
} else {
    echo "Please log in as a hostel owner.";
}
?>
