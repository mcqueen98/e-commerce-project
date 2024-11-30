
<div class="table-responsive">
    <h2>Product Table</h2>
    <button onclick="window.location.href='sort.php'">Sort by Sold Items</button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>state</th>
                <th>sold</th>
              
              <th>edit</th>
              <th>delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
     global $conn;    
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id']) && isset($_POST['state'])) {
        $product_id = $_POST['id'];
        $new_state = $_POST['state'];
        
        // Update the state in the database
        $update_sql = "UPDATE products SET states = ? WHERE id = ?";
        $stmt = $conn->prepare($update_sql);
        $stmt->bind_param("si", $new_state, $product_id);
        
        if ($stmt->execute()) {
            echo "<div class='alert alert-success'>State of product updated successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating state.</div>";
        }
    }
    

      $get_product = "SELECT * FROM `products`";
      $result_product = mysqli_query($conn, $get_product);
      $count_product = mysqli_num_rows($result_product);
      $number = 0;
    while ($row_product = mysqli_fetch_array($result_product)) {
        $product_id = $row_product['id'];
        $product_title = $row_product['product_title'];
        $product_img = $row_product['product_img'];
        $product_price = $row_product['price']; 
        $state = $row_product['states'];
        // echo $product_id; checking product id
       $number++;
       echo"  <tr>
                <td>$number</td>
                <td>$product_title  </td>
                <td> <img src='../uploads/$product_img' width='100px' height='100px'></td>
               
                <td>$product_price</td>
              <td>
                 <form method='POST'>
                         <input type='hidden' name='id' value='$product_id'>
                  <select name='state' class='form-control'>
                    <option value='new' " . ($state == 'new' ? 'selected' : '') . ">new</option>
                                <option value='default' " . ($state == 'default' ? 'selected' : '') . ">default</option>
                                 <option value='out' " . ($state == 'out' ? 'selected' : '') . ">out</option>
                             </select>
                    <button type='submit' class='btn btn-primary'>Update</button>
               </form>
          </td>

            ";
            ?>
            <td>
                <?php
                $get_sold = "SELECT * FROM `orders` WHERE product_id = $product_id";
                $result_sold = mysqli_query($conn, $get_sold);
                $count_sold = mysqli_num_rows($result_sold);
                echo $count_sold;
                ?>

               
               </td>   <td><a href='home.php?edit_product=<?php echo $product_id; ?>' class='btn btn-warning'>Edit</a></td>
                <td><a href='home.php?delete_product=<?php echo $product_id; ?>' class='btn btn-danger'>Delete</a></td>
                </tr>
            <?php
    }

        ?>   
       
        </tbody>
    </table>
</div>

