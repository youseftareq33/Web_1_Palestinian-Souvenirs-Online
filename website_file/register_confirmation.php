<?php
session_start();

require 'dbconfig.in.php';


if (!isset($_SESSION['customer_step2'])) {
    header('Location: register_step2.php');
    exit();
}
else{
    $customer_name=$_SESSION['customer_step2']['customer_name'];
    $customer_dob=$_SESSION['customer_step2']['customer_dob'];
    $customer_id_number=$_SESSION['customer_step2']['customer_id_number'];
    $customer_country=$_SESSION['customer_step2']['customer_country'];
    $customer_city=$_SESSION['customer_step2']['customer_city'];
    $customer_street=$_SESSION['customer_step2']['customer_street'];
    $customer_house_no=$_SESSION['customer_step2']['customer_house_no'];
    $customer_email=$_SESSION['customer_step2']['customer_email'];
    $customer_telephone=$_SESSION['customer_step2']['customer_telephone'];
    $customer_cc_number=$_SESSION['customer_step2']['customer_cc_number'];
    $customer_cc_expiration_date=$_SESSION['customer_step2']['customer_cc_expiration_date'];
    $customer_cc_name=$_SESSION['customer_step2']['customer_cc_name'];
    $customer_cc_bank=$_SESSION['customer_step2']['customer_cc_bank'];
    $customer_username=$_SESSION['customer_step2']['customer_username'];
    $customer_password=$_SESSION['customer_step2']['customer_password'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $customer_name=$_POST['customer_name'];
        $customer_dob=$_POST['customer_dob'];
        $customer_id_number=$_POST['customer_id_number'];
        $customer_country=$_POST['customer_country'];
        $customer_city=$_POST['customer_city'];
        $customer_street=$_POST['customer_street'];
        $customer_house_no=$_POST['customer_house_no'];
        $customer_email=$_POST['customer_email'];
        $customer_telephone=$_POST['customer_telephone'];
        $customer_cc_number=$_POST['customer_cc_number'];
        $customer_cc_expiration_date=$_POST['customer_cc_expiration_date'];
        $customer_cc_name=$_POST['customer_cc_name'];
        $customer_cc_bank=$_POST['customer_cc_bank'];
        $customer_username=$_POST['customer_username'];
        $customer_password=$_POST['customer_password'];

        $stmt = $pdo->prepare("SELECT * from customer");
        $stmt->execute();
        $hasData = $stmt->fetch();
        if($hasData){
            $stmt = $pdo->prepare("INSERT INTO customer (customer_name, customer_dob, customer_id_number, customer_country, customer_city, customer_street, customer_house_no, customer_email, customer_telephone, customer_cc_number, customer_cc_expiration_date, customer_cc_name, customer_cc_bank, customer_username, customer_password) VALUES (:customer_name, :customer_dob, :customer_id_number, :customer_country, :customer_city, :customer_street, :customer_house_no, :customer_email, :customer_telephone, :customer_cc_number, :customer_cc_expiration_date, :customer_cc_name, :customer_cc_bank, :customer_username, :customer_password)");
        }
        else{
            $stmt = $pdo->prepare("INSERT INTO customer (customer_id, customer_name, customer_dob, customer_id_number, customer_country, customer_city, customer_street, customer_house_no, customer_email, customer_telephone, customer_cc_number, customer_cc_expiration_date, customer_cc_name, customer_cc_bank, customer_username, customer_password) VALUES (:customer_id, :customer_name, :customer_dob, :customer_id_number, :customer_country, :customer_city, :customer_street, :customer_house_no, :customer_email, :customer_telephone, :customer_cc_number, :customer_cc_expiration_date, :customer_cc_name, :customer_cc_bank, :customer_username, :customer_password)");
            $stmt->bindValue(':customer_id', 1000000000);
        }
        $stmt->bindValue(':customer_name', $customer_name);
        $stmt->bindValue(':customer_dob', $customer_dob);
        $stmt->bindValue(':customer_id_number', $customer_id_number);
        $stmt->bindValue(':customer_country', $customer_country);
        $stmt->bindValue(':customer_city', $customer_city);
        $stmt->bindValue(':customer_street', $customer_street);
        $stmt->bindValue(':customer_house_no', $customer_house_no);
        $stmt->bindValue(':customer_email', $customer_email);
        $stmt->bindValue(':customer_telephone', $customer_telephone);
        $stmt->bindValue(':customer_cc_number', $customer_cc_number);
        $stmt->bindValue(':customer_cc_expiration_date', $customer_cc_expiration_date);
        $stmt->bindValue(':customer_cc_name', $customer_cc_name);
        $stmt->bindValue(':customer_cc_bank', $customer_cc_bank);
        $stmt->bindValue(':customer_username', $customer_username);
        $stmt->bindValue(':customer_password', $customer_password);
        $stmt->execute();

        $stmt=$pdo->prepare("SELECT * FROM customer ORDER BY customer_id DESC LIMIT 1");
        $stmt->execute();
        $customer = $stmt->fetch();
    
        $_SESSION['customer_confirmation'] = [
            'customer_id'=>$customer['customer_id'],
        ];
        header('Location: success_register.php');
        exit();
    }
}



    
    

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Customer Register Confirmation</title>
        <link rel="stylesheet"  href="main.css">
    </head>
    <body> 
        <header>
            <h1>Customer Register Confirmation</h1>
        </header>

        <main>
            <h2>Registration Details:</h2>
            <form action="register_confirmation.php" method="post">
                <p>
                    <label>Name: </label>
                    <input type="text" name="customer_name" value="<?php echo $customer_name ?>" required>
                </p>

                <p>
                    <label>Date of Birth: </label>
                    <input type="date" name="customer_dob" value="<?php echo $customer_dob ?>" required>
                </p>

                <p>
                    <label>ID Number: </label>
                    <input type="number" name="customer_id_number" value="<?php echo $customer_id_number ?>" required>
                </p>

                <div>
                    <label>Address: </label>
                    <br>
                    &nbsp;
                    <label>Country: </label>
                    <input type="text" name="customer_country" value="<?php echo $customer_country ?>" required>
                    &nbsp;
                    <label>City: </label>
                    <input type="text" name="customer_city" value="<?php echo $customer_city ?>" required>
                    <br>
                    &nbsp;
                    <label>Street: </label>
                    <input type="text" name="customer_street" value="<?php echo $customer_street ?>" required>
                    &nbsp;
                    <label>House no.: </label>
                    <input type="number" name="customer_house_no" value="<?php echo $customer_house_no ?>" required>
                </div>

                <p>
                    <label>Email:</label>
                    <input type="email" name="customer_email" value="<?php echo $customer_email ?>" required>
                </p>

                <p>
                    <label>Tel:</label>
                    <input type="tel" name="customer_telephone" placeholder="059-4356788" value="<?php echo $customer_telephone ?>" required>
                </p>

                <div>
                    <h2>Credit Card Details:</h2>

                    <p>
                    <label>Credit Card Number:</label>
                    <input type="number" name="customer_cc_number" placeholder="059-4356788" value="<?php echo $customer_cc_number ?>" required>
                    </p>

                    <p>
                    <label>Credit Card Expiration Date:</label>
                    <input type="date" name="customer_cc_expiration_date" value="<?php echo $customer_cc_expiration_date ?>" required>
                    </p>

                    <p>
                    <label>Credit Card Name:</label>
                    <input type="text" name="customer_cc_name" placeholder="059-4356788" value="<?php echo $customer_cc_name ?>" required>
                    </p>

                    <p>
                    <label>Credit Card Bank:</label>
                    <input type="text" name="customer_cc_bank" placeholder="059-4356788" value="<?php echo $customer_cc_bank ?>" required>
                    </p>
                </div>
                
                <p>
                    <label>Username:</label>
                    <input type="text" name="customer_username" value="<?php echo $customer_username ?>" required>
                </p>

                <p>
                    <label>Password:</label>
                    <input type="password" name="customer_password" value="<?php echo $customer_password ?>" required>
                </p>
              

                <input type="submit" name="button_Confirm_Register" value="Confirm Register">
                
            </form>
            
        </main>

        <footer>
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved. </p>
        </footer>
    </body>

</html>    