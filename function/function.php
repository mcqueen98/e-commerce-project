<?php 
@session_start();
// include('./inc/dbconnection.php');

function secure() {
    if(!isset($_SESSION['id'])){
      
        header('Location: ../index.php');
        die();
    }
}
function getproduct()
{
    global $conn;
    if (!isset($_GET['category']) && !isset($_GET['brand'])) {

        $select_product = "SELECT * FROM products ORDER BY RAND() LIMIT 0,2";
        $result_query = mysqli_query($conn, $select_product);

        while ($row = mysqli_fetch_assoc($result_query)) {
            // Fetching data from the database
            $product_id = $row['id'];
            $product_title = $row['product_title'];
            $product_des = $row['product_des'];
            $product_price = $row['price'];
            $image = $row['product_img'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];

            // Display product details
            echo "
            <div class='col-md-4 mb-3'>
                <div class='card'>
                    <div class='card-body'>
                        <img src='./uploads/$image' alt='$product_title' class='img-fluid'>
                        <h1>$product_title</h1>
                        <p>$product_des</p>
                        <p>Price: $product_price</p>
            ";

            // Check if the user is logged in
            if (isset($_SESSION['user_username'])) {
                echo "<a href='index.php?add_to_cart=$product_id'>Add to Cart</a>";
            } else {
                echo "<a href='./users/user_login.php' class='btn btn-secondary'>Login to Add to Cart</a>";
            }

            echo "
                    </div>
                </div>
            </div>
            ";
        }
    }
}

function getbrand() 
{
    global $conn;

    // Query to fetch brands
    $select_brands = "SELECT * FROM brand";
    $result_brands = mysqli_query($conn, $select_brands);

    if ($result_brands) {
        while ($row_data = mysqli_fetch_assoc($result_brands)) {
            $brandid = $row_data['brandid']; // Fixed: 'brandid' instead of 'btandid'
            $brandname = $row_data['brandname'];

            echo "<a href='index.php?brand=$brandid' class='list-group-item list-group-item-action'>$brandname</a>";
        }
    } else {
        echo "No brands found.";
    }
}

function get_unique_brand(){
    global $conn;
   
    if(  isset($_GET['brand'])) {
        $brand_id = $_GET['brand'];
        $select_product = "SELECT * FROM products WHERE brand_id = $brand_id ";
        $result_query = mysqli_query($conn, $select_product);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2>No stock for available this brand</h2>";
        }

        while ($row = mysqli_fetch_assoc($result_query)) {
            // Fetching data from the database
            $product_id = $row['id'];
           
            $product_title = $row['product_title'];
            $product_des = $row['product_des'];
             $product_price = $row['price'];
            $image = $row['product_img'];
            $category_id = $row['category_id'];
            $brand_id = $row['brand_id'];

            // Display product details
            echo "
            <div class='col-md-4 mb-3'>
                <div class='card'>
                    <div class='card-body'>
                        <img src='./uploads/$image' alt='$product_title' class='img-fluid'>
                        <h1>$product_title</h1>
                        <p>$product_des</p>
                         <p>Price: $product_price</p>";
                         if (isset($_SESSION['user_username'])) {
                            echo "<a href='index.php?add_to_cart=$product_id'>Add to Cart</a>";
                        } else {
                            echo "<a href='./users/user_login.php' class='btn btn-secondary'>Login to Add to Cart</a>";
                        }
            
                        echo "
                                </div>
                            </div>
                        </div>
                        ";
            
        }
    }
}
function getcategory()
{
    global $conn;

    // Query to fetch categories
    $select_category = "SELECT * FROM category";
    $result_category = mysqli_query($conn, $select_category);

    if ($result_category) {
        while ($row_data = mysqli_fetch_assoc($result_category)) {
            $catid = $row_data['catid'];
            $catname = $row_data['title'];

            echo "<li><a href='index.php?category=$catid' class='dropdown-item'>$catname</a></li>";

        }
    } else {
        echo "<li><a class='dropdown-item'>No categories found.</a></li>";
    }
}

function get_unique_cat()
{
    global $conn;

    if(isset($_GET['category'])) {

        $category_id = $_GET['category'];

        // Fetch products by category
        $select_product = "SELECT * FROM products WHERE category_id = $category_id";
        $result_query = mysqli_query($conn, $select_product);
        $num_of_rows = mysqli_num_rows($result_query);
        if ($num_of_rows == 0) {
            echo "<h2>No stock for this category</h2>";
        }
        

        if(mysqli_num_rows($result_query) > 0) {
            while ($row = mysqli_fetch_assoc($result_query)) {
                // Fetching data from the database
                $product_id = $row['id'];
               
                $product_title = $row['product_title'];
                $product_des = $row['product_des'];
                 $product_price = $row['price'];
                $image = $row['product_img'];

                // Display product details
                echo "
                <div class='col-md-4 mb-3'>
                    <div class='card'>
                        <div class='card-body'>
                            <img src='./uploads/$image' alt='$product_title' class='img-fluid'>
                            <h1>$product_title</h1>
                            <p>$product_des</p>
                             <p>Price: $product_price</p>";
                         if (isset($_SESSION['user_username'])) {
                            echo "<a href='index.php?add_to_cart=$product_id'>Add to Cart</a>";
                        } else {
                            echo "<a href='./users/user_login.php' class='btn btn-secondary'>Login to Add to Cart</a>";
                        }
            
                        echo "
                                </div>
                            </div>
                        </div>
                        ";
                    
                          
            }
        } 
    }
}
function search() {
    global $conn;

    if (isset($_GET['search_data_pro'])) {
        $search_data=$_GET['search_data'];
        // Sanitize input
    
        // Query to search products
        $select_product = "SELECT * FROM products WHERE product_title LIKE '%$search_data%'";
        
        $result_query = mysqli_query($conn, $select_product);


        if (mysqli_num_rows($result_query) > 0) {
            while ($row = mysqli_fetch_assoc($result_query)) {
                // Fetching data from the database
                $product_id = $row['id'];
                
                $product_title = $row['product_title'];
                $product_des = $row['product_des'];
                 $product_price = $row['price'];
                $image = $row['product_img'];
                $product_title = $row['product_title'];
                $product_des = $row['product_des'];
                 $product_price = $row['price'];
                $image = $row['product_img'];

                // Display product details
                echo "
                <div class='col-md-4 mb-3'>
                    <div class='card'>
                        <div class='card-body'>
                            <img src='./uploads/$image' alt='$product_title' class='img-fluid'>
                            <h1>$product_title</h1>
                            <p>$product_des</p>
                             <p>Price: $product_price</p>";
                             if (isset($_SESSION['user_username'])) {
                                echo "<a href='index.php?add_to_cart=$product_id'>Add to Cart</a>";
                            } else {
                                echo "<a href='user_login.php' class='btn btn-secondary'>Login to Add to Cart</a>";
                            }
                
                            echo "
                                    </div>
                                </div>
                            </div>
                            ";
                        }
                    
            
        } else {
            // If no products found
            echo "<h2>No products found for '$search_data'</h2>";
        }
    }
}
function display()

    {
        global $conn;
        if( !isset($_GET['category']) && !isset($_GET['brand'])) {
    
            $select_product = "SELECT * FROM products ORDER BY RAND() ";
            $result_query = mysqli_query($conn, $select_product);
    
            while ($row = mysqli_fetch_assoc($result_query)) {
                // Fetching data from the database
                $product_id = $row['id'];
                $product_title = $row['product_title'];
                $product_des = $row['product_des'];
                 $product_price = $row['price'];
                $product_price = $row['price'];
                $image = $row['product_img'];
                $category_id = $row['category_id'];
                $brand_id = $row['brand_id'];
    
                // Display product details
                echo "
                <div class='col-md-4 mb-3'>
                    <div class='card'>
                        <div class='card-body'>
                            <img src='./uploads/$image' alt='$product_title' class='img-fluid'>
                            <h1>$product_title</h1>
                            <p>$product_des</p>
                             <p>Price: $product_price</p>";
                         if (isset($_SESSION['user_username'])) {
                            echo "<a href='index.php?add_to_cart=$product_id'>Add to Cart</a>";
                        } else {
                            echo "<a href='./users/user_login.php' class='btn btn-secondary'>Login to Add to Cart</a>";
                        }
            
                        echo "
                                </div>
                            </div>
                        </div>
                        ";
            
                           
        }
    }  
}


    // Get the session ID
    function getUniqueIdentifier() {
        $ip = getIP();
    
        // Check if the session username is set and not empty
        if (!empty($_SESSION['user_username'])) {
            $session_id = $_SESSION['user_username'];
        } else {
            $session_id = ''; // Or handle it as needed
        }
    
        return $ip . '_' . $session_id; // This ensures uniqueness
    }
    

function getIP() {
// remove getuniqueidentifier() to add not loggedin cart item
  
    // Check if the IP address is passed through forwarded headers
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP is passed from a shared internet or proxy
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IP is passed from a proxy
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // Default: IP address of the remote user
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    return $ip;
}

// Example usage
// $user_ip = getIP();
// echo "User IP Address: " . $user_ip;

function cart() {
    global $conn;

    if (isset($_GET['add_to_cart'])) {
        // Retrieve the IP and product ID
        $ip =getUniqueIdentifier();
        $get_product_id = mysqli_real_escape_string($conn, $_GET['add_to_cart']);
        
        // Get product title and price
        $product_query = "SELECT product_title, price FROM products WHERE id = '$get_product_id'";
        $product_result = mysqli_query($conn, $product_query);
        $product_data = mysqli_fetch_assoc($product_result);
        $product_title = $product_data['product_title'];
        $product_price = $product_data['price'];

        // Check if the product is already in the cart
        $select_query = "SELECT * FROM cart WHERE ip = '$ip' AND product_id = '$get_product_id'";
        $result_query = mysqli_query($conn, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
        
        if ($num_of_rows > 0) {
            // Item already in cart
            echo '<script>alert("This item is already present in the cart");</script>';
            echo "<script>window.open('index.php', '_self');</script>";
        } else {
            // Insert the item into the cart with title and price
            $insert_query = "INSERT INTO cart (product_id, ip, product_title, product_price, quantity) 
                             VALUES ('$get_product_id', '$ip', '$product_title', '$product_price', 1)";
            $result_query = mysqli_query($conn, $insert_query);
            echo '<script>alert("This item is added in the cart");</script>';
            echo "<script>window.open('index.php', '_self');</script>";
        }
    }
}

function cart_item() {
  
    if (isset($_GET['add_to_cart'])) {
        global $conn;

        // Retrieve the IP and product ID
        $ip =getUniqueIdentifier();
       
        // Check if the product is already in the cart
        $select_query = "SELECT * FROM cart WHERE ip = '$ip' ";
        $result_query = mysqli_query($conn, $select_query);
        $count_cart = mysqli_num_rows($result_query);
    }
        else {
            global $conn;
            $ip =getUniqueIdentifier();
            $select_query = "SELECT * FROM cart WHERE ip = '$ip' ";
            $result_query = mysqli_query($conn, $select_query);
            $count_cart = mysqli_num_rows($result_query);
         }     echo" $count_cart";
}
function total_price(){
    global $conn;
    $ip =getUniqueIdentifier();
    $total = 0;

    // Select products in the cart based on IP
    $select_query = "SELECT * FROM cart WHERE ip = '$ip'";
    $result_query = mysqli_query($conn, $select_query);

    // Iterate over each cart item
    while ($row = mysqli_fetch_array($result_query)) {
        $id = $row['product_id'];

        // Fetch product details from the products table
        $select_product = "SELECT * FROM products WHERE id = '$id'";
        $result_product = mysqli_query($conn, $select_product);

        while ($row_price = mysqli_fetch_array($result_product)) {
            $product_price = $row_price['price'];
            $total += $product_price; // Add each product price to total
        }
    }

    echo "$total";
}

function user_detail(){
    global $conn;   
    $username = $_SESSION['user_username'];

    // Get user details
    $get_user = "SELECT * FROM user WHERE user_name = '$username'";  
    $query_user = mysqli_query($conn, $get_user);
    $row_user = mysqli_fetch_array($query_user);

    if($row_user){
        $user_id = $row_user['user_id'];

        // Check if the profile edit, order view, or delete profile parameters are not set
        if(!isset($_GET['edit_profile']) && !isset($_GET['my_order']) && !isset($_GET['delete_profile'])){

            // Get order details where status is pending
            $get_order_detail = "SELECT * FROM `orders` WHERE user_id = '$user_id' AND status = 'pending'";
            $run_order = mysqli_query($conn, $get_order_detail);
            $row_count = mysqli_num_rows($run_order);

            if($row_count > 0){
                echo "<h2>You have $row_count pending order(s)</h2>";
            } else {
                echo "<h2>You have no pending orders</h2>";
                echo"<a href='../index.php'>Continue Shopping</a>";
            }
        }
    }
}

?>