<!DOCTYPE html>

<html>
<head>
  <title>Restaurant - Registration/Login</title>
</head>
<body>
  <h1>Registration</h1>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="hidden" name="action" value="register">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Register">
  </form>
  <h1>Login</h1>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <input type="hidden" name="action" value="login">
    <label for="username">Username:</label>
    <input type="text" id="username" name="username" required><br><br>
    <label for="password">Password:</label>
    <input type="password" id="password" name="password" required><br><br>
    <input type="submit" value="Login">
  </form>

  <?php
  // Database configuration
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "resto";

  // Establishing database connection
  $conn = new mysqli($servername, $username, $password, $dbname);

  // Checking connection errors
  if ($conn->connect_error) {
      die("Database connection error: " . $conn->connect_error);
  }

  // Checking the action to perform (registration or login)
  if (isset($_POST['action'])) {
      $action = $_POST['action'];

      if ($action === 'register') {
          // Registration
          $username = $_POST['username'];
          $password = $_POST['password'];

          // Checking if the user already exists
          $query = "SELECT * FROM users WHERE username = '$username'";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
              echo "This user already exists.";
          } else {
              // Inserting the new user into the database
              $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
              if ($conn->query($query) === TRUE) {
                  echo "Registration successful!";
              } else {
                  echo "Error during registration: " . $conn->error;
              }
          }
      } elseif ($action === 'login') {
          // Login
          $username = $_POST['username'];
          $password = $_POST['password'];

          // Checking user's credentials
          $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
          $result = $conn->query($query);

          if ($result->num_rows > 0) {
              echo "Login successful!";
              session_start();
              header("Location: menu.php");

        // Stockez les informations de l'utilisateur dans la session
            $_SESSION['username'] = $username;


          } else {
              echo "Incorrect username or password.";
          }
      }
  }
?>
</body>
</html>

