<?php
session_start();

require 'dbconfig.in.php';

$error_message='';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $username=$_POST['username'];
    $password=$_POST['password'];

    $stmt=$pdo->prepare("SELECT * FROM customer WHERE customer_username = :username");
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $customer = $stmt->fetch();

    $stmt=$pdo->prepare("SELECT * FROM employee WHERE employee_username = :username");
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $employee = $stmt->fetch();

    if($customer){
        if($customer['customer_password']!==$password){
            $error_message='Username or Password uncorrect !!!';
        }
        else{
            $_SESSION['customer_id'] = $customer['customer_id'];

            header('Location: customer_home.php');
            exit();
        }
    }
    else if($employee){
        if($employee['employee_password']!==$password){
            $error_message='Username or Password uncorrect !!!';
        }
        else{
            $_SESSION['employee_id'] = $employee['employee_id'];

            header('Location: employee_home.php');
            exit();
        }
    }
    else{
        $error_message='Username or Password uncorrect !!!';
    }

    
    
}

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Login Page</title>
        <link rel="stylesheet"  href="main.css">
    </head>
    <body> 
        <header>
            <h1>Login</h1>
        </header>
        <center>
            <main class="main4">
                <form action="login.php" method="post">
                    <p>
                        <label>Userame: </label>
                        <input type="text" name="username" minlength="6" maxlength="13" value="<?php echo (isset($username)) ? $username : ''; ?>" required>
                    </p>

                    <p>
                        <label>Password: </label>
                        <input type="password" name="password" minlength="8" maxlength="12" value="<?php echo (isset($password)) ? $password : ''; ?>" required>
                    </p>

                    <?php
                    if ($error_message) {
                        echo '<span class="red-text">'.$error_message.' </span>';
                    }
                    ?>

                    <br>
                    <br>
                    <p>Don't have an account yet? <a href="register_step1.php">Register An Account</a></p>
                    <input type="submit" name="button_login" value="login">
                    
                    
                </form>
            </main>
        </center>
        

        <footer>
            <p> &copy; 2024 palestinian souvenirs online. All rights reserved. </p>
        </footer>
    </body>

</html>    