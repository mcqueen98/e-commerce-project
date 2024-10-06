<?php
include('../inc/dbconnection.php'); // Ensure $conn is correctly set up

// Process form submission
if (isset($_POST['insert_brand'])) {
    $brand_title = mysqli_real_escape_string($conn, $_POST['brand_title']);
    
    $select_query = "SELECT * FROM `brand` WHERE brandname='$brand_title'";
    $result_select = mysqli_query($conn, $select_query);
    $number = mysqli_num_rows($result_select);

    if ($number > 0) {
        echo "<script>alert('This brand is already present in the database.')</script>";
    } else {
        $insert_query = "INSERT INTO `brand` (brandname) VALUES ('$brand_title')";
        $result = mysqli_query($conn, $insert_query);

        if ($result) {
            echo "<script>alert('brand has been inserted successfully.')</script>";
        } else {
            echo "<script>alert('Error: " . mysqli_error($conn) . "')</script>";
        }
    }
}
?>


<div class="container mt-5">
        <h2 class="text-center mb-4">Submit Your brand</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="inputField">name of brand</label>
                <input type="text" class="form-control" id="inputField" name="brand_title" placeholder="Enter something" required>
            </div>
            <button type="submit" class="btn btn-primary" name="insert_brand">Submit</button>
    </form>
    </div>