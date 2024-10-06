<?php
include '../inc/dbconnection.php'; // Include your database connection file

// Fetch products and sold count
$get_product = "SELECT * FROM `products`";
$result_product = mysqli_query($conn, $get_product);
$products = [];

while ($row_product = mysqli_fetch_assoc($result_product)) {
    $product_id = $row_product['id'];

    // Fetch sold count for each product
    $get_sold = "SELECT COUNT(*) as sold_count FROM `orders` WHERE product_id = $product_id";
    $result_sold = mysqli_query($conn, $get_sold);
    $row_sold = mysqli_fetch_assoc($result_sold);
    $sold_count = $row_sold['sold_count'];

    // Store product details and sold count in an array
    $row_product['sold_count'] = $sold_count;
    $products[] = $row_product;
}

// Bubble Sort 
for ($i = 0; $i < count($products) - 1; $i++) {
    for ($j = 0; $j < count($products) - $i - 1; $j++) {
        if ($products[$j]['sold_count'] < $products[$j + 1]['sold_count']) {
            // Swap if the current sold_count is less than the next
            $temp = $products[$j];
            $products[$j] = $products[$j + 1];
            $products[$j + 1] = $temp;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sorted Products</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Optional Bootstrap Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap-theme.min.css">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Sorted Product Table</h2>
    <table class="table table-striped">
        <thead >
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>Sold</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
        $number = 0;
        foreach ($products as $product) {
            $number++;
            echo "<tr>
                <td>$number</td>
                <td>{$product['product_title']}</td>
                <td><img src='../uploads/{$product['product_img']}' width='100' height='100' class='img-fluid'></td>
                <td>{$product['price']}</td>
                <td>{$product['sold_count']}</td>
                <td><a href='home.php?edit_product={$product['id']}' class='btn btn-warning'>Edit</a></td>
                <td><a href='home.php?delete_product={$product['id']}' class='btn btn-danger'>Delete</a></td>
            </tr>";
        }
        ?>
        </tbody>
    </table>
    <div class="text-center">
        <a href="home.php" class="btn btn-primary">Back to Home</a>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
