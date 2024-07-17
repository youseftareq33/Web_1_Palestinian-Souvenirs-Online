<?php
session_start();

require 'dbconfig.in.php';

$error_message='';
$employee_id;
if (isset($_SESSION['employee_id'])) {
    $employee_id=$_SESSION['employee_id'];
}
else{

    header('Location: login.php');
    exit();
}

$order_id = $_GET['order_id'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $order_status = $_POST['order_status'];
    

    if(!empty($order_status)){
        $error_message='';
        $stmt = $pdo->prepare("UPDATE orders SET order_status = :order_status  WHERE order_id = :order_id");
        $stmt->bindValue(':order_status', $order_status);
        $stmt->bindValue(':order_id', $order_id);
        $stmt->execute();

        header('Location: employee_product_order.php');
        exit();
    }
    else{
        $error_message='Fill Data !!!';
    }


}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Update Order Status Page</title>
        <link rel="stylesheet"  href="main.css">
    </head>
    <body> 
        <header class="header3">
            
            <a href='employee_home.php'><img src='images/icons/logo.jpg' width='150' height='80'></a>
            <br>
            <div>
                <label>Palestinian Souvenirs Online</label>
            </div>
            
            
            <span class='btn_logout'><a href='logout.php'><strong>Logout</strong></a></span>
            
        </header>

        <nav class="nav2">
            
            <div class="div2">
                <a href='employee_add_product.php'><img src='images/icons/add_product.png' width='40' height='40'></a>
                <label class="label1">Add new Product</label>
            </div>

            <br>
            <hr>
            <div class="div2">
                <a href='employee_update_product.php'><img src='images/icons/update.png' width='40' height='40'></a>
                <label class="label1">Update Product Quantity</label>
            </div>

            <br>
            <hr>
            <div class="div2">
                <a href='employee_product_order.php'><img src='images/icons/order_checked.png' width='40' height='40'></a>
                <label class="label1">View Order</label>
            </div>

            <br>
            <hr>
        </nav>
        
        <main>

        <label>Update Order Status:</label>
        <form action="employee_product_order2.php?order_id=<?php echo $order_id; ?>" method="post">
            <select name="order_status" required>
                <option value="Waiting for processing">Waiting for processing</option>
                <option value="Shipping">Shipping</option>
            </select>

            <?php
                if ($error_message) {
                    echo '<span class="red-text">'.$error_message.' </span>';
                }
            ?>
            
            <br><br>
            <input type="submit" name="button_update" value="Update">
        </form>
        
        </main>
        
        

        <footer>
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved. </p>
        </footer>

    </body>

</html>    