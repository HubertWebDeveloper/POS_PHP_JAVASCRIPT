<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-body mt-2">
            <form action="InsertCode.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-group mb-3">
                      <select class="form-select" name="name_stock" id="inputGroupSelect01" required>
                        <?php
                        $select = mysqli_query($con, "SELECT * FROM `products`");
                        $count = mysqli_num_rows($select);
                        if($count > 0){
                            while($row = mysqli_fetch_assoc($select)){
                                ?><option value="<?php echo $row['name'] ?>"><?php echo $row['name'] ?></option><?php
                            }
                        }else{
                            ?><option value="">No Data Found.</option><?php
                        }
                        ?>
                      </select>
                      <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Qauntity *</label>
                        <input type="number" name="qty_stock" placeholder="qauntity" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for=""></label>
                        <button type="submit" name="stock" class="btn btn-primary"style="width:100%">Update Stock</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>