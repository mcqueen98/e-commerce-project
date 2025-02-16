<div class="mb-3">
                <input type="text" id="search" class="form-inline mx-3 my-2 my-lg-0" placeholder="Search by orderid" />
</div>

<!-- Vanilla JS for Search tbodyFiltering -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const usersTable = document.getElementById('users-table');
        const rows = usersTable.querySelectorAll('tr');

        searchInput.addEventListener('keyup', function () {
            const query = searchInput.value.toLowerCase().trim(); // Trim the input and convert to lowercase

            rows.forEach(row => {
                const orderIdCell = row.querySelector('td:nth-child(3)'); // Select the Order ID cell
                if (orderIdCell) { // Ensure the cell exists
                    const orderId = orderIdCell.textContent.toLowerCase();
                    if (orderId.includes(query) || query === '') {
                        row.style.display = ''; // Show row
                    } else {
                        row.style.display = 'none'; // Hide row
                    }
                }
            });
        });
    });
</script>



<div class="container">
    <h2>Order Table</h2>
    <div class="table-responsive">
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th class="order">Order ID</th>
                <th>Status</th>
                <th>Quantity</th>
                <th>Amount</th>
                <th>contact</th>
                <th>address</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody id="users-table">
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
                        orders.amount,
                        orders.date,
                        orders.total_pro
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
                $date = $row_order['date'];
                $quantity = $row_order['total_pro'];
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
                    <td>$quantity</td>
                    <td>Rs $amount</td>
                    <td>$contact</td>
                    <td>$address</td>
                    <td>$date</td>
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

