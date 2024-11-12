<?php
session_start();
include 'condb.php';

if (!isset($_SESSION["emp_userid"])) {
    header("Location: login.php");
    exit();
}

$ddt1 = @$_POST['dt1'];
$ddt2 = @$_POST['dt2'];
$add_date = date('Y/m/d', strtotime($ddt2 . "+1 days"));
$group_by = isset($_POST['group_by']) ? $_POST['group_by'] : 'daily';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>รายงานสรุปยอดขายสินค้า</title>
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
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        รายการสั่งซื้อสินค้า
                    </div>
                    <br>
                    <form name="form1" method="POST" action="report_sale.php">
                        <div class="row">
                            <div class="col-sm-2">
                                <input type="date" name="dt1" class="form-control" required>
                            </div>
                            <div class="col-sm-2">
                                <input type="date" name="dt2" class="form-control" required>
                            </div>
                            <div class="col-sm-2">
                                <select name="group_by" class="form-control">
                                    <option value="daily">รายวัน</option>
                                    <option value="monthly">รายเดือน</option>
                                    <option value="yearly">รายปี</option>
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary"><i class="bi bi-search"></i> ค้นหา</button>
                            </div>
                        </div>
                    </form>

                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>วันที่/เดือน/ปี</th>
                                    <th>ยอดขายรวม</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (($ddt1 != "") && ($ddt2 != "")) {
                                    $sql = "SELECT ";

                                    // กำหนดการจัดกลุ่มตามตัวเลือกที่เลือก
                                    if ($group_by == 'daily') {
                                        $sql .= "DATE(reg_date) AS date, SUM(total_price) AS total_sales ";
                                    } elseif ($group_by == 'monthly') {
                                        $sql .= "DATE_FORMAT(reg_date, '%Y-%m') AS month, SUM(total_price) AS total_sales ";
                                    } elseif ($group_by == 'yearly') {
                                        $sql .= "YEAR(reg_date) AS year, SUM(total_price) AS total_sales ";
                                    }

                                    $sql .= "FROM tb_order WHERE order_status = '2' AND reg_date BETWEEN '$ddt1' AND '$add_date' GROUP BY ";

                                    if ($group_by == 'daily') {
                                        $sql .= "DATE(reg_date)";
                                    } elseif ($group_by == 'monthly') {
                                        $sql .= "YEAR(reg_date), MONTH(reg_date)";
                                    } elseif ($group_by == 'yearly') {
                                        $sql .= "YEAR(reg_date)";
                                    }

                                    $sql .= " ORDER BY reg_date DESC";
                                } else {
                                    $sql = "SELECT DATE(reg_date) AS date, SUM(total_price) AS total_sales FROM tb_order WHERE order_status = '2'  GROUP BY DATE(reg_date) ORDER BY reg_date DESC";
                                }

                                $result = mysqli_query($conn, $sql);

                                while ($row = mysqli_fetch_array($result)) {
                                ?>
                                    <tr>
                                        <td><?= ($group_by == 'daily') ? $row['date'] : (($group_by == 'monthly') ? $row['month'] : $row['year']) ?></td>
                                        <td><?= number_format($row['total_sales'], 2) ?> บาท</td>
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
