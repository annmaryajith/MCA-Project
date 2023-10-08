<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            text-align: center;
        }

        .logout {
            float: right;
        }

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
    <h2>User</h2>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone no</th>
                <th>Action</th>
            </tr>
            <?php
            // Include database connection code
            include('conn.php');

            if (isset($_GET['success'])) {
                echo "<div style='color:green;'>" . $_GET['success'] . "</div>";
            } elseif (isset($_GET['error'])) {
                echo "<div style='color:red;'>" . $_GET['error'] . "</div>";
            }

            // SQL query to fetch all users
            $sql = "SELECT name,email,phno FROM users";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["name"] . "</td>";
                    echo "<td>" . $row["email"] . "</td>";
                    echo "<td>" . $row["phno"] . "</td>";
                    echo "<td>
                         <a href='delete_customer.php?id=" . $row["name"] . "'>Delete</a>
                         </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4'>No users found.</td></tr>";
            }
            

            $conn->close();
            ?>
    </table>    
    </div>  
    </body>
</html>

