<?php
session_start(); // เริ่มการทำงานของ session
include 'condb.php'; // เรียกใช้ไฟล์เชื่อมต่อฐานข้อมูล

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION['cus_username'])) {
    header("Location: login.php");
    exit();
}

// รับ customer_id จาก session ที่ล็อกอิน
$customer_id = $_SESSION['customer_id'];

// ดึงข้อมูลคำสั่งซื้อจากฐานข้อมูล
$sql = "SELECT * FROM tb_order WHERE customer_id = '$customer_id' ORDER BY orderDate DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติคำสั่งซื้อ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include "./component/menu.php"; ?> <!-- เมนูนำทาง -->

    <div class="container my-4">
        <h2 class="text-center mb-4">ประวัติคำสั่งซื้อ</h2>

        <?php if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>เลขที่สั่งซื้อ</th>
                        <th>วันที่สั่งซื้อ</th>
                        <th>ยอดรวม (บาท)</th>
                        <th>สถานะคำสั่งซื้อ</th>
                        <th>ดูรายละเอียด</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td><?= $row['orderID'] ?></td>
                            <td><?= date('d/m/Y', strtotime($row['orderDate'])) ?></td>
                            <td><?= number_format($row['total_price'], 2) ?> บาท</td>
                            <td>
                                <?php 
                                // แสดงสถานะคำสั่งซื้อ
                                if ($row['order_status'] == 1) {
                                    echo "รอชำระเงิน";
                                } elseif ($row['order_status'] == 2) {
                                    echo "ชำระเงินแล้ว";
                                } elseif ($row['order_status'] == 3) {
                                    echo "จัดส่งแล้ว";
                                } else {
                                    echo "ยกเลิกคำสั่งซื้อ";
                                }
                                ?>
                            </td>
                            <td><a href="order_details.php?orderID=<?= $row['orderID'] ?>" class="btn btn-info btn-sm">ดูรายละเอียด</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <div class="alert alert-info text-center">คุณยังไม่มีประวัติการสั่งซื้อ</div>
        <?php } ?>
    </div>
</body>

</html>

<?php
// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>
