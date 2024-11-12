<header class="py-3 mb-3">
  <div class="container-fluid d-flex justify-content-between align-items-center">
    <!-- Logo -->
    <div class="dropdown">
      <a href="./index.php"><img src="./img/logo.png" alt="Logo" width="100px"></a>
    </div>

    <!-- Search Form -->
    <div class="d-flex w-50 justify-content-center align-items-center">
      <form class="w-75 me-3" role="search">
        <div class="input-group">
          <input type="search" class="form-control" placeholder="Search..." aria-label="Search">
          <button class="btn btn-outline-secondary" type="submit">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </form>
    </div>

    <!-- Login and Sign-up Buttons -->
    <div class="d-flex" id="navbarSupportedContent">
      <?php
      if ($member_id != '') {
      } else {
      ?>
        <div class="btn-group">
          <a class="btn btn-outline-primary me-2" href="./admin/login.php" role="button">Login</a>
        </div>
      <?php } ?>
      <?php
      if ($member_id != '') {
      ?>
        <li class="nav-item">
          <a class="btn btn-Light" href="logout.php" role="button" onclick="return confirm('คุณต้องการออกจากระบบหรือไม่ ?')">ออกจากระบบ</a>
        </li>
      <?php } ?>
      &nbsp;
      <div class="btn-group">
        <a class="btn btn-primary" href="./admin/register.php" role="button">Sign-up</a>
      </div>
      &nbsp;
    </div>
  </div>
</header>