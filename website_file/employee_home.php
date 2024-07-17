<?php
session_start();

require 'dbconfig.in.php';


$employee_id;
if (isset($_SESSION['employee_id'])) {
    $employee_id=$_SESSION['employee_id'];
}
else{

    header('Location: login.php');
    exit();
}




?>


<!DOCTYPE html>
<html>
    <head>
        <title>Employee Home Page</title>
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
                <a href='employee_product_order.php'><img src='images/icons/order.png' width='40' height='40'></a>
                <label class="label1">View Order</label>
            </div>

            <br>
            <hr>
        </nav>
        
        <main class="main4">
            <table border="1">
                <caption>Product Table</caption>
                <thead>
                    <tr>
                        <th>Product Image</th>
                        <th>Product ID</th>
                        <th>Product Name</th>
                        <th>Product Brief Description</th>
                        <th>Product Category</th>
                        <th>Product Price</th>
                        <th>Product Size</th>
                        <th>Product Quantity</th>
                        <th>Product Remarks</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                        $stmt= $pdo->query("SELECT * FROM product");
                        $product= $stmt->fetchAll();

                        foreach ($product as $product) {
                            echo "<tr>";
                            echo "<td><img src='images/product_image/{$product['product_image']}' width='100' height='100'></td>";
                            echo "<td>{$product['product_id']}</td>";
                            echo "<td>{$product['product_name']}</td>";
                            echo "<td>{$product['product_description']}</td>";
                            echo "<td>{$product['product_category']}</td>";
                            echo "<td>{$product['product_price']}</td>";
                            echo "<td>{$product['product_size']}</td>";
                            echo "<td>{$product['product_quantity']}</td>";
                            echo "<td>{$product['product_remarks']}</td>";
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