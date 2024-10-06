<?php
 if(isset($_GET['edit_product'])){
  $edit = $_GET['edit_product'];
  $get_product = "SELECT * FROM `products` WHERE id = $edit";
  $result_product = mysqli_query($conn, $get_product);
  $row_product = mysqli_fetch_assoc($result_product);
  $product_title = $row_product['product_title'];
  $product_description = $row_product['product_des'];
  $product_image = $row_product['product_img'];
  $product_price = $row_product['price'];
  $product_brand = $row_product['brand_id'];
  $product_category = $row_product['category_id'];

  //select brand
  $get_brand = "SELECT * FROM `brand` where brandid = $product_brand";
  $result_brand = mysqli_query($conn, $get_brand);
  $row_brand = mysqli_fetch_assoc($result_brand);
  $brand_title = $row_brand['brandname'];
  
  //select category
  $get_category = "SELECT * FROM `category` where catid = $product_category";
  $result_category = mysqli_query($conn, $get_category);
  $row_category = mysqli_fetch_assoc($result_category);
  $category_title = $row_category['title'];
 }
?>

<div class="container">
    <h2>Update Product</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" class="form-control" id="title" name="title" required value="<?php echo htmlspecialchars($product_title); ?>">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" class="form-control" id="description" name="description" required value="<?php echo htmlspecialchars($product_description); ?>">
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" class="form-control-file" id="image" name="image" required>
            <img src="../uploads/<?php echo htmlspecialchars($product_image); ?>" alt="" style="width: 100px; height: 100px;">
        </div>
        <div class="form-group">
            <label for="brand">Brand:</label>
            <select name="brand" id="brand" required>
                <option value="<?php echo $product_brand; ?>"><?php echo htmlspecialchars($brand_title); ?></option>
                <?php
                $get_brand = "SELECT * FROM `brand`";
                $result_brand = mysqli_query($conn, $get_brand);
                while ($row_brand = mysqli_fetch_assoc($result_brand)) {
                    echo "<option value='{$row_brand['brandid']}'>" . htmlspecialchars($row_brand['brandname']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="category">Category:</label>
            <select name="category" id="category" required>
                <option value="<?php echo $product_category; ?>"><?php echo htmlspecialchars($category_title); ?></option>
                <?php
                $get_category = "SELECT * FROM `category`";
                $result_category = mysqli_query($conn, $get_category);
                while ($row_category = mysqli_fetch_assoc($result_category)) {
                    echo "<option value='{$row_category['catid']}'>" . htmlspecialchars($row_category['title']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" class="form-control" id="price" name="price" step="0.01" required value="<?php echo htmlspecialchars($product_price); ?>">
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

<?php
if(isset($_POST['submit'])){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $brand = $_POST['brand'];
    $category = $_POST['category'];
    $price = $_POST['price'];   
    $image = $_FILES['image']['name'];
    $image_tmp = $_FILES['image']['tmp_name'];

    if(!empty($image)) {
        $upload_success = move_uploaded_file($image_tmp, "../uploads/$image");
    } else {
        $image = $product_image; // If no new image is uploaded, keep the old one
    }

    $update_product = "UPDATE `products` SET product_title = '$title', product_des = '$description', product_img = '$image', price = '$price', brand_id = '$brand', category_id = '$category' WHERE id = $edit";
    $result_update = mysqli_query($conn, $update_product);
    if ($result_update) {
        echo "<script>alert('Product updated successfully');</script>";
        echo "<script>window.open('home.php','_self');</script>";
    }
}
?>
