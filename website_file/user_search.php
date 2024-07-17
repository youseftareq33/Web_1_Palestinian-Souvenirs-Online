<?php
session_start();

require 'dbconfig.in.php';

$error_message='';
$product = [];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product = [];
    $product_name = $_POST['product_name'];
    $product_min_price = $_POST['product_min_price'];
    $product_max_price = $_POST['product_max_price'];

    if (!empty($product_name)) {
        $error_message='';
        $stmt = $pdo->prepare("SELECT * FROM product WHERE product_name LIKE :product_name");
        $stmt->bindValue(':product_name', "%$product_name%");
        $stmt->execute();
        $product = $stmt->fetchAll();
    } elseif (!empty($product_min_price) && !empty($product_max_price)) {
        $error_message='';
        $stmt = $pdo->prepare("SELECT * FROM product WHERE product_price BETWEEN :product_min_price AND :product_max_price");
        $stmt->bindValue(':product_min_price', $product_min_price);
        $stmt->bindValue(':product_max_price', $product_max_price);
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
        <title>Search Page</title>
        <link rel="stylesheet"  href="main.css">
    </head>
    <body> 
        <header class="header3">
            
            <a href='home.php'><img src='images/icons/logo.jpg' width='150' height='80'></a>
            <br>
            <div>
                <label>Palestinian Souvenirs Online</label>
            </div>

            <span class='btn_reg'><a href='register_step1.php'><strong>Register</strong></a></span>
            <span class='btn_login'><a href='login.php'><strong>Login</strong></a></span>
            <span class='btn_contact'><a href='contact_us.php'><strong>Contact Us</strong></a></span> 
            
        </header>
        
        <nav class="nav2">
            <div class="div2">
                <a href='user_search.php'><img src='images/icons/search_checked.png' width='40' height='40'></a>
                <label class="label1">Search Product</label>
            </div>
            <hr>
        </nav>

        <main>

        <label>Search by:</label>
        <form action="user_search.php" method="post">
            <p>
                <label>Product Name: </label>
                <input type="text" name="product_name" >
            </p>
            <p>
                <label>Product Price: </label>
                <br><br>
                <label>Minimum Price: </label>
                <input type="number" name="product_min_price" >
                <label>Maximum Price: </label>
                <input type="number" name="product_max_price" >
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
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Category</th>
                        <th>Product Price</th>
                        <th>Product Size</th>
                        <th>Order it</th>
                    </tr>
                </thead>

                <tbody>
                <?php
                    foreach ($product as $product) {
                        echo "<tr>";
                        echo "<td><img src='images/product_image/{$product['product_image']}' width='100' height='100'></td>";
                        echo "<td>{$product['product_name']}</td>";
                        echo "<td>{$product['product_category']}</td>";
                        echo "<td>{$product['product_price']}</td>";
                        echo "<td>{$product['product_size']}</td>";
                        echo "<td><a href='customer_product_view.php?product_id={$product['product_id']}'><button><img src='images/icons/order_now.png' width='50' height='50'></button></a></td>";
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