<?php
session_start();

require 'dbconfig.in.php';

if (!isset($_SESSION['customer_confirmation'])) {
    header('Location: register_step2.php');
    exit();
}
else{
    $customer_id = $_SESSION['customer_confirmation']['customer_id'];
    session_destroy();
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Customer Success Register</title>
        <link rel="stylesheet"  href="main.css">
    </head>
    <body> 
        <header>
            <h1>Customer Success Register</h1>
        </header>

        <main>
            <label>Register account successful for customer id: <?php echo $customer_id ?>, You can now <a href="login.php">login</a>.</label>
        </main>

        <footer>
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved. </p>
        </footer>
    </body>

</html>    