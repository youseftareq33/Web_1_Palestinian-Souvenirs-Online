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

$product = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = [];

    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];

    if(!empty($product_id)){
        $error_message='';
        $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id=:product_id");
        $stmt->bindValue(':product_id', $product_id);
        $stmt->execute();
        $product = $stmt->fetchAll();
    }
    elseif (!empty($product_name)) {
        $error_message='';
        $stmt = $pdo->prepare("SELECT * FROM product WHERE product_name LIKE :product_name");
        $stmt->bindValue(':product_name', "%$product_name%");
        $stmt->execute();
        $product = $stmt->fetchAll();
    } 
    else{
        $error_message='Product not found !!!';
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

        <label>Search by:</label>
        <form action="employee_update_product.php" method="post">
            <p>
                <label>Product ID: </label>
                <input type="text" name="product_id" >
            </p>
            <p>
                <label>Product Name: </label>
                <input type="text" name="product_name" >
            </p>
            
            <?php
                if ($error_message) {
                    echo '<span class="red-text">'.$error_message.' </span>';
                }
            ?>
            <br><br>
            <input type="submit" name="button_search" value="Search">
        </form>
        <hr>
            
            <table border="1">
                <caption>Product Table</caption>
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Quantity</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    foreach ($product as $product) {
                        echo "<tr>";
                        echo "<td><a href='employee_update_product2.php?product_id={$product['product_id']}'>{$product['product_id']}</a></td>";
                        echo "<td>{$product['product_name']}</td>";
                        echo "<td>{$product['product_quantity']}</td>";
                        echo "</tr>";
                    }
                ?>
                </tbody>

            </table>
        </main>
        
        

        <footer>
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved. </p>
        </footer>

    </body>

</html>    