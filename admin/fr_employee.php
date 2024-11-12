<?php
session_start();
include 'condb.php';
if (!isset($_SESSION["emp_userid"])) { // ลบ ; ออก
    header("Location: login.php");
    exit(); // หยุดการทำงานของสคริปต์หลังจาก redirect
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
    <title>Dashboard - SB Admin</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('./componrnt/menu1.php'); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-3">
                <br>
                <div class="alert alert-primary" role="alert">
                    <h1>เพิ่มสมาชิก</h1>
                </div>
                <!-- ฟอร์มการลงทะเบียนสมาชิก -->
                <form method="POST" action="insert_register.php" enctype="multipart/form-data">
                    <br>
                    ชื่อ <input type="text" class="form-control" name="name" required>
                    นามสกุล <input type="text" class="form-control" name="lastname" required>
                    เบอร์โทร <input type="text" class="form-control" name="telephone" required>
                    Username <input type="text" class="form-control" name="username" required>
                    Password <input type="password" class="form-control" name="password" required>
                    <br>
                    <input type="submit" class="btn btn-primary" name="submit" value="บันทึก">
                    <input type="reset" class="btn btn-secondary" name="cancel" value="ยกเลิก">
                </form>
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
