<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-body mt-2">
    <form action="" class="mb-2">
        <div class="row">
            <div class="col-md-4">
                <input type="text" class="form-control" placeholder="...">
            </div>
            <div class="col-md-4">
                <select name="" class="form-control">
                    <option value="">Select here...</option>
                </select>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Filter</button>
                <a href="" class="btn btn-danger">Reset</a>
            </div>
        </div>
    </form>
            <?php
                $admins = getAll('products');
                $i=0;
                if(mysqli_num_rows($admins) > 0){
            ?>
            <div class="table-responsive">
                <table id="myTable_prod" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Category ID</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Image</th>
                            <th>Status</th>
                            <th>Created_at</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php foreach($admins as $admin) : $i++; $id = $admin['id']; ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $admin['categ_id']?></td>
                            <td><?= $admin['name']?></td>
                            <td><?= $admin['price']?></td>
                            <td><?= $admin['quantity']?></td>
                            <td><img src="images/<?php echo $admin['image'] ?>" style="width:60px;height:60px;border-radius:10px"></td>
                            <td>
                                <?php 
                                if($admin['status'] == '0'){
                                    echo "<label style='color:red'>Stock Out</label>";
                                }else{
                                    echo "<label style='color:green'>Stock In</label>";
                                } ?></td>
                                <td><?= $admin['created_at']?></td>
                            <td>
                                <a href="edit_prod.php?id=<?php echo $id ?>" class="btn btn-primary btn-sm mt-1">
                                   <i class="fa fa-pencil-square"></i>
                                </a>
                                <a href="delete.php?id_prod=<?= $id ?>" class="btn btn-danger btn-sm mt-1">
                                   <i class="fa fa-trash"></i>
                                </a>
                            </td>
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
