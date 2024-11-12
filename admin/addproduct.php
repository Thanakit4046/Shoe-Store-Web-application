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
    <title>เพิ่มสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('./componrnt/menu1.php'); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">เพิ่มสินค้า</h1>
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <i class="fas fa-plus me-1"></i> เพิ่มข้อมูลสินค้า
                    </div>
                    <div class="card-body">
                        <form name="form1" method="post" action="insert_product.php" enctype="multipart/form-data">
                            <div class="mb-3">
                                <label class="form-label">ชื่อสินค้า:</label>
                                <input type="text" name="pname" class="form-control" placeholder="ชื่อสินค้า...." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ประเภทสินค้า:</label>
                                <select class="form-select" name="typeID">
                                    <?php
                                    $spl = "SELECT * FROM type ORDER BY type_name";
                                    $hand = mysqli_query($conn, $spl);
                                    while ($row = mysqli_fetch_assoc($hand)) {
                                    ?>
                                        <option value="<?= $row['type_id'] ?>"><?= $row['type_name'] ?></option>
                                    <?php
                                    }
                                    mysqli_close($conn);
                                    ?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">ราคา:</label>
                                <input type="number" name="price" class="form-control" placeholder="ราคา...." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">จำนวน:</label>
                                <input type="number" name="num" class="form-control" placeholder="จำนวน...." required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">รูปภาพ:</label>
                                <input type="file" name="file1" class="form-control" required>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> ตกลง</button>
                                <a href="product.php" class="btn btn-danger"><i class="bi bi-x-circle"></i> ยกเลิก</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </main>
        <?php include('footer.php'); ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
