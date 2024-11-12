<?php
session_start();
include 'condb.php';
if (!isset($_SESSION["emp_userid"])) {
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>สินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('./componrnt/menu1.php'); ?>
    <div id="layoutSidenav_content">
        <main>
            <br>
            <div class="container-fluid px-4"> 
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">สินค้า</h2>
                    <a href="addproduct.php" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill"></i> เพิ่มสินค้า
                    </a>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        สินค้าทั้งหมด
                    </div>
                    <br>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>รูปภาพ</th>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ประเภทสินค้า</th>
                                    <th>ราคา</th>
                                    <th>จำนวน</th>
                                    <th>เพิ่มสต็อกสินค้า</th>
                                    <th>แก้ไข</th>
                                    <th>ลบสินค้า</th> <!-- เพิ่มคอลัมน์นี้ -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT * FROM product p,type t WHERE p.type_id=t.type_id";
                                $hand = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($hand)) {
                                ?>
                                    <tr>
                                        <td><img src="../image/<?= $row['image'] ?>" alt="" width="100" height="120"></td>
                                        <td><?= $row['pro_id'] ?></td>
                                        <td><?= $row['pro_name'] ?></td>
                                        <td><?= $row['type_name'] ?></td>
                                        <td><?= $row['price'] ?></td>
                                        <td><?= $row['amount'] ?></td>
                                        <td><a href="addStock.php?id=<?= $row['pro_id'] ?>" class="btn btn-success"><i class="bi bi-plus-circle-fill"></i> เพิ่มสต็อก</a></td>
                                        <td><a href="edit_product.php?id=<?= $row['pro_id'] ?>" class="btn btn-warning">แก้ไข</a></td> <!-- ปุ่มแก้ไขสินค้า -->

                                        <td><a href="delete_product.php?id=<?= $row['pro_id'] ?>" class="btn btn-danger" onclick="return confirm('คุณต้องการลบสินค้านี้หรือไม่?');"><i class='bi bi-trash'></i>ลบ</a></td> <!-- ปุ่มยกเลิกสินค้า -->
                                    </tr>
                                <?php
                                }
                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
<script src="assets/demo/chart-area-demo.js"></script>
<script src="assets/demo/chart-bar-demo.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>