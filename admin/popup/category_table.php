<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-body mt-2">
            <?php
                $admins = getAll('category');
                $i=0;
                if(mysqli_num_rows($admins) > 0){
            ?>
            <div class="table-responsive">
                <table id="myTable_categ" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                       
                        <?php foreach($admins as $admin) : $i++; $id = $admin['id']; ?>
                        <tr>
                            <td><?= $i ?></td>
                            <td><?= $admin['name']?></td>
                            <td>
                                <?php 
                                if($admin['status'] == '0'){
                                    echo "<label style='color:red'>Not Shown</label>";
                                }else{
                                    echo "<label style='color:green'>Shown</label>";
                                } ?></td>
                            <td>
                                <a href="edit_categ.php?id=<?php echo $id ?>" class="btn btn-primary btn-sm mt-1">
                                   <i class="fa fa-pencil-square"></i>
                                </a>
                                <a href="delete.php?id_categ=<?= $id ?>" class="btn btn-danger btn-sm mt-1">
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
