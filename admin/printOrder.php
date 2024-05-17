<?php include("includes/header.php"); ?>

<?php
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $selectOrder = mysqli_query($con, "SELECT * FROM `orders` WHERE id='$id'");
        $orderRow = mysqli_fetch_assoc($selectOrder);
    }
?>
<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header">
                    <a href="orderTable.php?item=orderTable" style="margin-right:5px" class="btn btn-danger float-end">Back to Orders</a>
                    <button onclick="myPrintPDF('<?= $orderRow['invoice_no'] ?>')" style="margin-right:5px" class="btn btn-warning float-end">Download PDF</button>
                    <button onclick="myPrint()" style="margin-right:5px" class="btn btn-success float-end">Print</button>
                </div>
                </div>
                    <div class="card-body">
                        <div id="myBillingArea">
                            <div class="table-responsive mb-4">
                                <?php
                                    if(isset($_GET['id'])){
                                        $id = $_GET['id'];
                                        $selectOrder = mysqli_query($con, "SELECT * FROM `orders` WHERE id='$id'");
                                        $orderRow = mysqli_fetch_assoc($selectOrder);
                                        // fetch customer data
                                        $cust = $orderRow['customer_id'];
                                        $selectCust = mysqli_query($con, "SELECT * FROM `customers` WHERE id='$cust'");
                                        $CustRow = mysqli_fetch_assoc($selectCust);
                                    }
                                    ?>
                                    <table style="width:100%;margin-bottom:20px">
                                        <tbody>
                                            <tr>
                                                <td style="text-align:center" colspan="2">
                                                    <h4 style="font-size:23px;line-height: 30px;margin:2px;padding:0">Company Address</h4>
                                                    <p style="font-size:16px;line-height: 24px;margin:2px;padding:0">#address, 3rd cross, kigali, rwanda.</p>
                                                    <p style="font-size:16px;line-height: 24px;margin:2px;padding:0">P.O BOX or website.</p>
                                                    <p style="font-weight:bold;font-size:16px;line-height: 24px;margin:2px;padding:0"><?= date('d M, Y', strtotime($orderRow['order_date'])) ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h5 style="font-size:20px;line-height: 30px;margin:2px;padding:0">Customer Details</h5>
                                                    <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Customer Name: <?= $CustRow['name'] ?></p>
                                                    <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Customer Email Id: <?= $CustRow['email'] ?></p>
                                                    <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Customer Phone No: <?= $CustRow['phone'] ?></p>
                                                </td>
                                                    <td align="end">
                                                        <h5 style="font-size:20px;line-height: 30px;margin:2px;padding:0">Invoice Details</h5>
                                                        <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Invoice No: <?= $orderRow['invoice_no'] ?></p>
                                                        <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Payment Mode: <?= $orderRow['payment_mode'] ?></p>
                                                        <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Order Status: <?= $orderRow['order_status'] ?></p>
                                                    </td>
                                                </tr>
                                        </tbody>
                                    </table>
                                    <?php
                                        $admins = mysqli_query($con, "SELECT * FROM `order_items` WHERE order_id='$id'");
                                        $selTotal = mysqli_query($con, "SELECT * FROM `orders` WHERE id='$id'");
                                        $toatlRow = mysqli_fetch_assoc($selTotal);
                                        $i=0;
                                        if(mysqli_num_rows($admins) > 0){
                                    ?>
                                    <table class="table" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th style="">ID</th>
                                                <th style="">Product Name</th>
                                                <th style="">Price</th>
                                                <th style="">Quantity</th>
                                                <th style="">Total Price</th>
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
                                                <td style="text-align:center"><?php echo $i; ?></td>
                                                <td style="text-align:center"><?= $selectRow['name'] ?></td>
                                                <td style="text-align:center"><?= $admin['price']?></td>
                                                <td style="text-align:center"><?= $admin['quantity']?></td>
                                                <td style="text-align:center"><?= number_format(($admin['price'] * $admin['quantity']), 0); ?></td>
                                            </tr>
                                            <?php endforeach; ?> 
                                            <tr style="border-top: 2px solid grey">
                                                <td colspan="4" align="end" style="font-weight: bold">Sub Total: </td>
                                                <td clospan="1" style="font-weight:bold;text-align:center"><?= number_format(($toatlRow['total_amount']), 0); ?></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="end" style="font-weight: bold">Customer redeem: </td>
                                                <td clospan="1" style="font-weight:bold;text-align:center">00,00</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" align="end" style="font-weight: bold">Grand Total: </td>
                                                <td clospan="1" style="font-weight:bold;text-align:center"><?= number_format(($toatlRow['total_amount']), 0); ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>