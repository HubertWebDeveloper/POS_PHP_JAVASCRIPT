<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-body mt-2">
            <?php
                $admins = getAll('customers');
                $i=0;
                if(mysqli_num_rows($admins) > 0){
            ?>
            <div class="table-responsive">
                <table id="myTable_customer" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php foreach($admins as $admin) : $i++; $id = $admin['id']; ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $admin['name']?></td>
                            <td><?= $admin['email']?></td>
                            <td><?= $admin['phone']?></td>
                            <td>
                                <?php 
                                if($admin['active'] == '0'){
                                    echo "<label style='color:red'>No Active</label>";
                                }else{
                                    echo "<label style='color:green'>Active</label>";
                                } ?></td>
                            <td>
                                <a href="edit_customer.php?id=<?php echo $id ?>" class="btn btn-primary btn-sm mt-1">
                                   <i class="fa fa-pencil-square"></i>
                                </a>
                                <a href="delete.php?id_cust=<?= $id ?>" class="btn btn-danger btn-sm mt-1">
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
