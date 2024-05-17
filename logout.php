<?php

include("admin/includes/function.php");

if(isset($_SESSION['loggedIn'])){
    logoutSession();
    echo "<script>window.open('login.php','_self')</script>";
    $_SESSION['success'] = "You've Logged Out.";
}

?>