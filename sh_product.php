<?php
session_start(); // เริ่มการทำงานของ session
if (!isset($_SESSION["cus_username"])) {
    // ถ้ายังไม่ได้ล็อกอิน ให้กลับไปหน้า login.php
    header("Location: login.php");
    exit(); // หยุดการทำงานของสคริปต์
}

include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php
    include "./component/menu.php"
    ?>
    <div class="container">
    <div class="row justify-content-center"> <!-- Center the row -->
        <?php
        $ids = $_GET['id'];
        $sql = "SELECT * FROM product, type WHERE product.type_id = type.type_id and product.pro_id='$ids' ";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        ?>
        <div class="col-md-3">
            <img src="image/<?= $row['image'] ?>" width="100%" class="card-img-top">
        </div>
        <div class="col-md-3 d-flex flex-column justify-content-center ">
            <h4 class="text-success"><?= $row['pro_name'] ?></h4>
            ID: <?= $row['pro_id'] ?> <br>
            ประเภทสินค้า: <?= $row['type_name'] ?> <br>
            <b class="text-danger">ราคา ฿<?= $row['price'] ?></b>
            <a class="btn btn-outline-success mt-3" href="order.php?id=<?= $row['pro_id'] ?>">add cart</a>
        </div>
    </div>
</div>
    <?php
    mysqli_close($conn);
    ?>
    <?php
    include('./component/footer.php')
    ?>

</body>

</html>