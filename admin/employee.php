<?php
session_start();
include 'condb.php';
if (!isset($_SESSION["emp_userid"])) {
    header("Location: login.php");
    exit();
}

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
if (isset($_GET['id'])) {
    $deleteID = $_GET['id'];

    // ใช้ prepared statement เพื่อป้องกัน SQL Injection
    $stmt = $conn->prepare("DELETE FROM tb_customer WHERE id = ?");
    $stmt->bind_param("i", $deleteID); // กำหนดว่าข้อมูลเป็น integer

    if ($stmt->execute()) {
        // ลบสำเร็จ ทำการ redirect กลับไปยังหน้า manage_users.php
        header("Location: employee.php");
        exit();
    } else {
        // แสดงข้อผิดพลาดหากการลบไม่สำเร็จ
        echo "เกิดข้อผิดพลาด: " . $stmt->error;
    }

    $stmt->close(); // ปิด statement
}

// ดึงข้อมูลสมาชิกจากฐานข้อมูล
$sql = "SELECT * FROM tb_customer";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>การจัดการผู้ใช้งาน</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body class="sb-nav-fixed">
    <?php include('./componrnt/menu1.php'); ?>
    <div id="layoutSidenav_content">
        <main>
        <br>
            <div class="container-fluid px-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">ผู้ใช้งาน</h2>
                    <a href="add_customer.php" class="btn btn-primary">
                        <i class="bi bi-plus-circle-fill"></i> เพิ่มผู้ใช้งาน
                    </a>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        DataTable ลูกค้า
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>ชื่อ</th>
                                    <th>นามสกุล</th>
                                    <th>เบอร์โทรศัพท์</th>
                                    <th>ที่อยู่</th>
                                    <th>username</th>
                                    <th>แก้ไข</th>
                                    <th>ลบผู้ใช้งาน</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php
                                if ($result) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        echo "<tr>";
                                        echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['lastname']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['address']) . "</td>";
                                        echo "<td>" . htmlspecialchars($row['username']) . "</td>";
                                        echo "<td><a href='edit_customer.php?id=" . $row['id'] . "' class='btn btn-warning'>แก้ไข</a></td>";
                                        echo "<td><a href='employee.php?id=" . $row['id'] . "' class='btn btn-danger' onclick='return confirm(\"คุณต้องการลบผู้ใช้งานนี้หรือไม่?\")'><i class='bi bi-trash'></i>ลบ</a></td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='6'>ไม่พบข้อมูลสมาชิก</td></tr>";
                                }
                                ?>
                            </tbody>

                        </table>
                    </div>
                </div>

        </main>
    </div>
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
