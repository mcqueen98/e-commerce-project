<?php

include('../inc/dbconnection.php');
include('../function/function.php');
secure();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>payment</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  
</head>
<body>
<?php
$user_ip = getUniqueIdentifier() ;
$get_user = "SELECT * FROM `user` WHERE user_ip='$user_ip'";
$run_user = mysqli_query($conn, $get_user);
$row_user = mysqli_fetch_array($run_user);

$user_id = $row_user['user_id'];
?>


    <h1>payment</h1>
    <h2><a href="order.php?user_id=<?php echo $user_id; ?>"> ( setting order)pay offline</a></h2>



</body>
</html>