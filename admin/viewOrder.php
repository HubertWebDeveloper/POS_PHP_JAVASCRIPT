<?php include("includes/header.php"); ?>

<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $selectOrder = mysqli_query($con, "SELECT * FROM `orders` WHERE id='$id'");
    $orderRow = mysqli_fetch_assoc($selectOrder);
    // fetch customer data
    $cust = $orderRow['customer_id'];
    $selectCust = mysqli_query($con, "SELECT * FROM `customers` WHERE id='$cust'");
    $CustRow = mysqli_fetch_assoc($selectCust);
}else{
    echo "<script>window.open('orderTable.php?item=orderTable','_self')</script>";
    $_SESSION['warning'] = "Select Order To View";
}
?>

<div class="container-fluid px-4">
    <div class="card mt-2 shadow-sm">
        <div class="card-header">
            <a href="orderTable.php?item=orderTable" class="btn btn-danger mx-2 btn-sm float-end">Back</a>
        </div>
        <div class="card-body">
            <div class="card card-body shadow border-1 mb-2">
            <div class="row">
                <div class="col-md-6">
                    <h5>ORDER DETAILS</h5>
                    <label class="mb-1">
                        Invoice No:
                        <span class="fw-bold"><?= $orderRow['invoice_no'] ?></span>
                    </label><br>
                    <label class="mb-1">
                        Tracking No:
                        <span class="fw-bold"><?= $orderRow['tracking_no'] ?></span>
                    </label><br>
                    <label class="mb-1">
                        Payment Mode:
                        <span class="fw-bold"><?= $orderRow['payment_mode'] ?></span>
                    </label><br>
                    <label class="mb-1">
                        Order Status:
                        <span class="fw-bold" style="color:white;background:darkgreen;padding: 0 5px"><?= $orderRow['order_status'] ?></span>
                    </label><br>
                </div>
                <div class="col-md-6">
                    <h5>CUSTOMER DETAILS</h5>
                    <label class="mb-1">
                        Full Name:
                        <span class="fw-bold"><?= $CustRow['name'] ?></span>
                    </label><br>
                    <label class="mb-1">
                        Customer Email:
                        <span class="fw-bold"><?= $CustRow['email'] ?></span>
                    </label><br>
                    <label class="mb-1">
                        Customer Phone:
                        <span class="fw-bold"><?= $CustRow['phone'] ?></span>
                    </label><br>
                    <label class="mb-1">
                        Date:
                        <span class="fw-bold" style="color:white;background:darkorange;padding: 0 5px"><?= date('d M, Y', strtotime($orderRow['order_date'])) ?></span>
                    </label>
                </div>
            </div>
            </div>

        </div>
        <div class="card-body">
           <h5>ORDER ITEMS DETAILS</h5>
           <?php
                $admins = mysqli_query($con, "SELECT * FROM `order_items` WHERE order_id='$id'");
                $i=0;
                if(mysqli_num_rows($admins) > 0){
            ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php 
                        foreach($admins as $admin) : 
                            $i++; 
                            $id = $admin['id']; 
                            $productId = $admin['product_id'];
                            $select = mysqli_query($con, "SELECT* FROM products WHERE id='$productId'");
                            $selectRow = mysqli_fetch_assoc($select);?>
                        <tr>
                            <td><img src="images/<?= $selectRow['image'] ?>" width="35" height="35" style="border-radius:5px"> <?= $selectRow['name'] ?></td>
                            <td><?= $admin['price']?></td>
                            <td><?= $admin['quantity']?></td>
                            <td><?= number_format(($admin['price'] * $admin['quantity']), 0); ?></td>
                        </tr>
                        <?php endforeach; ?> 
                        <tr>
                            <td class="text-end fw-bold">Total Price: </td>
                             <td colspan="2" class="text-end">Customer Bonus: <?php echo "100,00" ?></td>
                            <td colspan="3" class="text-end fw-bold"><?= number_format($orderRow['total_amount'] - 100, 0) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <?php
                }else{
                    ?>
                    <tr>
                      <td colspan="4">No Record Found</td>
                    </tr> 
                    <?php
                }
            ?>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>