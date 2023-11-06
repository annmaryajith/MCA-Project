<?php
include('conn.php'); // Include your database connection code

$errorMessage = ""; // Initialize an error message variable

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["create_owner"])) {
    $hostelname = $_POST["hostelname"];
    $username = $_POST["username"];
    $password = $_POST["password"]; // You should hash the password for security

    // Check if the username is already taken
    $checkUsernameQuery = "SELECT * FROM login WHERE username = '$username'";
    $result = $conn->query($checkUsernameQuery);

    if ($result->num_rows > 0) {
        $errorMessage = "Username already exists. Please choose a different one.";
    } else {
        // Hash the password for security (e.g., using password_hash)
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the 'login' table
        $insertLoginQuery = "INSERT INTO login (username, password) VALUES ('$username', '$password')";

        if ($conn->query($insertLoginQuery) === TRUE) {
            // Insert data into the 'hostel_owners' table
            $insertOwnerQuery = "INSERT INTO hostel_owners (hostel_owner,hostel_name, username,password) VALUES ('$hostelname','$hostelname', '$username','$password')";
            
            if ($conn->query($insertOwnerQuery) === TRUE) {
                echo "Hostel owner created successfully!";
            } else {
                echo "Error inserting data into 'hostel_owners' table: " . $conn->error;
            }
        } else {
            echo "Error inserting data into 'login' table: " . $conn->error;
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <!-- Add your CSS styles here -->
    <style>
        body {
            margin: 0;
            font-family: Verdana, sans-serif;
        }

        .sidebar {
    height: 100vh;
    width: 300px;
    position: fixed;
    top: 0;
    left: 0;
    background-color: black; /* Change to black background color */
    padding-top: 20px;
}


        .sidebar h2 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        ul li a {
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            transition: 0.3s;
        }

        ul li a:hover {
            background-color: black; /* Slightly lighter blue for hover effect */
        }

        .content {
            margin-left: 350px;
            padding: 20px;
            transition: margin-left 0.3s;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 200px;
            }

            .content {
                margin-left: 200px;
            }
        }

        ul li a.active {
            background-color: #3949ab;
            font-weight: bold;
        }



    </style>
</head>

<body>
<div class="container">
    <div class="sidebar">
        <h2>Admin Dashboard</h2>
        <ul>
            
            <li><a href="admin.php">Home</a></li>
            <li><a href="userview.php">Users</a></li>
            <li>
                <a href="javascript:void(0);" onclick="toggleHostelSubmenu()">Pg</a>
                <div class="sub-options" style="display: none;">
                    <ul>
                        <li><a href="viewpg.php">View Pg</a></li>
                        <li><a href="addpg.php">Add Pg</a></li>
                        <li><a href="viewpgowner.php">View Owner</a></li>
                        <li><a href="addpgowner.php">Add Owner</a></li>
                    </ul>
                </div>
                </li>
            <li>
                <a href="javascript:void(0);" onclick="toggleHostelSubmenu()">Hostel</a>
                <div class="sub-options" style="display: none;">
                    <ul>
                        <li><a href="viewhostel.php">View Hostel</a></li>
                        <li><a href="addhostel.php">Add Hostel</a></li>
                        <li><a href="addowner.php">Add Owner</a></li>
                    </ul>
                </div>
            </li>
            <li><a href="logout.php" class="logout">Logout</a></li>
        </ul>
    </div>
</div>

<script>
    function toggleHostelSubmenu() {
        var subOptions = document.querySelector(".sub-options");
        if (subOptions.style.display === "none" || subOptions.style.display === "") {
            subOptions.style.display = "block";
        } else {
            subOptions.style.display = "none";
        }
    }
</script>
    <title>Create Pg Owner</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f2f2f2;
    }

    h2 {
        text-align: center;
        color: #333;
    }

    form {
        max-width: 400px;
        margin: 0 auto;
        background-color: #fff;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    label {
        display: block;
        margin-bottom: 10px;
        color: #333;
    }

    input[type="text"],
    input[type="password"] {
        width: 100%; /* Set to 100% for full-width */
        padding: 8px; /* Decrease padding for smaller input boxes */
        margin-bottom: 10px; /* Reduce margin for smaller gap */
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    input[type="submit"] {
        background-color: black;
        color: white;
        padding: 10px 20px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
    }

    input[type="submit"]:hover {
        background-color: #45a049;
    }
        /* Add this CSS to center-align the error message */
        .error-message {
            text-align: center;
            color: red;
        }
    .error {
            color: red;
}
    </style>

</head>

<div class="error-message">
        <?php echo $errorMessage; ?>
    </div>

<body>
    <h2>Add Pg Owner</h2>
    <form action="" method="POST" id="createOwnerForm">
    <label for="hostelname">Pg name:</label>
    <input type="text" name="hostelname" id="hostelname" required>
    <span id="hostelnameError" class="error"></span>

    <label for="username">Username:</label>
    <input type="text" name="username" id="username" required>
    <span id="usernameError" class="error"></span>

    <label for="password">Password:</label>
    <input type="password" name="password" id="password" required>
    <span id="passwordError" class="error"></span>

    <input type="submit" name="create_owner" value="Create Pg Owner">
</form>

<script>
    const createOwnerForm = document.getElementById("createOwnerForm");
    const hostelname = document.getElementById("hostelname");
    const username = document.getElementById("username");
    const password = document.getElementById("password");
    const hostelnameError = document.getElementById("hostelnameError");
    const usernameError = document.getElementById("usernameError");
    const passwordError = document.getElementById("passwordError");

    hostelname.addEventListener("input", validateHostelName);
    username.addEventListener("input", validateUsername);
    password.addEventListener("input", validatePassword);

    function validateHostelName() {
        const hostelnameValue = hostelname.value.trim();
        if (hostelnameValue === "") {
            hostelnameError.textContent = "Hostel name is required.";
        } else if (hostelnameValue.length < 5) {
            hostelnameError.textContent = "Hostel name must be at least 5 characters.";
        } else {
            hostelnameError.textContent = "";
        }
    }

    function validateUsername() {
        const usernameValue = username.value.trim();
        if (usernameValue === "") {
            usernameError.textContent = "Username is required.";
        } else if (usernameValue.length < 5) {
            usernameError.textContent = "Username must be at least 5 characters.";
        } else {
            usernameError.textContent = "";
        }
    }

    function validatePassword() {
        const passwordValue = password.value.trim();
        if (passwordValue === "") {
            passwordError.textContent = "Password is required.";
        } else if (passwordValue.length < 5) {
            passwordError.textContent = "Password must be at least 5 characters.";
        } else {
            passwordError.textContent = "";
        }
    }

    createOwnerForm.addEventListener("submit", function (event) {
        validateHostelName();
        validateUsername();
        validatePassword();

        if (
            hostelnameError.textContent !== "" ||
            usernameError.textContent !== "" ||
            passwordError.textContent !== ""
        ) {
            event.preventDefault(); // Prevent form submission if there are validation errors.
        }
    });
</script>

</body>
</html>
