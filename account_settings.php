<?php
session_start();
include 'condb.php';

// ตรวจสอบว่าผู้ใช้ล็อกอินหรือไม่
if (!isset($_SESSION["cus_username"])) {
    // ถ้ายังไม่ได้ล็อกอิน ให้กลับไปหน้า login.php
    header("Location: login.php");
    exit(); // หยุดการทำงานของสคริปต์
}

// ดึงข้อมูลลูกค้าจากฐานข้อมูล
$userid = $_SESSION['cus_userid'];  // Assuming 'cus_userid' is the session variable containing the customer ID
$sql = "SELECT * FROM tb_customer WHERE id = $userid";
$result = mysqli_query($conn, $sql);
$customer = mysqli_fetch_assoc($result);

// หากส่งข้อมูลการแก้ไขเข้ามา
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];

    // อัปเดตข้อมูลลูกค้าในฐานข้อมูล
    $update_sql = "UPDATE tb_customer SET name = '$name', lastname = '$lastname', address = '$address', telephone = '$telephone' WHERE id = $userid";
    if (mysqli_query($conn, $update_sql)) {
        $_SESSION['success'] = "แก้ไขข้อมูลเรียบร้อยแล้ว";
    } else {
        $_SESSION['error'] = "เกิดข้อผิดพลาดในการอัปเดตข้อมูล: " . mysqli_error($conn);
    }

    // รีเฟรชหน้าเพื่อแสดงผลลัพธ์ใหม่
    header('Location: account_settings.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ตั้งค่าบัญชี</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    
</head>

<body>

    <?php include "./component/menu.php"; ?>

    <div class="container mt-5">
        <h2 class="text-center">ตั้งค่าบัญชี</h2>

        <!-- แสดงข้อความแจ้งเตือน -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success text-center">
                <?= $_SESSION['success'] ?>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php elseif (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger text-center">
                <?= $_SESSION['error'] ?>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <!-- Form แก้ไขข้อมูล -->
        <form method="POST" action="account_settings.php">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="name" class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?= $customer['name'] ?>" required>
                </div>
                <div class="col-md-6">
                    <label for="lastname" class="form-label">นามสกุล</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $customer['lastname'] ?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">ที่อยู่</label>
                <textarea class="form-control" id="address" name="address" rows="3" required><?= $customer['address'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="telephone" class="form-label">เบอร์โทร</label>
                <input type="text" class="form-control" id="telephone" name="telephone" value="<?= $customer['telephone'] ?>" required>
            </div>

            <!-- ปุ่มบันทึกการเปลี่ยนแปลง -->
            <div class="text-end">
                <button type="submit" class="btn btn-primary btn-sm">บันทึกการเปลี่ยนแปลง</button>
            </div>
        </form>
    </div>
    <?php include('./component/footer.php'); ?>


</body>

</html>