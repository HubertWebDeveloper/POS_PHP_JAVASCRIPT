<nav class="navbar navbar-expand-lg bg-white shadow">
  <div class="container">
    <a class="navbar-brand" href="#">POS SYSTEM</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <?php if(isset($_SESSION['LoggedIn'])) : ?>
        <li class="nav-item">
          <a class="btn btn-danger" href="logout.php">LogOut</a>
        </li>
        <?php else: ?>
          <li class="nav-item">
          <a class="btn btn-primary" href="login.php">Login</a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>