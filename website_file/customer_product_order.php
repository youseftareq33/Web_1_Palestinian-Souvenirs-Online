<?php
session_start();

require 'dbconfig.in.php';

$customer_id;
if (isset($_SESSION['customer_id'])) {
    $customer_id=$_SESSION['customer_id'];
}
else{
    header('Location: login.php');
    exit();
}



?>


<!DOCTYPE html>
<html>
    <head>
        <title>Customer Order Page</title>
        <link rel="stylesheet"  href="main.css">
    </head>
    <body> 
        <header class="header3">
            
            <a href='customer_home.php'><img src='images/icons/logo.jpg' width='150' height='80'></a>
            <br>
            <div>
                <label>Palestinian Souvenirs Online</label>
            </div>

            <span class='btn_logout'><a href='logout.php'><strong>Logout</strong></a></span>
            
        </header>
        
        <nav class="nav2">
            <div class="div2">
                <a href='customer_search.php'><img src='images/icons/search.png' width='40' height='40'></a>
                <label class="label1">Search Product</label>
            </div>
            <hr>
            <div class="div2">
                <a href='customer_product_order.php'><img src='images/icons/basket_checked.png' width='40' height='40'></a>
                <label class="label1">Basket</label>
            </div>
            <hr>
        </nav>

        <main>

        <h1>My Order:</h1>
            
            <table border="1">
                <caption>Order Table</caption>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Order Date</th>
                        <th>Order Total Amount</th>
                        <th>Order Status</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    $stmt = $pdo->prepare("SELECT * FROM orders WHERE customer_id = :customer_id");
                    $stmt->bindValue(':customer_id', $customer_id);
                    $stmt->execute();
                    $orders = $stmt->fetchAll();

                    foreach ($orders as $orders) {
                        echo "<tr>";
                        echo "<td>{$orders['order_id']}</td>";
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
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved.</p>
        </footer>

    </body>

</html>    