<?php
include("includes/function.php");

$flag = false;

if(isset($_POST['saveAdmin'])){
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $is_ban = isset($_POST['is_ban']) == true ? 1:0;

    if($name !='' && $email !='' && $password !=''){
        //checking if email already exist
        $emailCheck = mysqli_query($con, "SELECT * FROM admins WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                echo "<script>window.open('admins.php?item=admins','_self')</script>";
                $_SESSION['warning'] = "This '$email' already used by another user.";
            }
        }
        //encrypiting password
        $encryPassword = password_hash($password, PASSWORD_BCRYPT);

        $data = [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'password' => $password,
            'active' => $is_ban
        ];
        $insert = insert('admins',$data);
        if($insert){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Admin Added Successfully.";
        }else{
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['danger'] = "Something Went Wrong!";
        }
    }else{
        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['warning'] = "Please required fields.";
    }
}
//Updating Admin here
if(isset($_POST['updateAdmin'])){
    $id = validate($_POST['id']);

    $adm = getById('admins',$id);
    if($adm['status'] != 200){
        echo "<script>window.open('edit_admin.php?id=$id','_self')</script>";
        redirect('edit_admin.php?id='.$id,'Please fill required fields.');
    }
    $name = validate($_POST['name']);
    $email = validate($_POST['email']);
    $phone = validate($_POST['phone']);
    $password = validate($_POST['password']);
    $is_ban = isset($_POST['is_ban']) == true ? 1:0;

    $emailCheck = mysqli_query($con, "SELECT * FROM admins WHERE email='$email' and id!=$id");
    if($emailCheck){
        if(mysqli_num_rows($emailCheck) > 0){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['warning'] = "This '$email' already used by another user.";
        }else{
            $insert = mysqli_query($con, "UPDATE `admins` SET `name`='$name',`email`='$email',`phone`='$phone',`password`='$password',`active`='$is_ban' WHERE id='$id'");
            if($insert){
                echo "<script>window.open('admins.php?item=admins','_self')</script>";
                $_SESSION['success'] = "Admin '$name' Updated Successfully.";
            }else{
                echo "<script>window.open('admins.php?item=admins&&id=$id','_self')</script>";
                $_SESSION['danger'] = "Something Went Wrong!";
            }
        }
    }

    
}

if(isset($_POST['saveCust'])){
    $name_custom = validate($_POST['name']);
    $email_custom = validate($_POST['email']);
    $phone_custom = validate($_POST['phone']);
    $is_ban_custom = isset($_POST['is_ban']) == true ? 1:0;

    if($name_custom !='' && $email_custom !=''){
        //checking if email already exist
        $emailCheck = mysqli_query($con, "SELECT * FROM customers WHERE email='$email'");
        if($emailCheck){
            if(mysqli_num_rows($emailCheck) > 0){
                echo "<script>window.open('admins.php?item=admins','_self')</script>";
                $_SESSION['warning'] = "This '$email_custom' already used by another user.";
            }
        }
        //encrypiting password
        $encryPassword = password_hash($password, PASSWORD_BCRYPT);

        $dataCustom = [
            'name' => $name_custom,
            'email' => $email_custom,
            'phone' => $phone_custom,
            'active' => $is_ban_custom
        ];
        $insertCustom = insert('customers',$dataCustom);
        if($insertCustom){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Customer Added Successful.";
        }else{
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['danger'] = "Something Went Wrong!";
        }
    }else{
        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['warning'] = "Please required fileds";
    }
}
//Updating Admin here
if(isset($_POST['updateCustomer'])){
    $id_cust = validate($_POST['id_cust']);

    $adm_cust = getById('customers',$id_cust);
    if($adm_cust['status'] != 200){
        echo "<script>window.open('amdins.php?item=admins&&id=$id_cust','_self')</script>";
        redirect('admins.php?id='.$id_cust,'Please fill required fields.');
    }
    $name_cust = validate($_POST['name_cust']);
    $email_cust = validate($_POST['email_cust']);
    $phone_cust = validate($_POST['phone_cust']);
    $is_ban_cust = isset($_POST['is_ban_cust']) == true ? 1:0;

    $emailCheck2 = mysqli_query($con, "SELECT * FROM customers WHERE email='$email_cust' and id!=$id_cust");
    if($emailCheck2){
        if(mysqli_num_rows($emailCheck2) > 0){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['warning'] = "this '$email_cust' already used by another user";
        }else{
            $insert = mysqli_query($con, "UPDATE `customers` 
            SET `name`='$name_cust',`email`='$email_cust',`phone`='$phone_cust',`active`='$is_ban_cust' WHERE id='$id_cust'");
            if($insert){
                echo "<script>window.open('admins.php?item=admins','_self')</script>";
                $_SESSION['success'] = "Customer '$name_cust' Updated Successful";
            }else{
                echo "<script>window.open('admins.php?item=dmins&&id=$id','_self')</script>";
                $_SESSION['danger'] = "Something Went Wrong!";
            }
        }
    }

    
}


if(isset($_POST['saveCateg'])){
    $name_categ = validate($_POST['name']);
    $is_ban_categ = isset($_POST['is_ban']) == true ? 1:0;

    if($name_categ !=''){

        $dataCateg = [
            'name' => $name_categ,
            'status' => $is_ban_categ
        ];
        $insertCateg = insert('category',$dataCateg);
        if($insertCateg){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Category Added Successful";
        }else{
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['danger'] = "Something Went wrong!";
        }
    }else{
        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['warning'] = "Please required fields";
    }
}
//Updating Category here
if(isset($_POST['updateCateg'])){
    $id_categ_up = validate($_POST['id_categ_up']);

    $cate = getById('category',$id_categ_up);
    if($cate['status'] != 200){
        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['warning'] = "Please fill required fields";
    }
    $name_categ = validate($_POST['name_categ']);
    $is_ban_categ = isset($_POST['is_ban_categ']) == true ? 1:0;

    $insert = mysqli_query($con, "UPDATE `category` SET `name`='$name_categ',`status`='$is_ban_categ' WHERE id='$id_categ_up'");
    if($insert){

        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['success'] = "Category Updated";
    }else{
        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['danger'] = "Something went Wrong!";
    }  
}


if(isset($_POST['saveProd'])){
    $categ_id = validate($_POST['categ_id']);
    $name = validate($_POST['name']);
    $price = validate($_POST['price']);
    $qty = validate($_POST['qty']);
    $desc = validate($_POST['desc']);
    $image = $_FILES['image']['name'];
    $date = date('Y-m-d');
    $is_ban_prod = isset($_POST['is_ban']) == true ? 1:0;

    if($categ_id !='' && $name !=''){

        $img1 = $_FILES['image']['name'];
        $temp_name = $_FILES['image']['tmp_name'];
        move_uploaded_file($temp_name, "images/$img1");

        $dataProd = [
            'categ_id' => $categ_id,
            'name' => $name,
            'description' => $desc,
            'price' => $price,
            'quantity' => $qty,
            'image' => $img1,
            'status' => $is_ban_prod,
            'created_at' => $date
        ];
        $insertProd = insert('products',$dataProd);
        if($insertProd){
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['success'] = "Product Added Successful";
        }else{
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            $_SESSION['danger'] = "Something went Wrong!";
        }
    }else{
        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['warning'] = "Select category name and type product name";
    }
}
//Updating Product here
if(isset($_POST['updateProd'])){
    $id_prod_up = validate($_POST['id_prod_up']);

    $pro = getById('products',$id_prod_up);
    if($pro['status'] != 200){
        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['warning'] = "Please fill required fields";
    }
    $categ_id_up = validate($_POST['categ_id']);
    $name_up_pro = validate($_POST['name']);
    $price_up = validate($_POST['price']);
    $qty_up = validate($_POST['qty']);
    $desc_up = validate($_POST['desc']);
    $image_up = $_FILES['image_up']['name'];
    $date_up = date('Y-m-d');
    $is_ban_prod_up = isset($_POST['is_ban']) == true ? 1:0;


    $check = mysqli_query($con, "SELECT * FROM `products` WHERE `id`='$id_prod_up'");
    $row2 = mysqli_fetch_assoc($check);
    $deleteImage = $row2['image'];

    if($image_up == ""){
        $img2 = $deleteImage;
    }else{
        unlink("images/".$deleteImage); //query for deleting image from folder.

        $img2 = $_FILES['image_up']['name'];
        $temp_name2 = $_FILES['image_up']['tmp_name'];
        move_uploaded_file($temp_name2, "images/$img2"); // uplaod new image
    }

    $insert = mysqli_query($con, "UPDATE `products` 
    SET `categ_id`='$categ_id_up',`name`='$name_up_pro',`description`='$desc_up',`price`='$price_up',
    `quantity`='$qty_up',`image`='$img2',`status`='$is_ban_prod_up',`created_at`='$date_up' WHERE id='$id_prod_up'");
    if($insert){

        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['success'] = "Product Updated";
    }else{
        echo "<script>window.open('admins.php?item=admins','_self')</script>";
        $_SESSION['danger'] = "Something went Wrong!";
    }  
}


//Updating Stock here
if(isset($_POST['stock'])){

    $name_up_stock = validate($_POST['name_stock']);
    $qty_stock = validate($_POST['qty_stock']);

    $stock = mysqli_query($con, "SELECT * FROM `products` WHERE `name`='$name_up_stock'");
    $stock_row = mysqli_fetch_assoc($stock);

    $old_stock = $stock_row['quantity'];
    $new_stock = $old_stock + $qty_stock;

    if($name_up_stock != ""){
        $insert = mysqli_query($con, "UPDATE `products` 
        SET `quantity`='$new_stock',`status`='1' WHERE `name`='$name_up_stock'");
        if($insert){

            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            redirect('admins.php','Stock Added Successfully.');
        }else{
            echo "<script>window.open('admins.php?item=admins','_self')</script>";
            redirect('admins.php', 'Something Went Wrong!');
        }  
    }else{
        
    }

    
}

// getting order

// setting array.
// after button clicked.
if(isset($_POST['filter'])){
    $ID = validate($_POST['product_id']);
    $qtyt = validate($_POST['order_qty']);

    $checkout = mysqli_query($con, "SELECT * FROM products WHERE id='$ID' LIMIT 1");
    if($checkout){
        if(mysqli_num_rows($checkout) > 0){
            
            $order_row = mysqli_fetch_assoc($checkout);
            
            if($order_row['quantity'] < $qtyt){
                echo "<script>window.open('index.php??item=index','_self')</script>";
                redirect('index.php','Only '.$order_row['quantity'].' quantity available');
            }else{
                $IP = $_SERVER['REMOTE_ADDR'];
                $product_id = $order_row['id'];
                $product_name = $order_row['name'];
                $product_price = $order_row['price'];
                $product_qty = $order_row['quantity'];
                
                $checkData = mysqli_query($con, "SELECT * FROM temporary_card WHERE `user_ip`='$IP' AND `product_id`='$ID'");
                if(mysqli_num_rows($checkData) > 0){
                    $rrow = mysqli_fetch_assoc($checkData);
                    $newQty = $rrow['product_qty'] + $qtyt;

                    $data = mysqli_query($con, "UPDATE `temporary_card` SET `product_qty`='$newQty' WHERE `user_ip`='$IP' AND `product_id`='$ID'");
                    if($data){
                        //$QQ = $product_qty - $qtyt;
                        //$updateData = mysqli_query($con, "UPDATE `products` SET `quantity`='$QQ' WHERE `name`='$product_name'");
                        
                        echo "<script>window.open('index.php?item=index','_self')</script>";
                        redirect('index.php','Product '.$rrow['product_name'].' Updated');
                    }else{
                        echo "<script>window.open('index.php?item=index','_self')</script>";
                        redirect('index.php','Something Went Wrong!');
                    }
                }else{
                    $data = mysqli_query($con, "INSERT INTO `temporary_card`(`user_ip`, `product_id`, `product_name`, `product_price`, `product_qty`) 
                    VALUES ('$IP','$product_id','$product_name','$product_price','$qtyt')");
                    if($data){
                        //$QQ = $product_qty - $qtyt;
                        //$updateData = mysqli_query($con, "UPDATE `products` SET `quantity`='$QQ' WHERE `name`='$product_name'");
                        
                        echo "<script>window.open('index.php?item=index','_self')</script>";
                        redirect('index.php','Product Added');
                    }else{
                        echo "<script>window.open('index.php?item=index','_self')</script>";
                        redirect('index.php','Something Went Wrong!');
                    }
                }
            }
        }
    }
}
// updating after increment and decrement
if(isset($_POST['productIncDec'])){
    $prod_ID = validate($_POST['product_id']);
    $prod_QTY = validate($_POST['quantity_up']);

    $update = mysqli_query($con, "UPDATE `temporary_card` SET `product_qty`='$prod_QTY' WHERE id='$prod_ID'");
    if($update){
        jsonResponse(200, 'success', 'Quantity Updated.');
    }else{
        jsonResponse(500, 'error', 'Something Went Wrong!, please re-fresh.');
    }
}

// keeping order from user
if(isset($_POST['proceedToPlaceBtn'])){

    $cphone = validate($_POST['cphone']);
    $payment_mode = validate($_POST['payment_mode']);

    //checking if customer number exist
    $checkCustomer = mysqli_query($con, "SELECT * FROM `customers` WHERE `phone`='$cphone'");
    if($checkCustomer){
        if(mysqli_num_rows($checkCustomer) > 0){

            $_SESSION['invoice_no'] = "INV-".rand(111111,999999);
            $_SESSION['cphone'] = $cphone;
            $_SESSION['payment_mode'] = $payment_mode;

            jsonResponse(200,'success','Continue');
        }else{
            $_SESSION['cphone'] = $cphone;
            jsonResponse(404,'warning','Customer Phone Not Found');
        }
    }else{
        jsonResponse(500,'error','Something Went Wrong!');
    }
}

//insert New customer from number
if(isset($_POST['saveCustomerBtn'])){
    $C_name = validate($_POST['c_name']);
    $C_email = validate($_POST['c_email']);
    $C_phone = validate($_POST['c_phone']);
    $C_active = "1";

    //jsonResponse(200, 'error', 'Continue');
    if($C_name !='' && $C_phone !=''){
        //checking if email already exist
        $emailCheck2 = mysqli_query($con, "SELECT * FROM customers WHERE email='$C_email' AND phone='$C_phone'");
        if($emailCheck2){
            if(mysqli_num_rows($emailCheck2) > 0){
                jsonResponse(422, 'warning', 'Phone Number has already taken.');
            }
        }

        $dataCustom2 = [
            'name' => $C_name,
            'email' => $C_email,
            'phone' => $C_phone,
            'active' => $C_active
        ];
        $insertCustom2 = insert('customers',$dataCustom2);
        if($insertCustom2){
            jsonResponse(200, 'success', 'Customer Added');
        }else{
            jsonResponse(500, 'error', 'failed to add, Try again');
        }
    }else{
        jsonResponse(422, 'error', 'Please fill required fileds');
    }
}


?>