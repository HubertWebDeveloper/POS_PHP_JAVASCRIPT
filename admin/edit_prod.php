<?php include("includes/header.php"); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header" style="background:darkgreen;color:white">
            Edit Product
            <a href="admins.php" class="btn btn-danger float-end">Back</a>
        </div>
        <div class="card-body">
            <?php //message(); ?>
            <form action="InsertCode.php" method="POST" enctype="multipart/form-data">
                <?php
                if(isset($_GET['id'])){
                    $adminId = $_GET['id'];
                    $data = getById('products', $adminId);
                    if($data){
                        if($data['status'] == 200){
                            ?>
                <div class="row">
                    <input type="hidden" name="id_prod_up" value="<?= $data['data']['id']; ?>">
                    <div class="input-group mb-3">
                      <select class="form-select" name="categ_id" id="inputGroupSelect01">
                        <?php
                        $select = mysqli_query($con, "SELECT * FROM `category`");
                        $count = mysqli_num_rows($select);
                        if($count > 0){
                            while($row = mysqli_fetch_assoc($select)){
                                ?><option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option><?php
                            }
                        }else{
                            ?><option value="">No Data Found.</option><?php
                        }
                        ?>
                      </select>
                      <label class="input-group-text" for="inputGroupSelect01">Options</label>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" value="<?= $data['data']['name'] ?>" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Price *</label>
                        <input type="number" name="price" value="<?= $data['data']['price'] ?>" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Qauntity *</label>
                        <input type="number" name="qty" value="<?= $data['data']['quantity'] ?>" required class="form-control" readonly>
                    </div>
                    <div class="col-md-2 mb-3">
                      <img src="images/<?= $data['data']['image'] ?>" style="width:70px;height:70px;border-radius:10px">
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="formFile" class="form-label">Upload New Image</label>
                      <input class="form-control" type="file" name="image_up" id="formFile">
                    </div>
                    <div class="col-md-12 mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                      <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"><?= $data['data']['description'] ?></textarea>
                    </div>
                    <div class="col-md-3 mb-3" style="display:none">
                        <label for="">Is Ban</label>
                        <input type="checkbox" name="is_ban" <?= $data['data']['status'] == true ? 'checked':'' ?> style="width:30px;height:20px">
                    </div>
                    <div class="col-md-12 mb-3">
                        <button type="submit" name="updateProd" class="btn btn-primary"style="width:100%">Update</button>
                    </div>
                </div>
                <?php
                        }else{
                            echo '<h5>'.$data['message'].'</h5>';
                        }
                    }else{
                        echo 'Something Went Wrong!';
                        return false;
                    }
                }else{
                    echo '<h5>No Id given in params.</h5>';
                    return false;
                }
                ?>
            </form>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>