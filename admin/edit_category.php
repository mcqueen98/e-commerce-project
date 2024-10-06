<div class="container">
<form action="" method="post">
    <div class="form-group">
        <label for="category_title">category title</label>
        <input type="text" class="form-control" id="category_title" name="category_title" required>
    </div>
   <input type="submit" name="edit_cat" value="submit">
</form>
</div>
<?php

if (isset($_GET ['edit_category'])) {
    $category_id = $_GET['edit_category'];
    $update_category = "select * from category where catid='$category_id'";
    $run_category = mysqli_query($conn, $update_category);
    if(isset($_POST['edit_cat'])){
        $category_title = $_POST['category_title'];
        $update_category = "UPDATE `category` SET `title`='$category_title' WHERE `catid`='$category_id'";
        $run_category = mysqli_query($conn, $update_category);
        if($run_category){
            echo "<script>alert('category updated successfully');</script>";
            echo "<script>window.open('home.php','_self');</script>";
        }
    }
}
?>