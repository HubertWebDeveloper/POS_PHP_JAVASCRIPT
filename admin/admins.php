<?php include("includes/header.php"); ?>

<div class="container-fluid px-4">
    <ol class="breadcrumb mb-4 mt-4">
        <li class="breadcrumb-item active"><i class="fa fa-long-arrow-right"></i> Users & Stock Management</li>
    </ol>
    <?php alertMessage(); ?>
   <!-- -------------------- admins page ----------------- -->
   <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="admins" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Admins</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!--
              * display the multiple tables
              * display form
              -->

              <?php include("tabs/admin_tab.php") ?>
              <!-- ----------------end here -------------- -->
          </div>
          <div class="modal-footer">
            <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button> -->
          </div>
        </div>
      </div>
    </div>
     <!-- -------------------- Customers page ----------------- -->
     <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="customers" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Customers</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!--
              * display the multiple tables
              * display form
              -->

              <?php include("tabs/customer_tab.php") ?>
              <!-- ----------------end here -------------- -->
          </div>
          <div class="modal-footer">
            <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- -------------------- Customers page ----------------- -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="category" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-ml">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Category</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!--
              * display the multiple tables
              * display form
              -->

              <?php include("tabs/category_tab.php") ?>
              <!-- ----------------end here -------------- -->
          </div>
          <div class="modal-footer">
            <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- -------------------- Customers page ----------------- -->
    <div class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" id="products" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Products</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <!--
              * display the multiple tables
              * display form
              -->

              <?php include("tabs/product_tab.php") ?>
              <!-- ----------------end here -------------- -->
          </div>
          <div class="modal-footer">
            <!-- <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Open second modal</button> -->
          </div>
        </div>
      </div>
    </div>
    <!-- -------------------------- edit form here ------------------------- -->
    <?php //include("popup/adminEdit.php"); ?>
    
  </ol>
<button class="btn me-2 mt-2" data-bs-target="#admins" data-bs-toggle="modal">Admins</button>
<button class="btn me-2 mt-2" data-bs-target="#customers" data-bs-toggle="modal">Customers</button>
<button class="btn me-2 mt-2" data-bs-target="#category" data-bs-toggle="modal">Prod Category</button>
<button class="btn me-2 mt-2" data-bs-target="#products" data-bs-toggle="modal">Products</button>

<!-- ----------------------- display product table here ------------------- -->
<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-body mt-2">
            <?php
                $admins = getAll('products');
                $i=0;
                if(mysqli_num_rows($admins) > 0){
            ?>
            <div class="table-responsive">
                <table id="myTable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                          <th>ID</th>
                          <th>Categ_id</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th>Price</th>
                          <th>Qauntities</th>
                          <th>Action</th>
                          <th>Created_at</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php foreach($admins as $admin) : $i++; $id = $admin['id']; ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $admin['categ_id']?></td>
                            <td><?= $admin['name']?></td>
                            <td><img src="images/<?php echo $admin['image'] ?>" style="width:60px;height:60px;border-radius:10px"></td>
                            <td><?= $admin['price']?></td>
                            <td><?= $admin['quantity']?></td>
                            <td>
                                <?php 
                                if($admin['status'] == '0'){
                                    echo "<label style='color:red'>Stock Out</label>";
                                    }else{
                                        echo "<label style='color:green'>Stock In</label>";
                                    } ?></td>
                            <td><?= $admin['created_at']?></td>
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