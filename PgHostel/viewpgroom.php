<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
              body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
}

.container {
    display: flex;
}

.sidebar {
    width: 250px;
    height: 100%;
    overflow-y: auto;
    position: fixed;
    background-color: #333;
    color: #fff;
}

.sidebar a {
    padding: 10px;
    display: block;
    color: #fff;
    text-decoration: none;
}

.sidebar a:hover {
    background-color: #555;
}

.main-content {
    margin-left: 250px;
    padding: 20px;
    background-color: #fff;
}
.containerr {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        /* .logout {
            float: right;
        } */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        </style>
    </head>
    <body>
    <div class="container">
        <div class="sidebar">
            <h2>   PHMS | Owner</h2>
            <ul>
                <li><a href="pg_owner_dashboard.php">Home</a></li>
                <li><a href="addpgroom.php">Add Rooms</a></li>
                <li><a href="viewpgroom.php">View room</a></li>
                <li><a href="pgownerupdate.php">Update profile</a></li>
                <!-- <li><a href="manage_tenants.php">Manage Tenants</a></li>
                <li><a href="reports.php">Reports</a></li> -->
                <li><a href="logout.php" class="logout">Logout</a></li>
            </ul>
        </div>
        <!-- <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
            font-family: Arial, sans-serif;
        }

        .containerr {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        /* .logout {
            float: right;
        } */

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        </style> -->
    </head>
    <body>
    <div class="containerr">
    <h2>Rooms</h2>
    <?php
    include('conn.php');
    $sql = "SELECT room_number, room_type, price FROM pg_room";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        echo '<table>
                <tr>
                    <th>Room number</th>
                    <th>Room type</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>';
    
        while ($row = $result->fetch_assoc()) {
            $room_number = $row["room_number"];
            $room_type = $row["room_type"];
            echo "<tr>
                    <td>" . $room_number . "</td>
                    <td>" . $room_type . "</td>
                    <td>" . $row["price"] . "</td>
                    <td>
                <button onclick=\"updateRoom('" . $room_number . "')\">Update</button>
            </td>";
            // if ($status == 1) {
            //     echo "<button onclick=\"changeStatus('$username', 0);\">Deactivate</button>";
            // } else {
            //     echo "<button onclick=\"changeStatus('$username', 1);\">Activate</button>";
            // }
            echo "</td>
                </tr>";
        }
        echo '</table>';
    } else {
        echo "No users found.";
    }
    $conn->close();
    ?>
    </div>
    <script>
    function updateRoom(roomNumber) {
        // Redirect to pgroomupdate.php with the roomNumber parameter
        window.location.href = 'pgroomupdate.php?roomNumber=' + roomNumber;
    }
    </script>

     </body>
</html>