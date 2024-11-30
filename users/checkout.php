<?php
session_start();
include('../inc/dbconnection.php');
// require_once('../function/function.php');
// secure();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>chech out</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 
   </head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info " >
        <a class="navbar-brand" href="#">AS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="../index.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../product.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>

            </ul>
        </div>

    </nav>
 
            
<div class="container">
     <h3>
     

        <?php
          if(isset($_SESSION['user_username'])){
           
            echo '<h3>Welcome '.$_SESSION['user_username'].'</h3>';
            echo '
            <a class="nav-link" href="logout.php">logout</a>
            ';
        }?>
     </h3>
       
      <?php
      if(!isset($_SESSION['user_username'])){
       include('user_login.php');
      }else{
        include('payment.php');

      }
      ?>
     
    </div>

               

       

   
	

<?php include ('../inc/footer.php'); ?>