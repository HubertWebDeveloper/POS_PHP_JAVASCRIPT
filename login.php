<?php include("includes/header.php"); ?>
   <?php
    if(isset($_SESSION['LoggedIn'])){
        echo "<script>window.open('admin/index.php?item=index','_self')</script>";
        $_SESSION['warning'] = $_SESSION['LoggedInUser']['name']." Please Logout To Continue.";
    }else{
        $_SESSION['warning'] = "Please Log In To Continue.";
    }
   ?>
<div class="py-5">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow rounded-4">
                    <div class="p-5">
                        <h4 class="text-dark mb-3 text-center">Welcome To POS SYSTEM</h4>
                        <?php alertMessage(); ?>
                        <form action="logCode.php" method="POST">
                            <div class="mb-3">  
                                <label>Email *</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter Email..." required>
                            </div>
                            <div class="mb-3">  
                                <label>Password *</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter Password..." required>
                            </div>
                            <div class="mb-3">
                                <button type="sumbit" name="loginBtn" class="btn btn-primary w-100 text-center mt-4">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>