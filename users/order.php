<?php

include('../inc/dbconnection.php');
include('../function/function.php');

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
} else {
    die("User ID is not specified.");
}

// Get the unique IP or identifier for the user
$getip = getUniqueIdentifier();
$total_price = 0;

// Retrieve items from the cart
$get_user = "SELECT * FROM `cart` WHERE ip='$getip'";
$result_user = mysqli_query($conn, $get_user);
$count_product = mysqli_num_rows($result_user);

if ($count_product > 0) {  // Only proceed if there are products in the cart
    $status = 'pending';

    // Process each item in the cart
    while ($row_product = mysqli_fetch_array($result_user)) {
        $cart_id = $row_product['cart_id'];
        $cart_price = $row_product['product_price'];
        $quantity = $row_product['quantity']; // Get quantity for each product
        $product_id = $row_product['product_id']; // Assuming 'product_id' is the correct foreign key

        // Get product details
        $get_product = "SELECT * FROM `products` WHERE id='$product_id'";
        $result_product = mysqli_query($conn, $get_product);

        if (mysqli_num_rows($result_product) > 0) {
            while ($row_product_detail = mysqli_fetch_array($result_product)) {
                $product_price = $row_product_detail['price'];
                $total_price += $product_price * $quantity; // Multiply by quantity
            }
            $username = isset($_SESSION['user_username']);
            
            // Insert each cart item into the pending table
            //pending is used to verify by admin
            $insert_pending_order = "INSERT INTO `pending` (`pro_id`, `quantity`, `amount`, `product_id`, `user_id`) 
                                     VALUES ('$cart_id', '$quantity', '$cart_price', '$product_id', '$user_id')";
            $result_pending_order = mysqli_query($conn, $insert_pending_order);

            if (!$result_pending_order) {
                echo "Error inserting pending order: " . mysqli_error($conn);
            }

            // Insert each cart item into the orders table individually
            $insert_order = "INSERT INTO `orders` (`user_id`, `amount`, `total_pro`, `status`, `date`, `product_id`, `cart_id`) 
                             VALUES ('$user_id', '$cart_price', '$quantity', '$status', NOW(), '$product_id', '$cart_id')";
            $result_order = mysqli_query($conn, $insert_order);

            if (!$result_order) {
                echo "Error inserting order: " . mysqli_error($conn);
            }
        } else {
            echo "No product found for cart ID: $cart_id";
        }
    }

    // Clear the cart after processing
    $delete_cart = "DELETE FROM `cart` WHERE ip='$getip'";
    $result_delete_cart = mysqli_query($conn, $delete_cart);

    if (!$result_delete_cart) {
        echo "Error deleting cart: " . mysqli_error($conn);
    } else {
        echo "<script>alert('Order placed successfully');</script>";
        echo "<script>window.open('profile.php', '_self');</script>";
    }
} else {
    echo "<script>alert('Cart is empty, cannot place order');</script>";
    echo "<script>window.open('profile.php', '_self');</script>";
}
?>
