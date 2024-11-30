<div class="container">
    <h2>order Table</h2>
     
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>orderid</th>
                <th>USER id</th>
                
                <th>cart id</th>
                <th>status</th>
                <th>amount</th>
              
            </tr>
        </thead>
        <tbody>
            <?php
            global $conn;
            $get_order = "SELECT * FROM `orders`";
            $result_order = mysqli_query($conn, $get_order);
            $num = 1;
            while ($row_order = mysqli_fetch_array($result_order)) {
                $orderid = $row_order['id'];
                $cart_id = $row_order['cart_id'];
                $user_id = $row_order['user_id'];
                $status = $row_order['status'];
                $amount = $row_order['amount'];
                echo "
                <tr>
                  
                <td>$num</td>
                  <td>$orderid</td>
                <td>$user_id</td>
                <td>$cart_id</td>
                 <td>$status</td>
                 <td>$amount</td>
                
              
                </tr>
                ";
                $num++;

            }
            ?>
            </tbody>
    </table>
</div>
