
<!DOCTYPE html>
<html>
<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/styleuser.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <style>
        .pg {
            border: 1px solid #ccc;
            margin: 20px;
            padding: 10px;
            display: flex;
        }

        .pg img {
            max-width: 200px;
            max-height: 150px;
        }

        .pg-content {
            margin-left: 20px;
        }

        .book-button {
            background-color: #007bff;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        /* .search-container {
    text-align: right; /* Align the content to the right */
  /* } */ 

  .search-container input[type="text"] {
    margin-left: 20px; /* Add left margin to move the input to the right */
  }


    </style>
</head>

<body>
<!-- 
  <div class="hero_area">

    <div class="hero_bg_box">
      <div class="bg_img_box">
        <img src="images/login.jpg" width="100%" height="100%">
      </div>
    </div> -->

    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="">
            <span>
              PHMS
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="userhome.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="pguserview.php"> PG</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="user.php">HOSTEL</a>
              <li class="nav-item">
                <a class="nav-link" href="useredit.php">PROFILE</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php"> <i class="fa fa-user" aria-hidden="true"></i> Logout</a>
              </li>
              </form>
            </ul>
          </div>
        </nav>
      </div>
      <br><br>
    <form action="search.php" method="GET">
    <div class="search-container">
        <input type="text" name="query" placeholder="Search..." />
        <button type="submit">Search</button>
    </div>
    </form>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pg</title>
    <!-- Add your CSS styles here -->
    <style>
        /* Your CSS styles for hostels can go here */
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .pg {
            border: 1px solid #ccc;
            margin: 20px;
            padding: 10px;
            display: flex;
        }

        .pg img {
            max-width: 200px;
            max-height: 150px;
        }

        .pg-content {
            margin-left: 20px;
        }

        .book-button {
            background-color: #000000;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .search-container input[type="text"] {
    padding-left: 10px; /* Add left padding to move the input to the right */
  }
    </style>
</head>

<body>

    <?php
    include('conn.php');

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Fetch hostel data from the database
    $sql = "SELECT * FROM pg INNER JOIN pg_room ON pg.pg_name = pg_room.pg_name";
    $result = mysqli_query($conn, $sql);

    // Display hostels
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<div class='pg'>";
        echo "<img src='images/" . $row['pg_image'] . "' alt='" . $row['pg_name'] . "'>";
        echo "<div class='pg-content'>";
        echo "<h2>" . $row['pg_name'] . "</h2>";
        echo "<p><strong>Location:</strong> " . $row['pg_location'] . "</p>";
        echo "<p><strong>Room Type:</strong> " . $row['room_type'] . "</p>";
        echo "<p><strong>Amount:</strong> Rs." . $row['price'] . "</p>";
        // echo "<p><strong>Description:</strong>" . $row['description'] . "</p>";
        // echo "<button class='book-button'>Book Now</button>";
        echo "<a href='booking.php' class='book-button'>Book Now</a>";
        echo "</div>";
        echo "</div>";
    }

    // Close the database connection
    mysqli_close($conn);
    ?>

</body>

</html>
