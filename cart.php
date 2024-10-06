<?php
include('./inc/dbconnection.php');
include('function/function.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cartPage</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
 
<style>
    .image{
        width: 75px;
        height: 75px;

    }
</style> 
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-info " >
        <a class="navbar-brand" href="#">Pet Shop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>  
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="product.php">Products</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="cart.php">cart  <sup  style="color:white;">
                        <?php cart_item();?>
                    </sup></a>
                </li>
               
                 </li>
            </ul>
        </div>
        
     
    </nav>

    <!-- Header -->
    <header class="bg-dark " id="main-header">
        <div class="container px-4 px-lg-5  py-5">
            <div class="text-center text-white">
                <h1 class="display-4 fw-bolder">Your Cart</h1>
                
            </div>
        </div>
    </header>
    <?php
// Function to display cart items
function display_cart(){
    global $conn;
    $ip = getUniqueIdentifier();
    $total = 0;

    // Select products in the cart based on IP
    $select_query = "SELECT * FROM cart WHERE ip = '$ip'";
    $result_query = mysqli_query($conn, $select_query);

    // Modify the table structure and form
    echo '<form action="" method="post">
    <table class="table table-bordered text-center">
        <thead>
           <tr>
             <th>Title</th>
             <th>Image</th>
             <th>Quantity</th>
             <th>Price</th>
             <th>Operation</th>
         </tr>
        </thead>
      <tbody>';

      // Iterate over each cart item
          while ($row = mysqli_fetch_array($result_query))
           {
              $cart_id = $row['cart_id']; // This is the cart item ID, not the product ID
              $product_id = $row['product_id']; // Assuming you have a product_id column in your cart table
              $quantity = $row['quantity'];

              // Fetch product details from the products table
              $select_product = "SELECT * FROM products WHERE id = '$product_id'";
              $result_product = mysqli_query($conn, $select_product);

              while ($row_product = mysqli_fetch_array($result_product)) {
              $product_title = $row_product['product_title'];
              $product_price = $row_product['price'];
              $product_img = $row_product['product_img'];
              $total += $product_price * $quantity; // Calculate total based on quantity

              // Insert product data into the table
                       echo '
              <tr>
              <td>' . $product_title . '</td>
              <td><img class="image" src="./uploads/' . $product_img . '" alt="' . $product_title . '" /></td>
              <td><input type="number" name="quantity[' . $cart_id . ']" value="' . $quantity . '" min="1"></td>
                  <td>$' . number_format($product_price, 2) . '</td>
     <td>
             <button type="submit" name="update_cart" value="' . $cart_id . '">Update</button>
             <button type="submit" name="delete_cart" value="' . $cart_id . '">Delete</button>
         </td>
     </tr>';
 }
}

     echo '
   </tbody> 
    </table>
  </form>';

// Display total price
echo "<h3>Total Price: $" . number_format($total, 2) . "</h3>";
}

      //update quantity
      function update_quantity(){
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    global $conn;
    if (isset($_POST['update_cart'])) {
        $cart_id = $_POST['update_cart'];
        $new_quantity = $_POST['quantity'][$cart_id];
        
        // Update the quantity in the database
        $update_query = "UPDATE cart SET quantity = ? WHERE cart_id = ?";
        $stmt = mysqli_prepare($conn, $update_query);
        mysqli_stmt_bind_param($stmt, "ii", $new_quantity, $cart_id);
        
        if (mysqli_stmt_execute($stmt)) {
            echo "<script>alert('Cart updated successfully!');</script>";

            // Recalculate the total after updating the cart
            $total = 0;
            $ip = getUniqueIdentifier();
            $select_query = "SELECT * FROM cart WHERE ip = '$ip'";
            $result_query = mysqli_query($conn, $select_query);
            while ($row = mysqli_fetch_array($result_query)) {
                $product_id = $row['product_id'];
                $quantity = $row['quantity'];
                
                $select_product = "SELECT * FROM products WHERE id = '$product_id'";
                $result_product = mysqli_query($conn, $select_product);
                while ($row_product = mysqli_fetch_array($result_product)) {
                    $product_price = $row_product['price'];
                    $total += $product_price * $quantity;
                }
            }

            // Refresh the page to reflect changes
             echo "<script>window.location.href='cart.php';</script>";
        } else {
            echo "<script>alert('Failed to update cart.');</script>";
        }

        mysqli_stmt_close($stmt);
    }
}

    // Handle delete_cart action here if needed 
  
if (isset($_POST['delete_cart'])) {
    $cart_id = $_POST['delete_cart'];

    // Delete the item from the cart
    $delete_query = "DELETE FROM cart WHERE cart_id = ?";
    $stmt = mysqli_prepare($conn, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $cart_id);

    if (mysqli_stmt_execute($stmt)) {
        echo "<script>alert('Item deleted successfully!');</script>";

        // Recalculate the total after deletion
        $total = 0;
        $ip = getIP();
        $select_query = "SELECT * FROM cart WHERE ip = '$ip'";
        $result_query = mysqli_query($conn, $select_query);

        while ($row = mysqli_fetch_array($result_query)) {
            $product_id = $row['id'];
            $quantity = $row['quantity'];

            $select_product = "SELECT * FROM products WHERE id = '$product_id'";
            $result_product = mysqli_query($conn, $select_product);

            while ($row_product = mysqli_fetch_array($result_product)) {
                $product_price = $row_product['price'];
                $total += $product_price * $quantity;
            }
        }

        // Refresh the page to reflect changes
        echo "<script>window.location.href='cart.php';</script>";
    } else {
        echo "<script>alert('Failed to delete item.');</script>";
    }

    mysqli_stmt_close($stmt);
}


}

// Display cart and total price
display_cart();
update_quantity();

?>

<div class="d-flex text-center">
    <a class="container mx-8" href="index.php">
        <button>Continue Shopping</button>
    </a>
    <a class="container" href="users/checkout.php">
        <button>Checkout</button>
    </a>
</div>

<?php include './inc/footer.php'; ?>
