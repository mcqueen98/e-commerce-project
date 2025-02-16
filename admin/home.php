<?php

include '../inc/dbconnection.php';
include '../function/function.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional theme -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap-theme.min.css" rel="stylesheet">
</head>
<body>
<h1>Admin Panel</h1>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="#">AS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="home.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home.php?add_product">add Products</a>
                </li> 
                
                <li class="nav-item">
                    <a class="nav-link" href="home.php?view_product">view product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home.php?brand">insertcBrands</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="home.php?view_brand">view Brands</a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="home.php?category"> insert Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home.php?view_category">view category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home.php?view_order">order</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="logout.php">logout</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="home.php?verify">verify</a>
                </li>
            </ul>
        </div>
    </nav>
 
    <h2>Welcome <?php
  
    echo $_SESSION['admin_username']; ?>
    </h2>
    
    <div>
    <?php
       if (isset($_GET['add_product'])) {
        include ('add_product.php');
    }
        if (isset($_GET['category'])) {
  
          include ('category.php')    ;
    
      } 
      if (isset($_GET['brand'])) {
  
          include ('brand.php');
    
      }
      if (isset($_GET['view_product'])) {
  
        include ('view_product.php');
    
      }
      if (isset($_GET['edit_product'])) {
  
    include ('edit_product.php');
    
     }


     if (isset($_GET['delete_product'])) {
    include ('delete_product.php');
     }
 
     if (isset($_GET['view_category'])) {
      include ('view_category.php');
     }
     if (isset($_GET['edit_category'])) {
     include ('edit_category.php');
     }
     if (isset($_GET['verify'])) {
      include ('verify.php');
     }

           // Handle the delete request
          if (isset($_GET['delete_category'])) {
    $category_id = $_GET['delete_category'];
    
    // Assuming a connection to the database exists ($conn)
    $delete_query = "DELETE FROM category WHERE catid = $category_id";
    
    if (mysqli_query($conn, $delete_query)) {
        echo"<script>alert('category deleted successfully');</script>";
        // Successful deletion, redirect to the home page or show a message
        header("Location: home.php");
        exit();
    } else {
        echo "Error deleting category: " . mysqli_error($conn);
    }
  } 

      if (isset($_GET['view_order'])) {
   include ('view_order.php');
   }


?>
    </div>
    <!-- Header -->


	  <!-- Footer -->
	  <footer class="bg-dark text-white py-4">
        <div class="container text-center">
            <p class="mb-0">&copy; <?php echo date('Y'); ?> AS Shop. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
