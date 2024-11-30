<div class="container">
    <h2>Order Table</h2>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Order ID</th>
                <th>Status</th>
                <th>Amount</th>
                <th>$contact</th>
                <th>$address</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include database connection
            global $conn;

            // Check if the form is submitted and handle status update
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['order_id']) && isset($_POST['status'])) {
                $order_id = $_POST['order_id'];
                $new_status = $_POST['status'];
                
                // Update the status in the database
                $update_sql = "UPDATE orders SET status = ? WHERE id = ?";
                $stmt = $conn->prepare($update_sql);
                $stmt->bind_param("si", $new_status, $order_id);
                
                if ($stmt->execute()) {
                    echo "<div class='alert alert-success'>Status updated successfully!</div>";
                } else {
                    echo "<div class='alert alert-danger'>Error updating status.</div>";
                }
            }

            // Fetch orders with contact and address
            $sql = "SELECT 
                        payment.contact, 
                        payment.address,
                        orders.id,
                        orders.user_id,
                        orders.status,
                        orders.amount
                    FROM 
                        payment 
                    INNER JOIN 
                        orders 
                    ON 
                        payment.o_id = orders.id";

            $result_order = mysqli_query($conn, $sql);
            $num = 1;

            while ($row_order = mysqli_fetch_array($result_order)) {
                $order_id = $row_order['id'];
                $user_id = $row_order['user_id'];
                $status = $row_order['status'];
                $amount = $row_order['amount'];
                $contact = $row_order['contact'];
                $address = $row_order['address'];
                echo "
                <tr>
                    <td>$num</td>
                    <td>$user_id</td>
                    <td>$order_id</td>
                    <td>
                        <form method='POST'>
                            <input type='hidden' name='order_id' value='$order_id'>
                            <select name='status'>
                                <option value='Pending' " . ($status == 'Pending' ? 'selected' : '') . ">Pending</option>
                                <option value='completed' " . ($status == 'completed' ? 'selected' : '') . ">completed</option>
                            </select>
                            <button type='submit' class='btn btn-primary'>Update</button>
                        </form>
                    </td>
                    <td>$amount</td>
                    <td>$contact</td>
                    <td>$address</td>
                </tr>
                ";
                $num++;
            }
            ?>
        </tbody>
    </table>
    </div>
</div>

   <?php
// global $conn;

//  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
//     $order_id = $_POST['order_id'];
//     $new_status = $_POST['status'];

//     // Update the status in the database
//     $update_query = "UPDATE `pending` SET `status` = '$new_status' WHERE `pro_id` = '$order_id'";
    
//     if (mysqli_query($conn, $update_query)) {
//         echo "Status updated successfully.";
//     } else {
//         echo "Error updating status: " . mysqli_error($conn);
//     }
    
//    echo "<script>window.open('home.php?verify','_self')</script>";
//     exit();
//  }
?>

