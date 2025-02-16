<?php
require_once '../function/function.php';
secure();


        $username = $_SESSION['user_username'];
        
        // Fetch user information
        $get_user = "SELECT * FROM user WHERE user_name = '$username'";
        $query = mysqli_query($conn, $get_user);
        $row = mysqli_fetch_assoc($query);
        $user_id = $row['user_id'];
        ?>
          <div class="card">
          <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>order_id</th>
                    <th>quantity</th>
                    <th>Price per product</th>
                    <th>Status</th>
                    <th>Operation</th>
                  
                </tr>
            </thead>
            <tbody>
                <?php 


                $get_orders = "SELECT * FROM orders WHERE user_id = '$user_id'";
                $order_query = mysqli_query($conn, $get_orders);
                // Loop through orders and display them
                $num = 1;
                while ($order = mysqli_fetch_assoc($order_query)) {
                      $product_id = $order['product_id'];
                   $order_id = $order['id'];
                    $quantity = $order['total_pro'];
                    $amount = $order['amount'];
                    $status = $order['status'];
                    $cart_id = $order['cart_id'];
                    echo "
                    <tr>
                    <td>{$num}</td>
                      <td>{$order_id}</td>
                      <td> {$quantity}</td>
                        <td>Rs {$amount}</td>
                        <td>{$status}</td>";
                    
                    if ($status == 'completed') {
                        echo "<td>paid</td>";
                    } else {
                        echo "<td><a href='confirm.php?my_order={$order_id}'>Confirm</a></td>";
                    }
                    echo "</tr>";
                    $num++;
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
