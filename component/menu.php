<!-- menu.php -->
<header class="py-3 mb-3">
    <div class="container-fluid d-flex justify-content-between align-items-center">
        <!-- Logo -->
        <div>
            <a href="./main.php">
                <img src="./img/logo.png" alt="Logo" width="100px" class="img-fluid">
            </a>
        </div>

        <!-- Search Form -->
        <div class="d-flex w-50 justify-content-center align-items-center">
            <form class="w-75 me-3" role="search" action="show_product.php" method="GET">
                <div class="input-group">
                    <input type="search" class="form-control" name="search" placeholder="Search..." aria-label="Search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                    <button class="btn btn-outline-secondary" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>

        </div>

        <!-- User Controls -->
        <div class="d-flex align-items-center">
            <!-- Cart Icon -->
            <a href="cart.php" class="btn btn-outline-dark me-3">
                <i class="bi bi-basket2"></i>
            </a>

            <!-- Display Username -->
            <span class="me-3">
                <?php
                if (isset($_SESSION["cus_username"])) {
                    echo "" . $_SESSION["cus_username"];
                } else {
                    echo "Guest";
                }
                ?>
            </span>

            <!-- User Dropdown -->
            <div class="dropdown">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="./img/70525153720210602_090639.png" alt="User" width="32" height="32" class="rounded-circle">
                </a>
                <ul class="dropdown-menu dropdown-menu-end text-small" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="account_settings.php">ตั้งค่าบัญชี</a></li>
                    <li><a class="dropdown-item" href="past.php">ประวัติคำสั่งซื้อ</a></li>
                    <li><a class="dropdown-item" href="logout.php">Sign out</a></li>
                </ul>
            </div>
        </div>
    </div>
</header>