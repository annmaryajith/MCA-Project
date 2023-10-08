 <?php
include('conn.php');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $hashed_password = md5($password);

    // Check if the user is a client
    $sql_user = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $result_user = $conn->query($sql_user);

    if (!$result_user) {
        die("SQL query failed: " . $conn->error);
    }

    if ($result_user->num_rows > 0) {
        // login successful
        echo "Login successful.";
        header('Location: user.php');
        exit();
    }

    // Check if the user is an admin
    $sql_admin = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result_admin = $conn->query($sql_admin);

    if (!$result_admin) {
        die("SQL query failed: " . $conn->error);
    }

    if ($result_admin->num_rows > 0) {
        // Admin login successful
        echo "Admin login successful.";
        header('Location: admin.php');
        exit();
    }

    // If neither client nor admin, display an error message
    echo "Invalid username or password. <a href='login.php'>Go back</a>";
}

$conn->close();
?>  

 <!DOCTYPE html>
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title> Login Form </title>
      <link rel="stylesheet" href="css/style0.css">
      
   </head>
   <body>
      <div class="bg-img">
         <div class="content">
            <header>Login Form</header>
            <form action="" method="POST" id="login-form">
               <div class="field">
                  <span class="fa fa-user"></span>
                  <input type="text" class="username" name="username" required placeholder="Username">
                   <span id="username-error" class="error"></span>
               </div>
               <div class="field space">
                  <span class="fa fa-lock"></span>
                  <input type="password" class="password" name="password" required placeholder="Password">
                  <span id="password-error" class="error"></span>
                  <span class="show">SHOW</span>
               </div>
               <div class="pass">
                  <a href="#">Forgot Password?</a>
               </div>
               <div class="field">
                  <input name="submit" type="submit" value="LOGIN">
               </div>
            </form>
            
            <div class="signup">
               Don't have account?
               <a href="register.php">Register Now</a>
            </div>
         </div>
      </div>
      <script src="js/jsindex.js"></script>

      
   </body>
</html>

