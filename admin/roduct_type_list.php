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
    <title>เพิ่มประเภทสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('./componrnt/menu1.php'); ?>
    <div id="layoutSidenav_content">
        <main class="container mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">จัดการประเภทสินค้า</h4>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5>ประเภทสินค้า</h5>
                        <a href="add_product_type.php" class="btn btn-success">เพิ่มประเภทสินค้า</a>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th class="text-center">ลำดับ</th>
                                    <th>ชื่อประเภทสินค้า</th>
                                    <th class="text-center">จัดการ</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // ดึงข้อมูลประเภทสินค้าจากฐานข้อมูล
                                $sql = "SELECT * FROM type ORDER BY type_id ASC";
                                $result = mysqli_query($conn, $sql);

                                if (mysqli_num_rows($result) > 0) {
                                    $i = 1; // ตัวแสดงลำดับ
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td class='text-center'>" . $i++ . "</td>";
                                        echo "<td>" . $row['type_name'] . "</td>";
                                        echo "<td class='text-center'>";
                                        echo "<a href='delete_type.php?id=" . $row['type_id'] . "' class='btn btn-danger' onclick='return confirm(\"คุณต้องการลบประเภทสินค้านี้หรือไม่?\");'><i class='bi bi-trash'></i> ลบ</a>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='3' class='text-center'>ไม่มีข้อมูลประเภทสินค้า</td></tr>";
                                }

                                mysqli_close($conn);
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <?php include('footer.php'); ?>
    </div>
</body>

</html>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
