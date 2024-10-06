<?php
session_start();
include('../inc/dbconnection.php');
include('../function/function.php');
secure();

if(isset($_GET['my_order'])){
    $order_id = $_GET['my_order'];
    $get_order_detail = "SELECT * FROM orders WHERE id = '$order_id'";
    $run_order = mysqli_query($conn, $get_order_detail);
    $row_order = mysqli_fetch_array($run_order);
    
    $amount = $row_order['amount'];
}

if(isset($_POST['submit'])){
    $order_id = $_POST['order_id'];
    $amount = $_POST['amount'];
    $mode = $_POST['mode'];
   
    $insert_order = "INSERT INTO payment (o_id, amount, mode) VALUES ('$order_id', '$amount', '$mode')";
    $run_order = mysqli_query($conn, $insert_order);
    if($run_order){
        echo "<script>alert('Payment Successfully Done')</script>";
        echo "<script>window.open('profile.php','_self')</script>";
    }
    
    $update_order = "UPDATE orders SET status = 'completed' WHERE id = '$order_id'";
    $run_update = mysqli_query($conn, $update_order);

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Order Form</h2>
        <form method="POST" action="">
            <div class="form-group">
                <label for="orderId">Order ID</label>
                <input type="text" class="form-control" id="orderId" name="order_id" placeholder="Enter Order ID" value="<?php echo $order_id; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" class="form-control" id="amount" name="amount" placeholder="Enter Amount" value="<?php echo $amount; ?>" readonly>
            </div>
            <div class="form-group">
                <label for="paymentOption">Payment Option</label>
                <select class="form-control" id="paymentOption" name="mode">
                    <option value="">Select Payment Option</option>
                    <option value="credit_card">Credit Card</option>
                   
                    <option value="bank_transfer">cash on delivery</option>
                </select>
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>