  <?php
    require_once __DIR__.'/bootstrap.php';
    require_once __DIR__.'/database.php';

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
    $validations['register'] = "This user is already registered";       
} else {
    // Inserting the new user into the database
    $query = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    if ($conn->query($query) === TRUE) {
        $validations['register'] = "Registration successful!";
    } else {
        $validations['register'] = "Error during registration: " . $conn->error;
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
            $validations['login'] = "Login successful!";
              session_start();
              header("Location: menu.php");

        // Stockez les informations de l'utilisateur dans la session
            $_SESSION['username'] = $username;


          } else {
            $validations['login'] = "Incorrect username or password.";
          }
      }
      echo $twig->render('login.html', [ 
        'validations' => $validations]);
  }
  else {
    echo $twig->render('login.html');
  }
   
  
?>

