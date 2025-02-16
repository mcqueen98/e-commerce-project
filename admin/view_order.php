<div class="mb-3">
                <input type="text" id="search" class="form-inline mx-3 my-2 my-lg-0" placeholder="Search by orderid" />
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search');
        const usersTable = document.getElementById('users-table');
        const rows = usersTable.querySelectorAll('tr');

        searchInput.addEventListener('keyup', function () {
            const query = searchInput.value.toLowerCase().trim(); // Trim the input and convert to lowercase

            rows.forEach(row => {
                const orderIdCell = row.querySelector('td:nth-child(2)'); // Select the Order ID cell
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
    <h2>order Table</h2>
     
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th class="order">orderid</th>
                <th>USER id</th>
                
                <th>cart id</th>
                <th>quantity</th>
                <th>status</th>
                <th>amount per product</th>
              
            </tr>
        </thead>
        <tbody id="users-table">
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
                $quantity = $row_order['total_pro'];
                echo "
                <tr>
                  
                <td>$num</td>
                  <td>$orderid</td>
                <td>$user_id</td>
                <td>$cart_id</td>
                  <td>$quantity</td>
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
