<?php
session_start();
include '../inc/dbconnection.php';
include '../function/function.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['register'])) {
        // Handle registration
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password for security

        // Check if the email already exists
        $checkEmail = $conn->prepare("SELECT * FROM admin WHERE email = ?");
        $checkEmail->bind_param('s', $email);
        $checkEmail->execute();
        $result = $checkEmail->get_result();

        if ($result->num_rows > 0) {
            echo "Email already exists!";
        } else {
            // Insert new admin user
            $stmt = $conn->prepare("INSERT INTO admin (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param('sss', $username, $email, $password);

            if ($stmt->execute()) {
                echo "Registration successful!";
            } else {
                echo "Registration failed!";
            }
        }
    } elseif ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
        $username = $_POST['username'];
        $password = $_POST['password'];
    
        $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ?");
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Login successful, store the username in session
                $_SESSION['admin_username'] = $row['username'];
                header("Location: home.php"); 
                exit;
            } else {
                echo "Invalid credentials!";
            }
        } else {
            echo "No user found with this username!";
        }
    }
    
    
    
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="style.css" />
    <title>Login Page </title>
  </head>

  <body>
    <div class="container" id="container">
      <div class="form-container sign-up">
        <form method="POST">
          <h1>Create Account</h1>
          <input type="text" name="username" placeholder="Username" required />
          <input type="email" name="email" placeholder="Email" required />
          <input type="password" name="password" placeholder="Password" required />
          <button type="submit" name="register">Register</button>
        </form>
      </div>
      <div class="form-container sign-in">
        <form method="POST">
          <h1>Login</h1>
          <input type="text" name="username" placeholder="Username" required />
          <input type="password" name="password" placeholder="Password" required />
          <button type="submit" name="login">Login</button>
        </form>
      </div>
      <div class="toggle-container">
        <div class="toggle">
          <div class="toggle-panel toggle-left">
            <h1>Welcome!</h1>
            <p>Enter your details to use all of the site's features</p>
            <button class="hidden" id="login">Login</button>
          </div>
          <div class="toggle-panel toggle-right">
            <h1>Hello, Admin!</h1>
            <p>Register with your personal details to use all of the site's features</p>
            <button class="hidden" id="register">Register</button>
          </div>
        </div>
      </div>
    </div>

    <script>
      const container = document.getElementById('container');
      const registerBtn = document.getElementById('register');
      const loginBtn = document.getElementById('login');

      registerBtn.addEventListener('click', () => {
        container.classList.add("active");
      });

      loginBtn.addEventListener('click', () => {
        container.classList.remove("active");
      });
    </script>
  </body>
</html>
