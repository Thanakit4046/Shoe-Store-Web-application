<?php
session_start();
include 'condb.php';

// ตรวจสอบว่ามีการส่ง orderID มาหรือไม่
if (!isset($_GET['id'])) {
    echo "ไม่พบหมายเลขคำสั่งซื้อ";
    exit();
}

// รับค่า orderID จาก URL
$orderID = $_GET['id'];

// ดึงข้อมูลคำสั่งซื้อ
$sql_order = "SELECT * FROM tb_order WHERE orderID = '$orderID'";
$result_order = mysqli_query($conn, $sql_order);
$order = mysqli_fetch_array($result_order);

if (!$order) {
    echo "ไม่พบคำสั่งซื้อ";
    exit();
}

// ตรวจสอบว่าได้ส่งฟอร์มมาเพื่ออัปเดตหรือไม่
if (isset($_POST['update_status'])) {
    $new_status = $_POST['order_status'];
    
    // อัปเดตสถานะในฐานข้อมูล
    $sql_update = "UPDATE tb_order SET order_status = '$new_status' WHERE orderID = '$orderID'";
    if (mysqli_query($conn, $sql_update)) {
        echo "<script>alert('อัปเดตสถานะสำเร็จ'); window.location.href='report_order.php';</script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>อัปเดตสถานะคำสั่งซื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>อัปเดตสถานะคำสั่งซื้อ</h4>
                    </div>
                    <div class="card-body">
                        <!-- แสดงข้อมูลการสั่งซื้อ -->
                        <p><strong>เลขที่สั่งซื้อ:</strong> <?= $order['orderID']; ?></p>
                        <p><strong>ชื่อ - นามสกุล:</strong> <?= $order['cus_name']; ?></p>
                        <p><strong>ที่อยู่การจัดส่ง:</strong> <?= $order['address']; ?></p>
                        <p><strong>เบอร์โทรศัพท์:</strong> <?= $order['telephone']; ?></p>
                        <p><strong>สถานะปัจจุบัน:</strong> 
                            <?php
                            if ($order['order_status'] == 0) {
                                echo "<span style='color:red;'>ยกเลิกการสั่งซื้อ</span>";
                            } elseif ($order['order_status'] == 1) {
                                echo "ยังไม่ชำระเงิน";
                            } elseif ($order['order_status'] == 2) {
                                echo "<span style='color:blue;'>ชำระเงินแล้ว</span>";
                            } elseif ($order['order_status'] == 3) {
                                echo "<span style='color:green;'>กำลังจัดส่ง</span>";
                            } elseif ($order['order_status'] == 4) {
                                echo "<span style='color:green;'>จัดส่งสำเร็จ</span>";
                            }
                            ?>
                        </p>

                        <!-- ฟอร์มสำหรับอัปเดตสถานะ -->
                        <form action="" method="POST">
                            <div class="mb-3">
                                <label for="order_status" class="form-label">สถานะใหม่</label>
                                <select name="order_status" id="order_status" class="form-control" required>
                                    <option value="1" <?= ($order['order_status'] == 1) ? 'selected' : '' ?>>ยังไม่ชำระเงิน</option>
                                    <option value="2" <?= ($order['order_status'] == 2) ? 'selected' : '' ?>>ชำระเงินแล้ว</option>
                                    <option value="3" <?= ($order['order_status'] == 3) ? 'selected' : '' ?>>กำลังจัดส่ง</option>
                                    <option value="4" <?= ($order['order_status'] == 4) ? 'selected' : '' ?>>จัดส่งสำเร็จ</option>
                                    <option value="0" <?= ($order['order_status'] == 0) ? 'selected' : '' ?>>ยกเลิกการสั่งซื้อ</option>
                                </select>
                            </div>
                            <div class="text-center">
                                <button type="submit" name="update_status" class="btn btn-success">อัปเดตสถานะ</button>
                                <a href="report_order.php" class="btn btn-secondary">ย้อนกลับ</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
