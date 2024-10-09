<?php
// Include your database connection
include('../inc/dbconnection.php');
// Handle form submission
if (isset($_POST['add_product'])) {
    $product_title = $_POST['product_title'];
    $product_des = $_POST['product_des'];
    $category_id = $_POST['category'];
    $brand_id = $_POST['brand'];
    $price = $_POST['price'];

    // Handle image upload
    $image = $_FILES['product_img']['name'];
    $image_tmp = $_FILES['product_img']['tmp_name'];

    // Extract the file extension
    $ext = pathinfo($image, PATHINFO_EXTENSION);

    // Generate a unique name using the built-in uniqid() function
    $uniqueName = uniqid() . '.' . $ext;
    $image_folder = '../uploads/' . $uniqueName;

    // Move the uploaded file to the specified folder
    if (move_uploaded_file($image_tmp, $image_folder)) {
        // Insert product data into the database using $uniqueName
        $insert_product = "INSERT INTO products (product_title, product_des, category_id, brand_id, product_img, price) 
                           VALUES ('$product_title', '$product_des', '$category_id', '$brand_id', '$uniqueName', '$price')";

        $result = mysqli_query($conn, $insert_product);

        if ($result) {
            echo "<script>alert('Product added successfully');</script>";
            echo "<script>window.open('home.php?view_product','_self');</script>";
        } else {
            echo "Failed to add product: " . mysqli_error($conn);
        }
    } else {
        echo "Failed to upload image.";
    }
}

?>
<div class="container">
    <!-- HTML Form -->
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Product Title:</label>
            <input type="text" class="form-control" id="title" name="product_title" required>
        </div>

        <div class="form-group">
            <label for="description">Product Description:</label>
            <textarea class="form-control" id="description" name="product_des" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="description">Product price:</label>
            <input type="text" class="form-control" id="price" name="price" rows="4" required>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select class="form-control" id="category" name="category" required>
                <option value="">Select Category</option>
                <?php
                // Fetch categories from the database
                $select_category = "SELECT * FROM category";
                $result_category = mysqli_query($conn, $select_category);
                while ($row_category = mysqli_fetch_assoc($result_category)) {
                    echo "<option value='" . $row_category['catid'] . "'>" . $row_category['title'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="brand">Brand:</label>
            <select class="form-control" id="brand" name="brand" required>
                <option value="">Select Brand</option>
                <?php
                // Fetch brands from the database
                $select_brand = "SELECT * FROM brand";
                $result_brand = mysqli_query($conn, $select_brand);
                while ($row_brand = mysqli_fetch_assoc($result_brand)) {
                    echo "<option value='" . $row_brand['brandid'] . "'>" . $row_brand['brandname'] . "</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Product Image:</label>
            <input type="file" class="form-control-file" id="image" name="product_img" required>
        </div>

        <button type="submit" class="btn btn-primary" name=add_product>Submit</button>
    </form>
</div>