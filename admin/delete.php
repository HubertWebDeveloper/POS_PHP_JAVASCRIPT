<?php
include("includes/function.php");


//$paramResultAdmin = checkParamId('id_admin');
//$paramResultCustom = checkParamId('id_custom');

if(isset($_GET['id_admin'])){// this for deleting Admin data
   
    $adminId = $_GET['id_admin'];

    $admin = getById('admins',$adminId);
        $adminDelete = delete('admins', $adminId);
        if($adminDelete){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Admin Deleted.";
        }else{
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Something Went Wrong!";
        }
}else if(isset($_GET['id_cust'])){// this for deleting Customer data
   
    $customId = $_GET['id_cust'];

    $custom = getById('customers', $customId);
        $customDelete = delete('customers', $customId);
        if($customDelete){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Customers Deleted.";
        }else{
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Something Went Wrong!";
        }
}else if(isset($_GET['id_categ'])){// this for deleting Customer data
   
    $categId = $_GET['id_categ'];

    $categ = getById('category', $categId);
        $categDelete = delete('category', $categId);
        if($categDelete){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Category Deleted.";
        }else{
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Something Went Wrong!";
        }
}else if(isset($_GET['id_prod'])){// this for deleting Product data
   
    $prodId = $_GET['id_prod'];

    $categ = getById('products', $prodId);
        $select = mysqli_query($con, "SELECT * FROM `products` WHERE `id`='$prodId'");
        $row = mysqli_fetch_assoc($select);
        $deleteImage = $row['image'];

        unlink("images/".$deleteImage); //query for deleting image from folder.
        $prodDelete = delete('products', $prodId); //query for deleting data
        if($prodDelete){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Product Deleted.";
        }else{
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Something Went Wrong!";
        }
}else if(isset($_GET['order_id'])){// this for deleting Product data
   
    $user_ip = $_SERVER['REMOTE_ADDR'];
    $order_ID = validate($_GET['order_id']);

    $delete = mysqli_query($con, "DELETE FROM `temporary_card` WHERE user_ip='$user_ip' AND id='$order_ID'");
    if($delete){
        echo "<script>window.open('index.php?item=index','_self')</script>";
        redirect('index.php','Product Deleted.');
    }else{
        echo "<script>window.open('index.php?item=index','_self')</script>";
        redirect('index.php','Something Went Wrong.');
    }
   
}else{
    echo "<script>window.open('admins.php?item=admins','_self')</script>";
    redirect('admins.php','Something Went wrong.');
}
?>