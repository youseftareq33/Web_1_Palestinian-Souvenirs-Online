<?php
session_start();

require 'dbconfig.in.php';

$error_message='';

if (!isset($_SESSION['customer_step1'])) {
    header('Location: register_step1.php');
    exit();
}
else{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $customer_username=$_POST['customer_username'];
        $customer_password=$_POST['customer_password'];
        $customer_confirm_password=$_POST['customer_confirm_password'];
    
        if($customer_password!==$customer_confirm_password){
            $error_message='Password dosent match !!!';
        }
        else{
            $stmt=$pdo->prepare("SELECT * FROM customer WHERE customer_username = :customer_username");
            $stmt->bindValue(':customer_username', $customer_username);
            $stmt->execute();
            $existCustomer_username = $stmt->fetch();
    
            if ($existCustomer_username) {
                $error_message='Username already exists !!!';
            }
            else{
                $_SESSION['customer_step2'] = [
                    'customer_name'=>$_SESSION['customer_step1']['customer_name'],
                    'customer_dob'=>$_SESSION['customer_step1']['customer_dob'],
                    'customer_id_number'=>$_SESSION['customer_step1']['customer_id_number'],
                    'customer_country'=>$_SESSION['customer_step1']['customer_country'],
                    'customer_city'=>$_SESSION['customer_step1']['customer_city'],
                    'customer_street'=>$_SESSION['customer_step1']['customer_street'],
                    'customer_house_no'=>$_SESSION['customer_step1']['customer_house_no'],
                    'customer_email'=>$_SESSION['customer_step1']['customer_email'],
                    'customer_telephone'=>$_SESSION['customer_step1']['customer_telephone'],
                    'customer_cc_number'=>$_SESSION['customer_step1']['customer_cc_number'],
                    'customer_cc_expiration_date'=>$_SESSION['customer_step1']['customer_cc_expiration_date'],
                    'customer_cc_name'=>$_SESSION['customer_step1']['customer_cc_name'],
                    'customer_cc_bank'=>$_SESSION['customer_step1']['customer_cc_bank'],
                    'customer_username'=>$customer_username,
                    'customer_password'=>$customer_password,
                ];
    
                header('Location: register_confirmation.php');
                exit();
            }
        }
        
        
    }
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Customer Register Step 2</title>
        <link rel="stylesheet"  href="main.css">
    </head>
    <body> 
        <header>
            <h1>Customer Register Page Step 2</h1>
        </header>

        <main>
            <form action="register_step2.php" method="post">
                <p>
                    <label>Userame: </label>
                    <input type="text" name="customer_username" minlength="6" maxlength="13" value="<?php echo (isset($customer_username)) ? $customer_username : ''; ?>" required>
                </p>

                <p>
                    <label>Password: </label>
                    <input type="password" name="customer_password" minlength="8" maxlength="12" value="<?php echo (isset($customer_password)) ? $customer_password : ''; ?>" required>
                </p>

                <p>
                    <label>Confirm Password: </label>
                    <input type="password" name="customer_confirm_password" minlength="8" maxlength="12" value="<?php echo (isset($customer_confirm_password)) ? $customer_confirm_password : ''; ?>" required>
                </p>

                <?php
                if ($error_message==='Password dosent match !!!') {
                    echo '<span class="red-text">'.$error_message.' </span>';
                    $customer_confirm_password="";
                }
                else if($error_message==='Username already exists !!!'){
                    echo '<span class="red-text">'.$error_message.' </span>';
                    $customer_username="";
                }
                ?>

                <br>
                <br>
                <input type="submit" name="button_next" value="next">
                
                
            </form>
        </main>

        <footer>
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved. </p>
        </footer>
    </body>

</html>    