<?php include("includes/header.php"); ?>
<?php if(!isset($_SESSION['productItems'])){
    echo "<script>window.open('order.php','_self')</script>";
}; ?>

<div class="modal" id="orderSuccessModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                <div class="mb-3 p-4">
                    <h5 id="orderPlaceSuccessMessage"></h5>
                </div>
                <a href="order.php" class="btn btn-danger">Close</a>
                <button type="button" class="btn btn-primary">Print</button>
                <button type="button" class="btn btn-warning">Download PDF</button>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid px-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header">
                <div class="card-header clock"style="width:100%;display:flex;justify-content:space-between;align-items:center;
                                                    background: rgb(2,0,36);background: linear-gradient(7deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(0,212,255,1) 100%);color:white">
                    <p style="font-weight:bold;margin-bottom:-5px">Order Summary</p>
                    <p id="date"style="font-weight:bold;margin-bottom:-5px"></p>
                    <p id="time"style="font-weight:bold;margin-bottom:-5px"></p>
                    <a href="order.php?item=order" class="btn btn-info float-end">Back to Order</a>
                </div>
                    <div class="card-body">
                        <div id="myBillingArea">
                            <div class="table-responsive mb-1">
                                <?php
                                    if(isset($_SESSION['cphone'])){
                                        $phone = validate($_SESSION['cphone']);
                                        $invoiceNo = validate($_SESSION['invoice_no']);

                                        $customerQuery = mysqli_query($con, "SELECT * FROM customers WHERE phone='$phone' LIMIT 1");
                                        if($customerQuery){
                                            if(mysqli_num_rows($customerQuery) > 0){
                                                $customerRow = mysqli_fetch_assoc($customerQuery);
                                                ?>
                                                    <table style="width:100%;margin-bottom:20px">
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align:center" colspan="2">
                                                                    <h4 style="font-size:23px;line-height: 30px;margin:2px;padding:0">Company Address</h4>
                                                                    <p style="font-size:16px;line-height: 24px;margin:2px;padding:0">#address, 3rd cross, kigali, rwanda.</p>
                                                                    <p style="font-size:16px;line-height: 24px;margin:2px;padding:0">P.O BOX or website.</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <h5 style="font-size:20px;line-height: 30px;margin:2px;padding:0">Customer Details</h5>
                                                                    <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Customer Name: <?php echo $customerRow['name'] ?></p>
                                                                    <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Customer Phone No: <?php echo $customerRow['phone'] ?></p>
                                                                    <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Customer Email Id: <?php echo $customerRow['email'] ?></p>
                                                                </td>
                                                                    <td align="end">
                                                                        <h5 style="font-size:20px;line-height: 30px;margin:2px;padding:0">Invoice Details</h5>
                                                                        <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Invoice No: <?php echo $invoiceNo ?></p>
                                                                        <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Invoice Date: <?php echo date('d M Y') ?></p>
                                                                        <p style="font-size:14px;line-height: 20px;margin:2px;padding:0">Address: Main road, Kigali, Rwanda</p>
                                                                    </td>
                                                                </tr>
                                                        </tbody>
                                                    </table>
                                                <?php
                                            }else{
                                                echo "Something Went Wrong!";
                                                return;
                                            }
                                        }
                                    }else{
                                        echo "No Customer Found, Please add Customer.";
                                    }
                                ?>
                                <?php
                                  if(isset($_SESSION['productItems'])){
                                    $productList = $_SESSION['productItems'];

                                    ?>
                                       <div class="table-responsive mb-1">
                                            <table style="width:100%" cellpadding="5">
                                                <thead>
                                                    <tr>
                                                        <th align="start" style="border-bottom:1px solid #ccc" width="5%">ID</th>
                                                        <th align="start" style="border-bottom:1px solid #ccc">Product Name</th>
                                                        <th align="start" style="border-bottom:1px solid #ccc" width="10%">Price</th>
                                                        <th align="start" style="border-bottom:1px solid #ccc" width="10%">Quantity</th>
                                                        <th align="start" style="border-bottom:1px solid #ccc" width="15%">Total Price</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                    if(isset($_SESSION['productItems'])){
                                                        $sessionProdcuts = $_SESSION['productItems'];
                                                        $i=0;$total=0;
                                                        foreach($sessionProdcuts as $key => $item) :
                                                            $i++;
                                                            $id = $item['product_id'];
                                                            $total += ($item['price'] * $item['quantity']);
                                                            //fetch product quantity
                                                            $Check = mysqli_query($con, "SELECT * FROM `products` WHERE id='$id'");
                                                            $row = mysqli_fetch_assoc($Check);
                                                        ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?= $item['name']; ?></td>
                                                            <td><?= $item['price']; ?></td>
                                                            <td><?= $item['quantity']; ?></td>
                                                            <td><?= number_format(($item['price'] * $item['quantity']), 0); ?></td>
                                                        </tr>
                                                        <?php
                                                        endforeach;
                                                    }
                                                    ?>
                                                    <tr style="border-top: 2px solid grey">
                                                        <td colspan="4" align="end" style="font-weight: bold">Sub Total: </td>
                                                        <td clospan="1" style="font-weight:bold"><?php if(isset($_SESSION['productItems']) && $sessionProdcuts != ""){echo number_format($total,0);}else{ echo "00,0";} ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="end" style="font-weight: bold">Tax (18%): </td>
                                                        <td clospan="1" style="font-weight:bold">00</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="end" style="font-weight: bold">Customer redeem: </td>
                                                        <td clospan="1" style="font-weight:bold"><?php if(isset($_SESSION['productItems']) && $sessionProdcuts != ""){echo number_format(100,0);}else{echo "00";} ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4" align="end" style="font-weight: bold">Grand Total: </td>
                                                        <td clospan="1" style="font-weight:bold"><?php if(isset($_SESSION['productItems']) && $sessionProdcuts != ""){echo number_format($total - 100,0);}else{echo "00,0";} ?></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    <?php
                                  }
                                ?>
                            </div>
                        </div>
                        <?php if(isset($_SESSION['productItems'])) : ?>
                        <div class="mt-3 text-end">
                            <button type="submit" class="btn btn-primary px-4 mx-1" id="SaveOrder">Save Order</button>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>