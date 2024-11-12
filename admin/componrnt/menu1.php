<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <!-- Navbar Brand-->
    <a class="navbar-brand ps-3" href="admin.php">KDM Admin</a>
    <!-- Sidebar Toggle-->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
 
    </form>
 

    <!-- Navbar-->
    <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
            </ul>
        </li>
    </ul>
</nav>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link" href="admin.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Dashboard
                    </a>
                    <div class="sb-sidenav-menu-heading">สมาชิก</div>
                    <a class="nav-link" href="employee.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-person-circle"></i></div>
                        การจัดการผู้ใช้งาน
                    </a>
                    <div class="sb-sidenav-menu-heading">สินค้า</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="bi bi-box-seam-fill"></i></div>
                        สินค้า
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="product.php">การจัดการสินค้า</a>
                            <a class="nav-link" href="roduct_type_list.php">ประเภทสินค้า</a>
                        </nav>
                    </div>
                    <div class="sb-sidenav-menu-heading">อัปเดตคำสั่งซื้อ</div>
                    <a class="nav-link" href="report_order.php">
                        <div class="sb-nav-link-icon"><i class="bi bi-boxes"></i></div>
                        การสั่งซื้อสินค้า
                    </a>
                    <div class="sb-sidenav-menu-heading">รายได้</div>
                    <a class="nav-link" href="report_sale.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        รายงานการขาย
                    </a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">Logged in as:</div>
                Start Bootstrap
            </div>
        </nav>
    </div>