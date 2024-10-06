<?php
session_start();
include('../inc/dbconnection.php');
include('../function/function.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <form action="" method="post">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <h3 class="text-center">Register</h3>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm password" required>
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary w-100">Sign Up</button>
                    <p>Already have an account? <a href="user_login.php">Login</a></p>
                </div>
            </div>
        </div>
    </form>

    <?php
    if (isset($_POST['submit'])) {
        // Fetch and sanitize form data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirm_password = $_POST['confirm_password'];

        // Check username
        $check_username_query = "SELECT * FROM user WHERE user_name = '$username'";
        $result = mysqli_query($conn, $check_username_query);

        if (mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username already exists. Please choose another one.');</script>";
        } elseif ($password == $confirm_password) {
            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $_SESSION['username'] = $username; // Set session username before generating user_ip
            $user_ip = getUniqueIdentifier(); // Get user IP after setting the session

            $insert_user = "INSERT INTO user (user_name, user_email, password, user_ip) 
                            VALUES ('$username', '$email', '$hashed_password', '$user_ip')";

            $query = mysqli_query($conn, $insert_user);
            
            if ($query) {
                echo "<script>alert('User registered successfully');</script>";
                echo "<script>window.location.href='user_login.php';</script>";
            } else {
                die(mysqli_error($conn));
            }
        } else {
            echo "<script>alert('Passwords do not match');</script>";
        }

        // Selecting cart items
        $select_cart_items = "SELECT * FROM cart WHERE ip = '$user_ip'";
        $result_cart = mysqli_query($conn, $select_cart_items);
        $rows_count = mysqli_num_rows($result_cart);

        if ($rows_count > 0) {
            echo '<script>alert("You have items in your cart")</script>';
        }
    }
    ?>
</body>
</html>
