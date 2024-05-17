<?php include("includes/header.php"); ?>

<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-header" style="background:darkgreen;color:white">
            Edit Admin
            <a href="admins.php" class="btn btn-danger float-end">Back</a>
        </div>
        <div class="card-body">
            <form action="InsertCode.php" method="POST">
                <?php
                if(isset($_GET['id'])){
                    $adminId = $_GET['id'];
                    $data = getById('admins', $adminId);
                    if($data){
                        if($data['status'] == 200){
                            ?>
                <div class="row">
                <input type="hidden" name="id" value="<?= $data['data']['id']; ?>">
                    <div class="col-md-6 mb-3">
                        <label for="">Name</label>
                        <input type="text" name="name" value="<?= $data['data']['name']; ?>" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email</label>
                        <input type="email" name="email" value="<?= $data['data']['email']; ?>" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone</label>
                        <input type="number" name="phone" value="<?= $data['data']['phone']; ?>" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Password</label>
                        <input type="text" name="password" value="<?= $data['data']['password']; ?>" required class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Is Ban</label>
                        <input type="checkbox" name="is_ban" <?= $data['data']['active'] == true ? 'checked':'' ?> style="width:30px;height:20px">
                    </div>
                    <div class="col-md-9 mb-3">
                        <button type="submit" name="updateAdmin" class="btn btn-primary"style="width:100%">Update</button>
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