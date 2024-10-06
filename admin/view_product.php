
<div class="container">
    <h2>Product Table</h2>
    <button onclick="window.location.href='sort.php'">Sort by Sold Items</button>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Image</th>
                <th>Price</th>
                <th>sold</th>
              <th>edit</th>
              <th>delete</th>
            </tr>
        </thead>
        <tbody>
        <?php
     global $conn;    
      $get_product = "SELECT * FROM `products`";
      $result_product = mysqli_query($conn, $get_product);
      $count_product = mysqli_num_rows($result_product);
      $number = 0;
    while ($row_product = mysqli_fetch_array($result_product)) {
        $product_id = $row_product['id'];
        $product_title = $row_product['product_title'];
        $product_img = $row_product['product_img'];
        $product_price = $row_product['price']; 
        // echo $product_id; checking product id
       $number++;
       echo"  <tr>
                <td>$number</td>
                <td>$product_title  </td>
                <td> <img src='../uploads/$product_img' width='100px' height='100px'></td>
                <td>$product_price</td>
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

