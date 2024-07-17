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
        <title>Employee Order Page</title>
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

        <h1>Orders:</h1>
            
            <table border="1">
                <caption>Order Table</caption>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Product ID</th>
                        <th>Customer ID</th>
                        <th>Order Date</th>
                        <th>Order Total Amount</th>
                        <th>Order Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    $stmt = $pdo->prepare("SELECT * FROM orders");
                    $stmt->execute();
                    $orders = $stmt->fetchAll();

                    foreach ($orders as $orders) {
                        echo "<tr>";
                        echo "<td><a href='employee_product_order2.php?order_id={$orders['order_id']}'>{$orders['order_id']}</a></td>";
                        echo "<td>{$orders['product_id']}</td>";
                        echo "<td>{$orders['customer_id']}</td>";
                        echo "<td>{$orders['order_date']}</td>";
                        echo "<td>{$orders['order_total_amount']}</td>";
                        echo "<td>{$orders['order_status']}</td>";
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