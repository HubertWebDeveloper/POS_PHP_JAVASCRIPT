<?php
include("includes/function.php");
if(!isset($_SESSION['productItems'])){
    $_SESSION['productItems'] = [];
}
if(!isset($_SESSION['productItemIds'])){
    $_SESSION['productItemIds'] = [];
}

if(isset($_POST['filter'])){
    $product_id = validate($_POST['product_id']);
    $order_qty = validate($_POST['order_qty']);

    $checkProduct = mysqli_query($con, "SELECT * FROM `products` WHERE id='$product_id' LIMIT 1");
    if($checkProduct){
       if(mysqli_num_rows($checkProduct) > 0){
            $row = mysqli_fetch_assoc($checkProduct);
            if($row['quantity'] > $order_qty){
               $productdata = [
                  'product_id' =>$row['id'],
                  'name' =>$row['name'],
                  'image' =>$row['image'],
                  'price' =>$row['price'],
                  'quantity' =>$order_qty,
               ];
               if(!in_array($row['id'], $_SESSION['productItemIds'])){
                    array_push($_SESSION['productItemIds'],$row['id']);
                    array_push($_SESSION['productItems'],$productdata);

                    //redirect back to the first page with success message.
                    echo "<script>window.open('order.php?item=order','_self')</script>";
                    $_SESSION['success'] = "Product Added Successful.";
               }else{
                    foreach($_SESSION['productItems'] as $key => $prodSessionItem){
                        if($prodSessionItem['product_id'] == $row['id']){
                            $newQty = $prodSessionItem['quantity'] + $order_qty;

                            $productdata = [
                                'product_id' =>$row['id'],
                                'name' =>$row['name'],
                                'image' =>$row['image'],
                                'price' =>$row['price'],
                                'quantity' =>$newQty,
                            ];
                            $_SESSION['productItems'][$key] = $productdata;

                            //redirect back to the first page with success message.
                            echo "<script>window.open('order.php?item=order','_self')</script>";
                            $_SESSION['success'] = "Product Added Successful.";
                        }
                    }       
               }
               


            }else{
                echo "<script>window.open('order.phpitem=order','_self')</script>";
                $_SESSION['warning'] = "Only " .$row['quantity']. " Qauntity available.";
            }
       }else{
        echo "<script>window.open('order.phpitem=order','_self')</script>";
        $_SESSION['danger'] = "No such Product Found!";
    }
    }else{
        echo "<script>window.open('order.phpitem=order','_self')</script>";
        $_SESSION['danger'] = "Something Went Wrong!";
    }
};
if(isset($_POST['productIncDec'])){
    $prod_ID = validate($_POST['prod_id']);
    $prod_QTY = validate($_POST['prod_qty']);
    
    $flog = false;
    foreach($_SESSION['productItems'] as $key => $item){
        if($item['product_id'] == $prod_ID){

            $flog = true;
            $_SESSION['productItems'][$key]['quantity'] = $prod_QTY;
        }else{
            $flog = false;
        }
    }
    if($flog = true){
        jsonResponse(200,'success','Quantity Updated.');
    }else{
        jsonResponse(500, 'error', 'Something Went Wrong!,please re-fresh.');
    } 
}



// after processed button clicked to procced
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

            jsonResponse(200,'success','Customer Found');
        }else{
            $_SESSION['cphone'] = $cphone;
            jsonResponse(404,'warning','Customer Not Found');
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

//Save Order and Insert Data into Database
if(isset($_POST['saveOrder'])){
    $phone = validate($_SESSION['cphone']);
    $invoice_no = validate($_SESSION['invoice_no']);
    $payment_mode = validate($_SESSION['payment_mode']);
    $order_placed_by = $_SESSION['LoggedInUser']['name'];

    $checkCustomerOrder = mysqli_query($con, "SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
    if(!$checkCustomerOrder){
        jsonResponse(500,'error','Something Went Wrong!');
    }
    if(mysqli_num_rows($checkCustomerOrder) > 0){
        $customerData = mysqli_fetch_assoc($checkCustomerOrder);

        if(!isset($_SESSION['productItems'])){
            jsonResponse(404,'warning','No Items To Place order');
        }

        $sessionProducts = $_SESSION['productItems'];

        $totalAmount = 0;
        foreach($sessionProducts as $amtItem){
            $totalAmount += $amtItem['price'] * $amtItem['quantity'];
        }
        $data = [
            'customer_id' => $customerData['id'],
            'tracking_no' => 'TRACK-'.rand(11111,99999).'-INV',
            'invoice_no' => $invoice_no,
            'total_amount' => $totalAmount,
            'order_date' => date('Y-m-d'),
            'order_status' => 'booked',
            'payment_mode' => $payment_mode,
            'order_placed_by' => $order_placed_by
        ];
        $result = insert('orders', $data);
        $lastOrderId = mysqli_insert_id($con); //getting id from the latest data.

        foreach($sessionProducts as $prodItem){

            $productId = $prodItem['product_id'];
            $price = $prodItem['price'];
            $quantity = $prodItem['quantity'];

            // insert Order Items list
            $dataOrderItem = [
                'order_id' => $lastOrderId,
                'product_id' => $productId,
                'price' => $price,
                'quantity' => $quantity
            ];
            $orderItemQuery = insert('order_items', $dataOrderItem);

            // update quantity of products
            $checkQ = mysqli_query($con, "SELECT *FROM `products` WHERE id='$productId'");
            $productR = mysqli_fetch_assoc($checkQ);

            $totalProduct = $productR['quantity'] - $quantity;

            $dataUpdate = [
                'quantity' => $totalProduct
            ];
            $updateProductQ = update('products', $productId, $dataUpdate);
        }

        // make empty of all other session.
        unset($_SESSION['productItemIds']);
        unset($_SESSION['productItems']);
        unset($_SESSION['cphone']);
        unset($_SESSION['payment_mode']);
        unset($_SESSION['invoice_no']);

        jsonResponse(200,'success','Order Saved Successfully.');
    }else{
        jsonResponse(404,'warning','No Customer Found!');
    }
}

?>