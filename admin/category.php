<?php
include('../inc/dbconnection.php'); // Ensure $conn is correctly set up

// Process form submission
if (isset($_POST['insert_cat'])) {
    $category_title = mysqli_real_escape_string($conn, $_POST['cat_title']);
    
    $select_query = "SELECT * FROM `category` WHERE title='$category_title'";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('This category is already present in the database.')</script>";
    } else {
        $insert_query = "INSERT INTO `category` (title) VALUES ('$category_title')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            echo "<script>alert('Category has been inserted successfully.')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "')</script>";
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center mb-4">Submit Your Category</h2>
    <form action="" method="post">
        <div class="form-group">
            <label for="inputField">Name of Category</label>
            <input type="text" class="form-control" id="inputField" name="cat_title" placeholder="Enter category name" required>
        </div>
        <button type="submit" class="btn btn-primary" name="insert_cat">Submit</button>
    </form>
</div>
