<?php
include("admin/includes/function.php");
if(isset($_POST['loginBtn'])){
    $email = validate($_POST['email']);
    $password = validate($_POST['password']);
    if($email !='' && $password !=''){
        $checkUser = mysqli_query($con, "SELECT * FROM `admins` WHERE `email`='$email' AND `password`='$password' LIMIT 1");
        if(mysqli_num_rows($checkUser) == 1){
            $row = mysqli_fetch_assoc($checkUser);
            if($row['active'] == 1){
                $_SESSION['LoggedIn'] = true;
                $_SESSION['LoggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'phone' => $row['phone']
                ];
                echo "<script>window.open('admin/index.php?item=index','_self')</script>";
                $_SESSION['success'] = "You Logged In Successfuly.";
            }else{
                echo "<script>window.open('login.php','_self')</script>";
                $_SESSION['danger'] = "Your Account has been banned, Contact admin";
            }
        }else{
            echo "<script>window.open('login.php','_self')</script>";
            $_SESSION['warning'] = "Invalid Email or Password";
        }
    }else{
        echo "<script>window.open('login.php','_self')</script>";
        $_SESSION['warning'] = "email or password should not be blank";
    }
}
?>