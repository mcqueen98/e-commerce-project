<?php
session_start();
include('./inc/dbconnection.php');
include('function/function.php');

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
    <nav class="navbar navbar-expand-lg navbar-dark bg-info " >
        <a class="navbar-brand" href="#">AS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="about.php">About Us</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="cart.php">cart  <sup  style="color:white;">
                        <?php cart_item();?>
                    </sup></a>
                </li>
                <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Category
                   </a>
                    <ul class="dropdown-menu">
                    <?php
                   getcategory();
                 
                    ?>
                  </ul>
                 </li>
        
               <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                       brand
                     </a>
                       <ul class="dropdown-menu">
            
                                       <?php
                                        getbrand();  ?>

                        </ul>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="">total price: <sup  style="color:white;">
                        <?php total_price();?>
                    </sup></a>
                </li>
              

        
           
        </div>
        
        <form class="form-inline my-2 my-lg-0" action="search.php" method="GET">
            <input class="form-control mr-sm-2" type="search" name="search_data" placeholder="Search" aria-label="Search">
           <input type="submit"  value= 'search' class="btn btn-outline-dark" name="search_data_pro">
        </form>
        
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
            <a class="nav-link" href="users/user_login.php">login </a>  ';
        }else{
            echo '
            <a class="nav-link" href="users/logout.php">logout</a>
            <a class="nav-link" href="users/profile.php">profile</a>
            ';
        }?>
       </h3>
  </div>
   
	<div class="container mt-4">
        
           
            
         <div class="row">
             <?php
                cart();
              view_details(); 
               get_unique_cat();
               get_unique_brand();  
               
               
               $unique_identifier = getUniqueIdentifier();
   
               
               ?>


                
         </div>
        </div>

<?php include('./inc/footer.php'); ?>