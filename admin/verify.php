<div class="container">
    <h2>Order Table</h2>
     
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Amount</th>
                
            </tr>
        </thead>
        <tbody>
            <?php
            global $conn;
            $get_order = "SELECT * FROM `pending`";
            $result_order = mysqli_query($conn, $get_order);
            $num = 1;

            while ($row_order = mysqli_fetch_array($result_order)) {
                $order_id = $row_order['pro_id'];
                $user_id = $row_order['user_id'];
                $status = $row_order['status'];
                $amount = $row_order['amount'];
                
                echo "
                <tr>
                    <td>$num</td>
                    <td>$user_id</td>
                    <td>$order_id</td>
                    <td>
                        <form method='POST' >
                            <input type='hidden' name='order_id' value='$order_id'>
                            <select name='status'>
                                <option value='Pending' " . ($status == 'Pending' ? 'selected' : '') . ">Pending</option>
                                <option value='Paid' " . ($status == 'Paid' ? 'selected' : '') . ">Paid</option>
                            </select>
                            <button type='submit' class='btn btn-primary'>Update</button>
                        </form>
                    </td>
                    <td>$amount</td>
                </tr>
                ";
                $num++;
            }
            ?>
        </tbody>
    </table>
</div>
<?php
global $conn;

 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $order_id = $_POST['order_id'];
    $new_status = $_POST['status'];

    // Update the status in the database
    $update_query = "UPDATE `pending` SET `status` = '$new_status' WHERE `pro_id` = '$order_id'";
    
    if (mysqli_query($conn, $update_query)) {
        echo "Status updated successfully.";
    } else {
        echo "Error updating status: " . mysqli_error($conn);
    }
    
   echo "<script>window.open('home.php?verify','_self')</script>";
    exit();
 }
?>

