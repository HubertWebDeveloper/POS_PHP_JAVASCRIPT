<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-body mt-2">
            <form action="InsertCode.php" method="POST" enctype="multipart/form-data">
                <div class="row">
                    <div class="input-group mb-3">
                      <select class="form-select" name="categ_id" id="inputGroupSelect01" required>
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
                        <input type="text" name="name" placeholder="Name" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Price *</label>
                        <input type="number" name="price" placeholder="price" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Qauntity *</label>
                        <input type="number" name="qty" placeholder="qauntity" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="formFile" class="form-label">Upload Product Image</label>
                      <input class="form-control" type="file" name="image" id="formFile">
                    </div>
                    <div class="col-md-12 mb-3">
                      <label for="exampleFormControlTextarea1" class="form-label">Description</label>
                      <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Is Ban</label>
                        <input type="checkbox" name="is_ban" style="width:30px;height:20px">
                    </div>
                    <div class="col-md-9 mb-3">
                        <button type="submit" name="saveProd" class="btn btn-primary"style="width:100%">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>