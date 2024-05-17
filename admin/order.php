<?php include("includes/header.php"); ?>
<div class="container-fluid px-4">
    
    <div class="row">
        <div class="col-md-12">
            <div class="card mt-2">
                <div class="card-header clock"style="width:100%;display:flex;justify-content:space-between;align-items:center;
                                                    background: rgb(2,0,36);background: linear-gradient(7deg, rgba(2,0,36,1) 0%, rgba(9,9,121,1) 0%, rgba(0,212,255,1) 100%);color:white">
                    <p style="font-weight:bold;margin-bottom:-5px">Create New Order</p>
                    <p id="date"style="font-weight:bold;margin-bottom:-5px"></p>
                    <p id="time"style="font-weight:bold;margin-bottom:-5px"></p>
                </div>
                <div class="card-body">
                    <?php alertMessage(); ?>
                    <form action="OrderCode.php" method="POST" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-5 mb-3">
                            <label for="">Select Product *</label>
                            <select class="form-select mySelect2" name="product_id" id="inputGroupSelect01" required>
                                <option value="">---select Product---</option>
                                <?php
                                $product = getAll('products');
                                if($product){
                                    if(mysqli_num_rows($product) > 0){
                                        foreach($product as $prod){
                                            ?><option value="<?php echo $prod['id'] ?>"><?php echo $prod['name'] ?></option><?php
                                        }
                                    }
                                }else{
                                    ?><option value="">No Data Found.</option><?php
                                }
                                ?>
                            </select>
                            </div>
                            <div class="col-md-5 mb-3">
                                <label for="">Qauntity</label>
                                <input type="number" name="order_qty" value="1" required class="form-control">
                            </div>
                            <div class="col-md-2 mb-3">
                                <label></label>
                                <button type="submit" name="filter" class="btn btn-primary"style="width:100%">Filter</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body" id="productArea">
                    <div class="table-responsive" id="productContent" style="margin-bottom:-45px">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Product Name</th>
                                    <th>Price</th>
                                    <th>Qauntity</th>
                                    <th>Total Price</th>
                                    <th>Remove</th>
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
                                        <td>
                                            <div class="input-group qtyBox">
                                                <input type="hidden" class="prodId" value="<?= $item['product_id'] ?>">
                                                <input type="hidden" class="prodQty" value="<?php echo $row['quantity'] ?>">

                                                <button class="input-group-text decrement">-</button>
                                                <input type="number" value="<?= $item['quantity'] ?>" class="qty quantityInput">
                                                <button class="input-group-text increment">+</button>

                                            </div>
                                        </td>
                                        <td><?= number_format(($item['price'] * $item['quantity']), 0); ?></td>
                                        <td>
                                            <a href="delete_cardOrder.php?index=<?= $key ?>" class="btn btn-danger">Remove</a>
                                        </td>
                                      </tr>
                                    <?php
                                    endforeach;
                                  }
                                ?>
                                <tr>
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
                                   <td clospan="2"><button type="submit" class="btn btn-info" id="proceedToBonus">Bonus</button></td>
                               </tr>
                               <tr>
                                   <td colspan="4" align="end" style="font-weight: bold">Grand Total: </td>
                                   <td clospan="1" style="font-weight:bold"><?php if(isset($_SESSION['productItems']) && $sessionProdcuts != ""){echo number_format($total - 100,0);}else{echo "00,0";} ?></td>
                               </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <label>Select Payment Mode</label>
                                <select id="payment_mode" class="form-control">
                                    <option value="">-- Select Pyament --</option>
                                    <option value="cash_payment">Cash Payment</option>
                                    <option value="bank_payment">Bank Payment</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label>Enter Customer Phone Number</label>
                                <input type="phone" id="cphone" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <br>
                                <button type="submit" class="btn btn-warning w-100 proceedToPlace">Proceed to place order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ------- customer add record modal ----------- -->
    <div class="modal" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Add Customer</h5>
        </div>
        <div class="modal-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name *</label>
                        <input type="text" id="c_name" placeholder="Name" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email *</label>
                        <input type="email" id="c_email" placeholder="Email" class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone *</label>
                        <input type="number" id="c_phone" placeholder="Phone" required class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Is Active</label>
                        <input type="checkbox" name="is_ban" style="width:30px;height:20px">
                    </div>
                </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary saveCustomer">Save</button>
        </div>
        </div>
    </div>
    </div>
    <!-- ------- customer Bonus add --------- -->
</div>
<?php include("includes/footer.php"); ?>