<?php

include("includes/function.php");

$paramResult = checkParamId('index');
if(is_numeric($paramResult)){
    $indexValue = validate($paramResult);

    if(isset($_SESSION['productItems']) && isset($_SESSION['productItemIds'])){
        unset($_SESSION['productItems'][$indexValue]);
        unset($_SESSION['productItemIds'][$indexValue]);

        echo "<script>window.open('order.php?item=order','_self')</script>";
        $_SESSION['success'] = "Product Removed to the List";
    }else{
        echo "<script>window.open('order.php?item=order','_self')</script>";
        $_SESSION['warning'] = "There is no Product";
    }
}else{
    echo "<script>window.open('order.php?item=order','_self')</script>";
    $_SESSION['warning'] = "Param not numeric";
}

?>