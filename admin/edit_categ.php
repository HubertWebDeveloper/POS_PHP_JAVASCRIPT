<?php include("includes/header.php"); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header" style="background:darkgreen;color:white">
            Update Category
            <a href="admins.php" class="btn btn-danger float-end">Back</a>
        </div>
        <div class="card-body">
            <?php //message(); ?>
            <form action="InsertCode.php" method="POST" enctype="multipart/form-data">
                <?php
                if(isset($_GET['id'])){
                    $adminId = $_GET['id'];
                    $data = getById('category', $adminId);
                    if($data){
                        if($data['status'] == 200){
                            ?>
                <div class="row">
                    <input type="hidden" name="id_categ_up" value="<?= $data['data']['id']; ?>">
                    <div class="col-md-6 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name_categ" value="<?= $data['data']['name'] ?>" required class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Is Ban</label>
                        <input type="checkbox" name="is_ban_categ" <?= $data['data']['status'] == true ? 'checked':'' ?> style="width:30px;height:20px">
                    </div>
                    <div class="col-md-9 mb-3">
                        <button type="submit" name="updateCateg" class="btn btn-primary"style="width:100%">Update</button>
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