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
    <title>การสั่งซื้อสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('./componrnt/menu1.php'); ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <br>
                <a href="report_order.php" class="btn btn-success">แสดงทั้งหมด</a>
                <a href="report_order.php?filter=paid" class="btn btn-primary">ชำระเงินแล้ว</a>
                <a href="report_order.php?filter=unpaid" class="btn btn-secondary">ยังไม่ชำระเงิน</a>
                <a href="report_order.php?filter=canceled" class="btn btn-danger">ยกเลิกการสั่งซื้อ</a>  
                <a href="report_order.php?filter=ggg" class="btn btn-warning">กำลังจัดส่ง</a> 
                <a href="report_order.php?filter=ddd" class="btn btn-info">จัดส่งแล้ว</a> 
                <br><br>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        รายการสั่งซื้อสินค้า
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>เลขที่ใบสั่งซื้อ</th>
                                    <th>ชื่อ</th>
                                    <th>ที่อยู่จัดส่งสินค้า</th>
                                    <th>เบอร์โทร</th>
                                    <th>ราคารวม</th>
                                    <th>วันที่สั่งซื้อ</th>
                                    <th>สถานะ</th>
                                    <th>รายละเอียด</th>
                                    <th>ปรับสถานะ</th>
                                    <th>ยกเลิกการซื้อ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $filter = isset($_GET['filter']) ? $_GET['filter'] : '';

                                if ($filter == 'paid') {
                                    $sql = "SELECT * FROM tb_order WHERE order_status = 2 ORDER BY reg_date DESC";
                                } elseif ($filter == 'unpaid') {
                                    $sql = "SELECT * FROM tb_order WHERE order_status = 1 ORDER BY reg_date DESC";
                                }elseif ($filter == 'ggg') {
                                    $sql = "SELECT * FROM tb_order WHERE order_status = 3 ORDER BY reg_date DESC";
                                } elseif ($filter == 'ddd') {
                                    $sql = "SELECT * FROM tb_order WHERE order_status = 4 ORDER BY reg_date DESC";
                                }elseif ($filter == 'canceled') {
                                    $sql = "SELECT * FROM tb_order WHERE order_status = 0 ORDER BY reg_date DESC";
                                } else {
                                    $sql = "SELECT * FROM tb_order ORDER BY reg_date DESC";
                                }

                                $result = mysqli_query($conn, $sql);
                                while ($row = mysqli_fetch_array($result)) {
                                    $status = $row['order_status'];
                                ?>
                                    <tr>
                                        <td><?= $row['orderID'] ?></td>
                                        <td><?= $row['cus_name'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        <td><?= $row['telephone'] ?></td>
                                        <td><?= number_format($row['total_price'], 2) ?> บาท</td>
                                        <td><?= $row['reg_date'] ?></td>
                                        <td>
                                            <?php
                                            if ($status == 0) {
                                                echo "<span style='color:red;'>ยกเลิกการสั่งซื้อ</span>";
                                            } elseif ($status == 1) {
                                                echo "ยังไม่ชำระเงิน";
                                            } elseif ($status == 2) {
                                                echo "<span style='color:blue;'>ชำระเงินแล้ว</span>";
                                            }elseif ($status == 3) {
                                                echo "<span style='color:orange;'>กำลังจัดส่ง</span>";
                                            }elseif ($status == 4) {
                                                echo "<span style='color:indigo;'>จัดส่งสำเร็จ</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <a href="order_detail.php?id=<?= $row['orderID'] ?>" class="btn btn-info">รายละเอียด</a>
                                        </td>
                                        <td>
                                            <a href="update_status.php?id=<?= $row['orderID'] ?>" class="btn btn-warning">ปรับสถานะ</a>
                                        </td>
                                        <td>
                                            <a href="cancel_order.php?id=<?= $row['orderID'] ?>" class="btn btn-danger">ยกเลิก</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
        <?php include('footer.php'); ?>
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