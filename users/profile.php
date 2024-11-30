<?php
@session_start();
include('../inc/dbconnection.php');
require_once '../function/function.php';



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  </head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-info">
    <a class="navbar-brand" href="#">AS</a>
    <ul class="navbar-nav d-flex flex-row">
        <li class="nav-item active me-3">
            <a class="nav-link" href="../index.php">Home <span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mx-3">
            <a class="nav-link" href="../product.php">Products</a>
        </li>
    </ul>
</nav>


 
    <div class="container">
      <h3> <?php
          if(!isset($_SESSION['user_username'])){
            echo '<h3>Welcome Guest</h3>';
        }else{
            echo '<h3>Welcome '.$_SESSION['user_username'].'</h3>';


        }
        ?>
          <?php
          if(!isset($_SESSION['user_username'])){
            echo '
            <a class="nav-link " href="user_login.php">login </a>
            ';
        }else{

            echo '
            <a class="nav-link" href="logout.php">logout</a>
            ';
        }?>
       </h3>
 </div>
 <div class="card-header">
 <?php
// Check if 'edit_profile' is set in the query string
if (isset($_GET['edit_profile'])) {
   include('user_edit.php');
   exit();
   
}
if(isset($_GET['my_order'])){
    include('user_order.php');
    exit();
}
if (isset($_GET['delete_profile'])) {
    $user_name = $_SESSION['user_username'];
    // Assuming you have the connection in $conn
    $delete_user = "DELETE FROM user WHERE user_name = '$user_name'";
    $delete_query = mysqli_query($conn, $delete_user);

    if ($delete_query) {
        session_destroy();
        header("Location: ../index.php");
        exit();
    } else {
        echo "Error deleting user.";
    }
}

?>

              <button class="btn btn-primary "><a class=  "text-white" href="profile.php?edit_profile"> Edit Profile</a></button>
              <button class="btn btn-primary "><a class="text-white" href="profile.php?my_order"> My Order</a></button>
              <button class="btn btn-danger "><a class="text-white" href="profile.php?delete_profile"> Delete Profile</a></button>





 </div>
          <div class="container mt-5">
    <!-- Profile Section -->
    <?php
    user_detail(); // Call your user detail function

    // Check if 'my_order' is set in the query string
    

    ?>

</div>
      
         
   


<?php include('../inc/footer.php'); ?>