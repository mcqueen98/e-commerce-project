<?php

include('./inc/dbconnection.php');
include('function/function.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 </head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-info " >
        <a class="navbar-brand" href="#">AS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Products</a>
                </li>
                <li class="nav-item active">
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

<!-- About Us Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="https://th.bing.com/th?id=OIP.USfxcjeZXZwHvhJJez4uiAHaE7&w=306&h=203&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="About Us" class="img-fluid rounded shadow">
            </div>
            <div class="col-lg-6">
                <h2>About Us</h2>
                <p class="text-muted">
                    Welcome to our e-commerce platform! We are a single-seller business dedicated to providing high-quality, handpicked products just for you. 
                    Our goal is to offer a curated selection of items that cater to your needs, ensuring both quality and satisfaction with every purchase.
                </p>
                <p class="text-muted">
                    With a focus on exceptional service and exclusive products, we aim to make your shopping experience seamless and enjoyable.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Contact Us Section -->
<section class="py-5 bg-info text-white">
    <div class="container">
        <h2 class="text-center mb-5">Contact Us</h2>
        <div class="row">
            <div class="col-lg-6">
                <h5>Phone</h5>
                <p>+1 123 456 7890</p>
                <p>+1 987 654 3210</p>
            </div>
            <div class="col-lg-6">
                <h5>Email</h5>
                <p>info@ecommerce.com</p>
            </div>
            <div class="col-lg-12 mt-3">
                <h5>Address</h5>
                <p>123 Main Street, Downtown, Cityville, Country</p>
            </div>
        </div>
    </div>
</section>

<?php include('./inc/footer.php'); ?>


