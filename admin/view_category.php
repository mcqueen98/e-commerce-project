<div class="container">
    <h2>category Table</h2>
     
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
             
              <th>edit</th>
              <th>delete</th>
            </tr>
        </thead>
        <tbody>
     <?php
     global $conn;
     $get_category = "SELECT * FROM `category`";
     $result_category = mysqli_query($conn, $get_category);
     $count_category = mysqli_num_rows($result_category);
     $number = 0;
     while ($row_category = mysqli_fetch_array($result_category)) {
      $category_id = $row_category['catid'];
        $category_title = $row_category['title'];
        $number++;
        ?>
        <tr>
            <td><?php echo $number; ?></td>
            <td><?php echo $category_title; ?></td>
            <td><a href="index.php?edit_category=<?php echo $category_id; ?>">edit</a></td>
            <td><a href="index.php?delete_category=<?php echo $category_id; ?>">delete</a></td>
        </tr>
        <?php
     }
     ?>
         
        
        
        </tbody>
    </table>
</div>
