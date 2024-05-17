<div class="container-fluid px-4">
    <div class="card mt-4 shadow-sm">
        <div class="card-body mt-2">
            <form action="InsertCode.php" method="POST">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="">Name *</label>
                        <input type="text" name="name" placeholder="Name" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Email *</label>
                        <input type="email" name="email" placeholder="Email" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Phone *</label>
                        <input type="number" name="phone" placeholder="Phone" required class="form-control">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="">Password *</label>
                        <input type="password" name="password" placeholder="Password" required class="form-control">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="">Is Ban</label>
                        <input type="checkbox" name="is_ban" style="width:30px;height:20px">
                    </div>
                    <div class="col-md-9 mb-3">
                        <button type="submit" name="saveAdmin" class="btn btn-primary"style="width:100%">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>