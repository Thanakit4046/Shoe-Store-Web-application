<?php
session_start();
include 'condb.php';

if (!isset($_GET['id'])) {
    echo "ไม่มีการส่งหมายเลขลูกค้า";
    exit();
}

$customerID = $_GET['id'];

// ดึงข้อมูลลูกค้าจากฐานข้อมูล
$sql = "SELECT * FROM tb_customer WHERE id = '$customerID'";
$result = mysqli_query($conn, $sql);
$customer = mysqli_fetch_array($result);

if (!$customer) {
    echo "ไม่พบข้อมูลลูกค้า";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $telephone = $_POST['telephone'];
    $address = $_POST['address'];
    $username = $_POST['username'];

    // อัพเดทข้อมูล
    $sql = "UPDATE tb_customer SET name='$name', lastname='$lastname', telephone='$telephone', address='$address', username='$username' WHERE id='$customerID'";
    if (mysqli_query($conn, $sql)) {
        echo "แก้ไขข้อมูลสำเร็จ";
        header("Location: manage_users.php");
        exit();
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>แก้ไขข้อมูลผู้ใช้งาน</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>

    <?php include('./component/menu1.php'); ?>
    <div class="container-fluid px-4">
        <div class="container mt-5">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">แก้ไขข้อมูลผู้ใช้งาน</h2>
                <form action="edit_customer.php?id=<?= $customerID ?>" method="post">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">ชื่อ:</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?= $customer['name'] ?>" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">นามสกุล:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="<?= $customer['lastname'] ?>" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">เบอร์โทรศัพท์:</label>
                        <input type="text" class="form-control" id="telephone" name="telephone" value="<?= $customer['telephone'] ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่:</label>
                        <textarea class="form-control" id="address" name="address" rows="3" required><?= $customer['address'] ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">ชื่อผู้ใช้งาน:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?= $customer['username'] ?>" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success me-2"><i class="bi bi-save"></i> บันทึกการเปลี่ยนแปลง</button>
                        <a href="employee.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
