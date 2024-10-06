<?php

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
<body> <form action="" method="post">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <daiv class="col-md-6">
                    <h3 class="text-center">login</h3>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                    </div>
               
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                    </div>
                  <button type="submit" name="submit" class="btn btn-primary w-100">login</button>
                    <p>dont have account? <a href="user_register.php">register</a></p>
                </div>
            </div>
        </div>
    </form>

</body>
</html>
<?php

global $conn;
if (isset($_POST['submit'])) {
    // Retrieve user input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if the user exists
    $select_user = "SELECT * FROM user WHERE user_name = '$username'";
    $query_user = mysqli_query($conn, $select_user);
    $row_count = mysqli_num_rows($query_user);

    if ($row_count > 0) {
        // Fetch user details
        $row = mysqli_fetch_assoc($query_user);
        $user_id = $row['user_id']; // Assuming you have a unique user_id column
        $user_password = $row['password']; // Hashed password from the database

        // Verify the password
        if (password_verify($password, $user_password)) {
            // Set session variables
            $_SESSION['user_username'] = $username;
            $_SESSION['user_id'] = $user_id; // Store user_id in session

            // Get unique identifier for the user session or IP
            $user_ip = getUniqueIdentifier();

            // Check if there are items in the user's cart
            $select_cart = "SELECT * FROM cart WHERE ip = '$user_ip'";
            $query_cart = mysqli_query($conn, $select_cart);
            $row_count_cart = mysqli_num_rows($query_cart);

            // Redirect based on whether the cart is empty
            if ($row_count_cart == 0) {
                echo "<script>alert('Login successful');</script>";
                echo "<script>window.open('profile.php', '_self');</script>";
            } else {
                echo "<script>window.open('payment.php', '_self');</script>";
            }
        } else {
            echo "<script>alert('Password is incorrect');</script>";
        }
    } else {
        echo "<script>alert('Username is incorrect');</script>";
    }
}
?>