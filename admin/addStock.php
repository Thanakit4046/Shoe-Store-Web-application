<?php
include 'condb.php';
$ids = $_GET['id']; // เปลี่ยนจาก '$id' เป็น 'id' เพื่อให้เข้าถึงค่าที่ถูกต้อง
$sql = "SELECT * FROM product WHERE pro_id='$ids'";
$hand = mysqli_query($conn, $sql);
$pro = mysqli_fetch_array($hand); // ใช้ตัวแปร $pro แทน $row
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>เพิ่มสต็อกสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('./componrnt/menu1.php'); ?>
    <div id="layoutSidenav_content">
        <div class="container">
        <br>
            <div class="alert alert-success" role="alert">
            เพิ่มสต็อกสินค้า
            </div>
            <form name="form1" method="post" action="up_Stock.php">
                <div class="mb-3 mt-3">
                    <label for="">รหัสสินค้า :</label>
                    <input type="text" name="pid" class="form-control" readonly value="<?= $pro['pro_id'] ?>"> <!-- ใช้ $pro แทน $row -->
                </div>
                <div class="mb-3">
                    <label for="">ชื่อสินค้า :</label>
                    <input type="text" name="pname" class="form-control" readonly value="<?= $pro['pro_name'] ?>"> <!-- ใช้ $pro แทน $row -->
                </div>
                <div class="mb-3">
                    <label for="">เพิ่มจำนวนสินค้า :</label>
                    <input type="text" name="pnum" class="form-control" required>
                </div>
                <input type="submit" name="submit" class="btn btn-success" value="Submit">
                <a href="" class="btn btn-danger">Cancel</a>
            </form>
        </div>
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