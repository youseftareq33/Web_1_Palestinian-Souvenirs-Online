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

$product_id = $_GET['product_id'];

$stmt= $pdo->prepare("SELECT * FROM product Where product_id=:product_id");
$stmt->bindValue(':product_id', $product_id);
$stmt->execute();
$product= $stmt->fetch();

$product_quantity=$product['product_quantity'];


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    

    $newproduct_quantity = $_POST['newproduct_quantity'];
    

    if(!empty($newproduct_quantity)){
        $error_message='';
        $stmt = $pdo->prepare("UPDATE product SET product_quantity = :newproduct_quantity  WHERE product_id = :product_id");
        $stmt->bindValue(':product_id', $product_id);
        $stmt->bindValue(':newproduct_quantity', $newproduct_quantity);
        $stmt->execute();

        header('Location: employee_home.php');
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
        <title>Update quantity Page</title>
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
                <a href='employee_update_product.php'><img src='images/icons/update_checked.png' width='40' height='40'></a>
                <label class="label1">Update Product Quantity</label>
            </div>

            <br>
            <hr>
            <div class="div2">
                <a href='employee_product_order.php'><img src='images/icons/order.png' width='40' height='40'></a>
                <label class="label1">View Order</label>
            </div>

            <br>
            <hr>
        </nav>
        
        <main>

        <label>Update Quantity:</label>
        <form action="employee_update_product2.php?product_id=<?php echo $product_id; ?>" method="post">
            <p>
                <label>Old Quantity: <?php echo $product_quantity ?></label>
            </p>
            <p>
                <label>New Quantity: </label>
                <input type="text" name="newproduct_quantity" >
            </p>

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