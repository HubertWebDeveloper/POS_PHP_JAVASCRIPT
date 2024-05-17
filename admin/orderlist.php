<?php include("includes/header.php"); ?>
<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-body mt-2">
            <?php
                $admins = getAll('order_items');
                $i=0;
                if(mysqli_num_rows($admins) > 0){
            ?>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Order ID</th>
                            <th>Product ID</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php foreach($admins as $admin) : $i++; $id = $admin['id']; ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $admin['order_id']?></td>
                            <td><?= $admin['product_id']?></td>
                            <td><?= $admin['price']?></td>
                            <td><?= $admin['quantity']?></td>
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