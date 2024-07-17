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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_name = $_POST['product_name'];
    $product_description = $_POST['product_description'];
    $product_category = $_POST['product_category'];
    $product_price = $_POST['product_price'];
    $product_size = $_POST['product_size'];
    $product_quantity = $_POST['product_quantity'];
    $product_remarks = $_POST['product_remarks'];
    $product_image = $_FILES['image_name'];


    $stmt = $pdo->prepare("SELECT * FROM product ORDER BY product_id DESC LIMIT 1");
    $stmt->execute();
    $hasProduct = $stmt->fetch();

    
    if ($hasProduct) {
        $product_id = $hasProduct['product_id']+1;

        move_uploaded_file($product_image['tmp_name'], "images/product_image/"."item".$product_id."img1.gif");
        $product_image = "item".$product_id."img1.gif";

        $stmt = $pdo->prepare("INSERT INTO product (product_name, product_description, product_category, product_price, product_size, product_quantity, product_remarks, product_image) VALUES (:product_name, :product_description, :product_category, :product_price, :product_size, :product_quantity, :product_remarks, :product_image)");
    } else {
        $product_id = 1000000000;

       move_uploaded_file($product_image['tmp_name'], "images/product_image/"."item".$product_id."img1.gif");

        $product_image = "item".$product_id."img1.gif";
        
        $stmt = $pdo->prepare("INSERT INTO product (product_id, product_name, product_description, product_category, product_price, product_size, product_quantity, product_remarks, product_image) VALUES (:product_id, :product_name, :product_description, :product_category, :product_price, :product_size, :product_quantity, :product_remarks, :product_image)");
        $stmt->bindValue(':product_id', $product_id);
    }

    $stmt->bindValue(':product_name', $product_name);
    $stmt->bindValue(':product_description', $product_description);
    $stmt->bindValue(':product_category', $product_category);
    $stmt->bindValue(':product_price', $product_price);
    $stmt->bindValue(':product_size', $product_size);
    $stmt->bindValue(':product_quantity', $product_quantity);
    $stmt->bindValue(':product_remarks', $product_remarks);
    $stmt->bindValue(':product_image', $product_image);
    $stmt->execute();

    header('Location: employee_home.php');
    exit();
    }




    
    

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Add new Product</title>
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
                <a href='employee_add_product.php'><img src='images/icons/add_product_checked.png' width='40' height='40'></a>
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

        <main>
            <h2>Fill Product Details:</h2>
            <form action="employee_add_product.php" method="post" enctype="multipart/form-data">
                <p>
                    <label>Product Name: </label>
                    <input type="text" name="product_name" required>
                </p>

                <p>
                    <label>Product Brief Description: </label>
                    <input type="text" name="product_description" required>
                </p>

                <p>
                    <label>Product Category: </label>
                    <select name="product_category" required>
                        <option value="New Arrival">New Arrival</option>
                        <option value="On Sale">On Sale</option>
                        <option value="Featured">Featured</option>
                        <option value="High Demand">High Demand</option>
                        <option value="Normal" selected>Normal</option>
                        
                    </select>
                </p>

                <p>
                    <label>Product Price: </label>
                    <input type="number" name="product_price" required>
                </p>

                <p>
                    <label>Product Size: </label>
                    <input type="number" name="product_size" required>
                </p>

                <p>
                    <label>Product Quantity: </label>
                    <input type="number" name="product_quantity" required>
                </p>

                <p>
                    <label>Product Remarks: </label>
                    <input type="text" name="product_remarks" required>
                </p>

                <p>
                    <label>Product Image: </label>
                    <input type="file" name="image_name" required>
                </p>
              

                <input type="submit" name="button_add_product" value="Add Product">
                
            </form>
            
        </main>

        <footer>
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved. </p>
        </footer>
    </body>

</html>    