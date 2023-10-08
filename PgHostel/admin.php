

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            background-color: #black; /* Slightly lighter blue for hover effect */
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
            <li><a href="userview.php">Users</a></li>
            <li><a href="#pg">PG</a></li>
            <li><a href="#hostel">Hostel</a></li>
            <li><a href="logout.php" class="logout">Logout</a>  </li>
        </ul>
        </div>

        <div class="content">
            <h2>Welcome, Admin!</h2>
            <!-- Content for each section (Customers, Staff, Medicine) goes here -->
        </div>
        <a href="logout.php" class="logout">Logout</a>   
        </table>
    </div>
</body>

</html>
