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


$error_message='';

$product_id = $_GET['product_id'];

$stmt= $pdo->prepare("SELECT * FROM product Where product_id=:product_id");
$stmt->bindValue(':product_id', $product_id);
$stmt->execute();
$product= $stmt->fetch();

$product_id=$product['product_id'];
$product_name=$product['product_name'];
$product_description=$product['product_description'];
$product_category=$product['product_category'];
$product_price=$product['product_price'];
$product_size=$product['product_size'];
$product_quantity=$product['product_quantity'];
$product_remarks=$product['product_remarks'];
$product_image=$product['product_image'];



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $product_quantity_buy=$_POST['product_buy'];

    $stmt=$pdo->prepare("SELECT product_quantity FROM product WHERE product_id = :product_id");
    $stmt->bindValue(':product_id', $product_id);
    $stmt->execute();
    $product = $stmt->fetch();

    
    if($product_quantity<$product_quantity_buy){
        $error_message='enter lower product quantity !!!';
    }
    else{
        $order_date=date("Y-m-d");
        $order_total_amount = $product_quantity_buy * $product_price;
        $stmt = $pdo->prepare("INSERT INTO orders (product_id, customer_id, order_date, order_total_amount, order_status) VALUES (:product_id, :customer_id, :order_date, :order_total_amount, :order_status)");
        $stmt->bindValue(':product_id', $product_id);
        $stmt->bindValue(':customer_id', $customer_id);
        $stmt->bindValue(':order_date', $order_date);
        $stmt->bindValue(':order_total_amount', $order_total_amount);
        $stmt->bindValue(':order_status', "Waiting for Processing");
        $stmt->execute();

        $product_quantity=$product_quantity-$product_quantity_buy;
        $stmt = $pdo->prepare("UPDATE product SET product_quantity = :product_quantity  WHERE product_id = :product_id");
        $stmt->bindValue(':product_id', $product_id);
        $stmt->bindValue(':product_quantity', $product_quantity);
        $stmt->execute();

        header('Location: customer_product_order.php');
        exit();
    }
    
    
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Product View</title>
        <link rel="stylesheet"  href="main.css">
    </head>

    <body>
        <header class="header3">
            
            <a href='home.php'><img src='images/icons/logo.jpg' width='150' height='80'></a>
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
                <a href='customer_product_order.php'><img src='images/icons/basket.png' width='40' height='40'></a>
                <label class="label1">Basket</label>
            </div>
            <hr>
        </nav>

        <main>
            <h1>Product Details:</h1>
            <section>
                <p><img src='images/product_image/<?php echo $product_image; ?>' width='300' height='200'></p>
            </section>   
            
            <section>
                <h1><strong>Product Name: <label><?php echo $product_name ?></label></h1> 
                <h1><strong>Product Brief Description: </h1> <label><?php echo $product_description ?></label>
                <h1><strong>Product Category: <label><?php echo $product_category ?></label></h1> 
                <h1><strong>Product Price: <label><?php echo $product_price ?></label></h1>
                <h1><strong>Product Size: <label><?php echo $product_size ?></label></h1>
                <h1><strong>Product Quantity: <label><?php echo $product_quantity ?></label></h1>
                <h1><strong>Product Remarks: </h1> <label><?php echo $product_remarks ?></label>
            </section>
            <hr>
            <br>

            <form action="customer_product_view.php?product_id=<?php echo $product_id; ?>" method="post">
                <h1>Order Product:</h1>
                <p>
                    <label>Product Quantity: </label>
                    <input type="number" name="product_buy" required>
                </p>

                <?php
                    if ($error_message) {
                        echo '<span class="red-text">'.$error_message.' </span>';
                    }
                ?>
              
                <br><br>
                <input type="submit" name="button_Order_product" value="Order Product">
                
            </form>

            
        </main>
        
        <footer>
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved. </p>
        </footer>

    </body>
</html>