<?php

// Step 1: Check if delete_product is set
if (isset($_GET['delete_product'])) {
  $delete_product = $_GET['delete_product'];

  // Step 2: Retrieve the product image filename from the database
  $query = "SELECT product_img FROM products WHERE id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('i', $delete_product);
  $stmt->execute();
  $result = $stmt->get_result();
  $product = $result->fetch_assoc();

  // Step 3: Check if the product exists and delete the image file
  if ($product && file_exists('../uploads/' . $product['product_img'])) {
    // Delete the image file from the storage
    unlink('../uploads/' . $product['product_img']);

    // Step 4: Delete the product record from the database
    $deleteProductQuery = "DELETE FROM products WHERE id = ?";
    $deleteProductStmt = $conn->prepare($deleteProductQuery);
    $deleteProductStmt->bind_param('i', $delete_product);

    if ($deleteProductStmt->execute()) {
      echo "<script>alert('Product deleted successfully');</script>";
      echo "<script>window.open('home.php','_self');</script>";
    }
  } else {
    echo "<script>alert('Product not found or image does not exist');</script>";
  }
}
?>