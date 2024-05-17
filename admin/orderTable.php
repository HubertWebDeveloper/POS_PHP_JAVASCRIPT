<?php include("includes/header.php"); ?>
<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-body mt-2">
            <?php
                $admins = getAll('orders');
                $i=0;
                if(mysqli_num_rows($admins) > 0){
            ?>
            <?php alertMessage(); ?>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th></th>
                            <th>ID</th>
                            <th>Customer_ID</th>
                            <th>Tracking_No</th>
                            <th>Invoice_No</th>
                            <th>Total_Amount</th>
                            <th>Order_Date</th>
                            <th>Order_Status</th>
                            <th>Payment_Mode</th>
                            <th>Order_Placed_By</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php foreach($admins as $admin) : $i++; $id = $admin['id']; ?>
                        <tr>
                            <td style="display:flex;gap:5px">
                                <a href="viewOrder.php?item=orderTable&&id=<?php echo $admin['id'] ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                <a href="printOrder.php?item=orderTable&&id=<?php echo $admin['id'] ?>" class="btn btn-success"><i class="fa fa-print"></i></a>
                            </td>
                            <td><?= $i ?></td>
                            <td><?= $admin['customer_id']?></td>
                            <td><?= $admin['tracking_no']?></td>
                            <td><?= $admin['invoice_no']?></td>
                            <td><?= $admin['total_amount']?></td>
                            <td><?= date('d M, Y', strtotime($admin['order_date']))?></td>
                            <td><?= $admin['order_status']?></td>
                            <td><?= $admin['payment_mode']?></td>
                            <td><?= $admin['order_placed_by']?></td>
                        </tr>
                        <?php endforeach; ?> 
                        
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