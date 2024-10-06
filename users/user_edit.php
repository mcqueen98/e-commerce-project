<?php
include('../function/function.php');
secure();
if (isset($_GET['edit_profile'])) {
    $username = $_SESSION['user_username'];
    $get_user = "SELECT * FROM user WHERE user_name = '$username'";
    $query = mysqli_query($conn, $get_user);

    if (!$query) {
        die("Query failed: " . mysqli_error($conn));
    }

    $row = mysqli_fetch_assoc($query);
    
    if ($row) {
        $user_id = $row['user_id'];
        $user_name = $row['user_name'];
        $user_email = $row['user_email'];
        $user_password = $row['password'];

        if (isset($_POST['submit'])) {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
        
            // Hash the new password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
            $update_user = "UPDATE user SET user_name = '$username', user_email = '$email', password = '$hashed_password' WHERE user_id = '$user_id'";
            $query_update = mysqli_query($conn, $update_user);
            
            if ($query_update) {
                // Update the session variable
                $_SESSION['user_username'] = $username;
                echo "<script>alert('User updated successfully');</script>";
                echo "<script>window.open('profile.php','_self');</script>";
            } else {
                echo "<script>alert('Error updating user: " . mysqli_error($conn) . "');</script>";
            }
        }
        
    } else {
        echo "No user found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Page</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Edit Information Form</h2>
    <form action="" method="POST">
        <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" value="<?php echo isset($user_name) ? $user_name : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo isset($user_email) ? $user_email : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
