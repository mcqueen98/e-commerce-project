<?php
        if (isset($_GET['delete_product'])) {
            $delete_product = $_GET['delete_product'];
            $delete_query = "DELETE FROM products WHERE id = $delete_product";
            mysqli_query($conn, $delete_query);
          if($delete_query){
            echo "<script>alert('Product deleted successfully');</script>";
            echo "<script>window.open('home.php','_self');</script>";
          }
        }
?>