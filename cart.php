<?php
session_start();
if (!isset($_SESSION["cus_username"])) {
    header("Location: login.php");
    exit();
}
include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตะกร้าสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include "./component/menu.php"; ?>

    <div class="container my-4">
        <h2 class="text-center mb-4">Shopping Cart</h2>
        <form id="form1" method="POST" action="insert_cart.php" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-10 mx-auto">
                    <table class="table table-hover table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>ลำดับที่</th>
                                <th>ชื่อสินค้า</th>
                                <th>ราคา</th>
                                <th>จำนวน</th>
                                <th>ราคารวม</th>
                                <th>เพิ่ม-ลด</th>
                                <th>ลบ</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $Total = 0;
                            $sumPrice = 0;
                            $m = 2;
                            for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
                                if (($_SESSION["strProductID"][$i]) != "") {
                                    $sql = "SELECT * FROM product WHERE pro_id = '" . $_SESSION["strProductID"][$i] . "' ";
                                    $result = mysqli_query($conn, $sql);
                                    $row_pro = mysqli_fetch_array($result);

                                    $_SESSION["price"] = $row_pro['price'];
                                    $Total = $_SESSION["strQty"][$i];
                                    $sum = $Total * $row_pro['price'];
                                    $sumPrice += $sum;
                                    $_SESSION["sum_price"] = $sumPrice;
                            ?>
                                    <tr>
                                        <td><?= $m ?></td>
                                        <td>
                                            <img src="image/<?= $row_pro['image'] ?>" width="100" height="130" class="cart-img img-thumbnail">
                                            <?= $row_pro['pro_name'] ?>
                                        </td>
                                        <td>฿ <?= number_format($row_pro['price'], 2) ?></td>
                                        <td><?= $_SESSION["strQty"][$i] ?></td>
                                        <td>฿ <?= number_format($sum, 2) ?></td>
                                        <td>
                                            <a href="order.php?id=<?= $row_pro['pro_id'] ?>" class="btn btn-info">+</a>
                                            <?php if ($_SESSION["strQty"][$i] > 2) { ?>
                                                <a href="order_del.php?id=<?= $row_pro['pro_id'] ?>" class="btn btn-warning">-</a>
                                            <?php } ?>
                                        </td>
                                        <td><a href="pro_delete.php?Line=<?= $i ?>"><i class="bi bi-x-circle text-danger"></i></a></td>
                                    </tr>
                            <?php
                                    $m++;
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                    <div class="cart-summary">
                        <h4>ยอดรวม: ฿ <?= number_format($sumPrice, 2) ?></h4>
                    </div>
                    <div class="text-end mt-3">
                        <a href="show_product.php" class="btn btn-primary">เลือกสินค้า</a>
                        <button type="submit" class="btn btn-success">ยืนยันการสั่งซื้อ</button>
                    </div>
                </div>
            </div>
            <div class="row mt-4">
                <!-- คอลัมน์สำหรับข้อมูลจัดส่ง -->
                <div class="col-md-6">
                    <div class="alert alert-primary">
                        ข้อมูลสำหรับจัดส่งสินค้า
                    </div>
                    <div class="mb-3">
                        <label for="cus_name" class="form-label">ชื่อ-นามสกุล:</label>
                        <input type="text" name="cus_name" class="form-control" id="cus_name" required placeholder="ชื่อ-นามสกุล...">
                    </div>
                    <div class="mb-3">
                        <label for="cus_add" class="form-label">ที่อยู่จัดส่งสินค้า:</label>
                        <textarea class="form-control" name="cus_add" id="cus_add" rows="3" required placeholder="ที่อยู่..."></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="cus_tel" class="form-label">เบอร์โทรศัพท์:</label>
                        <input type="number" name="cus_tel" class="form-control" id="cus_tel" required placeholder="เบอร์โทรศัพท์...">
                    </div>
                    <!-- ช่องอัปโหลดไฟล์รูป -->
                    <div class="mb-3">
                        <label for="cus_image" class="form-label">อัปโหลดรูปภาพ:</label>
                        <input type="file" name="cus_image" class="form-control" id="cus_image" accept="image/*" required>
                    </div>
                </div>
                
                <!-- คอลัมน์สำหรับ QR Code -->
                <div class="col-md-6 d-flex justify-content-center align-items-center">
                    <img src="./img/promptpay_qrcode_id-818x1024.jpg" alt="PromptPay QR Code" width="350" height="350" class="img-fluid rounded">
                </div>
            </div>
        </form>
    </div>
</body>

</html>
