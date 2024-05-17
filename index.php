<?php include("includes/header.php"); ?>
<?php
    if(isset($_SESSION['LoggedIn'])){
        echo "<script>window.open('admin/index.php','_self')</script>";
        $_SESSION['warning'] = $_SESSION['LoggedInUser']['name']." Please Logout To Continue.";
    }
   ?>
<div class="py-5">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h3>POS Sytems display</h3>
                <a href="login.php" class="btn btn-primary mt-4">Login</a>
            </div>
        </div>
    </div>
</div>

<?php include("includes/footer.php"); ?>