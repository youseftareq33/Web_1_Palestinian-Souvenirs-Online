<?php
session_start();

require 'dbconfig.in.php';



?>


<!DOCTYPE html>
<html>
    <head>
        <title>Home Page</title>
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
                <a href='user_search.php'><img src='images/icons/search.png' width='40' height='40'></a>
                <label class="label1">Search Product</label>
            </div>
            <hr>
        </nav>

        <main>
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
                        $stmt= $pdo->query("SELECT * FROM product");
                        $product= $stmt->fetchAll();

                        foreach ($product as $product) {
                            echo "<tr>";
                            echo "<td><img src='images/product_image/{$product['product_image']}' width='100' height='100'></td>";
                            echo "<td>{$product['product_name']}</td>";
                            echo "<td>{$product['product_category']}</td>";
                            echo "<td>{$product['product_price']}</td>";
                            echo "<td>{$product['product_size']}</td>";
                            echo "<td>
                                    <a href='customer_product_view.php?product_id={$product['product_id']}'><button><img src='images/icons/order_now.png' width='50' height='50'></button></a>
                                </td>";
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