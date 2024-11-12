<?php
session_start();
include 'condb.php';

$sql = "select * from tb_order where orderID= '" . $_SESSION["order_id"] . "' ";
$result = mysqli_query($conn, $sql);
$rs = mysqli_fetch_array($result);
$total_price = $rs['total_price'];
$imagePath = $rs['image_path']; // ดึงเส้นทางรูปภาพจากฐานข้อมูล
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ใบเสร็จ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>ใบเสร็จสินค้า</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">ข้อมูลการสั่งซื้อ</h6>
                        <p><strong>เลขที่สั่งซื้อ:</strong> <?= $rs['orderID']; ?></p>
                        <p><strong>เลขที่สมาชิก:</strong> <?= $rs['id']; ?></p>
                        <p><strong>ชื่อ - นามสกุล:</strong> <?= $rs['cus_name']; ?></p>
                        <p><strong>ที่อยู่การจัดส่ง:</strong> <?= $rs['address']; ?></p>
                        <p><strong>เบอร์โทรศัพท์:</strong> <?= $rs['telephone']; ?></p>

                        <!-- แสดงรูปที่อัปโหลดโดยลูกค้า -->
                        <p><strong>รูปภาพ:</strong></p>
                        <img src="<?= $imagePath ?>" alt="รูปภาพ" class="img-fluid img-thumbnail" style="max-width: 300px;">

                        <h6 class="mt-4">รายละเอียดสินค้า</h6>
                        <table class="table table-bordered table-hover">
                            <thead class="table-secondary">
                                <tr>
                                    <th>รหัสสินค้า</th>
                                    <th>ชื่อสินค้า</th>
                                    <th>ราคา</th>
                                    <th>จำนวน</th>
                                    <th>ราคารวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql1 = "select * from order_detail d, product p where d.pro_id = p.pro_id and d.orderID = '" . $_SESSION["order_id"] . "'";
                                $result1 = mysqli_query($conn, $sql1);
                                while ($row = mysqli_fetch_array($result1)) {
                                ?>
                                    <tr>
                                        <td><?= $row['pro_id'] ?></td>
                                        <td><?= $row['pro_name'] ?></td>
                                        <td><?= number_format($row['orderPrice'], 2) ?> บาท</td>
                                        <td><?= $row['orderQty'] ?></td>
                                        <td><?= number_format($row['Total'], 2) ?> บาท</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                        
                        <h6 class="text-end">รวมเป็นเงิน: <strong><?= number_format($total_price, 2) ?></strong> บาท</h6>

                    </div>

                    <div class="card-footer text-center">
                        <a href="show_product.php" class="btn btn-secondary">กลับไปเลือกสินค้า</a>
                        <button onclick="window.print()" class="btn btn-success">พิมพ์ใบเสร็จ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
