<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start(); // เริ่มการทำงานของ session
if (!isset($_SESSION["cus_username"])) {
    // ถ้ายังไม่ได้ล็อกอิน ให้กลับไปหน้า login.php
    header("Location: login.php");
    exit(); // หยุดการทำงานของสคริปต์
}

include 'condb.php';

// ดึงข้อมูลคำสั่งซื้อของลูกค้าปัจจุบัน
$cusID = $_SESSION["cus_userid"];
$sql = "SELECT * FROM tb_order WHERE id = '$cusID' ORDER BY reg_date DESC";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="th">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ประวัติคำสั่งซื้อ</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <?php include "./component/menu.php"; ?>

    <div class="container my-4">
        <h2 class="text-center mb-4">ประวัติคำสั่งซื้อ</h2>
        <table class="table table-hover table-bordered">
            <thead class="table-dark">
                <tr>
                    <th scope="col">เลขที่ใบสั่งซื้อ</th>
                    <th scope="col">ชื่อ-นามสกุล</th>
                    <th scope="col">ราคารวม</th>
                    <th scope="col">วันที่สั่งซื้อ</th>
                    <th scope="col">สถานะ</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // วนลูปแสดงรายการคำสั่งซื้อ
                while ($row = mysqli_fetch_assoc($result)) {
                    $status = $row['order_status'];
                ?>
                    <tr>
                        <td><?= $row['orderID'] ?></td>
                        <td><?= $row['cus_name'] ?></td>
                        <td>฿ <?= number_format($row['total_price'], 2) ?></td>
                        <td><?= date("d-m-Y", strtotime($row['reg_date'])) ?></td>
                        <td>
                            <?php
                            // แสดงสถานะของคำสั่งซื้อ
                            if ($status == 0) {
                                echo 'ยกเลิกคำสั่ง';
                            } elseif ($status == 1) {
                                echo 'ยังไม่ชำระเงิน';
                            } elseif ($status == 2) {
                                echo 'ชำระเงินแล้ว';
                            } elseif ($status == 3) {
                                echo 'กำลังจัดส่ง';
                            } elseif ($status == 4) {
                                echo 'จัดส่งแล้ว';
                            } else {
                                echo 'ไม่ทราบสถานะ';
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php include('./component/footer.php'); ?>
</body>

</html>

<?php
// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);
?>