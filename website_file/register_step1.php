<?php
session_start();

require 'dbconfig.in.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $_SESSION['customer_step1'] = [
        'customer_name'=>$_POST['customer_name'],
        'customer_dob'=>$_POST['customer_dob'],
        'customer_id_number'=>$_POST['customer_id_number'],
        'customer_country'=>$_POST['customer_country'],  
        'customer_city'=>$_POST['customer_city'],
        'customer_street'=>$_POST['customer_street'],
        'customer_house_no'=>$_POST['customer_house_no'],
        'customer_email'=>$_POST['customer_email'],
        'customer_telephone'=>$_POST['customer_telephone'],
        'customer_cc_number'=>$_POST['customer_cc_number'],
        'customer_cc_expiration_date'=>$_POST['customer_cc_expiration_date'],
        'customer_cc_name'=>$_POST['customer_cc_name'],
        'customer_cc_bank'=>$_POST['customer_cc_bank'],
    ];

    
    header('Location: register_step2.php');
    exit();
}



?>


<!DOCTYPE html>
<html>
    <head>
        <title>Customer Register Step 1</title>
        <link rel="stylesheet"  href="main.css">
    </head>
    <body> 
        <header>
            <h1>Customer Register Step 1</h1>
        </header>

        <main>
            <form action="register_step1.php" method="post">
                <p>
                    <label>Name: </label>
                    <input type="text" name="customer_name" required>
                </p>

                <p>
                    <label>Date of Birth: </label>
                    <input type="date" name="customer_dob" required>
                </p>

                <p>
                    <label>ID Number: </label>
                    <input type="number" name="customer_id_number" required>
                </p>

                <p>
                    <label>Address: </label>
                    <br>
                    &nbsp;
                    <label>Country: </label>
                    <input type="text" name="customer_country" required>
                    &nbsp;
                    <label>City: </label>
                    <input type="text" name="customer_city" required>
                    <br>
                    &nbsp;
                    <label>Street: </label>
                    <input type="text" name="customer_street" required>
                    &nbsp;
                    <label>House no.: </label>
                    <input type="number" name="customer_house_no" required>
                </p>

                <p>
                    <label>Email:</label>
                    <input type="email" name="customer_email" required>
                </p>

                <p>
                    <label>Tel:</label>
                    <input type="tel" name="customer_telephone" placeholder="059-4356788" required>
                </p>

                <div>
                    <h2>Credit Card Details:</h2>

                    <p>
                    <label>Credit Card Number:</label>
                    <input type="number" name="customer_cc_number" required>
                    </p>

                    <p>
                    <label>Credit Card Expiration Date:</label>
                    <input type="date" name="customer_cc_expiration_date" required>
                    </p>

                    <p>
                    <label>Credit Card Name:</label>
                    <input type="text" name="customer_cc_name" required>
                    </p>

                    <p>
                    <label>Credit Card Bank:</label>
                    <input type="text" name="customer_cc_bank" required>
                    </p>
                </div>
                
              
                <input type="submit" name="button_next" value="next">
                
                
            </form>
        </main>

        <footer>
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved. </p>
        </footer>
    </body>

</html>    