<?php
session_start();
include 'condb.php';

// ตรวจสอบว่ามีการส่งค่า orderID มาหรือไม่
if (!isset($_GET['id'])) {
    echo "ไม่มีหมายเลขคำสั่งซื้อ";
    exit();
}

// รับค่า orderID จาก URL
$orderID = $_GET['id'];

// ดึงข้อมูลคำสั่งซื้อ
$sql = "SELECT * FROM tb_order WHERE orderID = '$orderID'";
$result = mysqli_query($conn, $sql);
$order = mysqli_fetch_array($result); 
// ดึงรูปภาพที่เก็บในฐานข้อมูล
$image_path = $order['image_path'];

if (!$order) {
    echo "ไม่พบคำสั่งซื้อ";
    exit();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>รายละเอียดคำสั่งซื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>รายละเอียดคำสั่งซื้อ</h4>
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">ข้อมูลการสั่งซื้อ</h6>
                        <p><strong>เลขที่สั่งซื้อ:</strong> <?= $order['orderID']; ?></p>
                        <p><strong>เลขที่สมาชิก:</strong> <?= $rs['id']; ?></p> 
                        <p><strong>ชื่อ - นามสกุล:</strong> <?= $order['cus_name']; ?></p>
                        <p><strong>ที่อยู่การจัดส่ง:</strong> <?= $order['address']; ?></p>
                        <p><strong>เบอร์โทรศัพท์:</strong> <?= $order['telephone']; ?></p>
                        <p><strong>วันที่สั่งซื้อ:</strong> <?= $order['reg_date']; ?></p>

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
                                // ดึงข้อมูลสินค้าที่อยู่ในคำสั่งซื้อนี้
                                $sql1 = "SELECT d.pro_id, p.pro_name, d.orderPrice, d.orderQty, d.Total 
                                         FROM order_detail d
                                         JOIN product p ON d.pro_id = p.pro_id 
                                         WHERE d.orderID = '$orderID'";
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

                        <h6 class="text-end">รวมเป็นเงิน: <strong><?= number_format($order['total_price'], 2) ?></strong> บาท</h6>
                        
                    </div>

                    <div class="card-footer text-center">
                        <a href="report_order.php" class="btn btn-secondary">กลับไปที่ประวัติคำสั่งซื้อ</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<?php
// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
