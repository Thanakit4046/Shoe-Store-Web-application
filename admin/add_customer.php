\<?php
session_start();
include 'condb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $telephone = $_POST['telephone'];
    $address= $_POST['address'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO tb_customer (name, lastname, telephone, address, username, password) VALUES ('$name', '$lastname', '$telephone','$address', '$username', '$password')";

    if (mysqli_query($conn, $sql)) {
        echo "เพิ่มผู้ใช้งานสำเร็จ";
        echo "<script> window.location='employee.php'; </script>";
    } else {
        echo "เกิดข้อผิดพลาด: " . mysqli_error($conn);
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>เพิ่มผู้ใช้งาน</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet" />
</head>

<body>
<?php include('./component/menu1.php'); ?>
    <div class="container-fluid px-4">
        <div class="container mt-5">
            <div class="card shadow-lg p-4">
                <h2 class="text-center mb-4">เพิ่มผู้ใช้งาน</h2>
                <form action="add_customer.php" method="post">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">ชื่อ:</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">นามสกุล:</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="telephone" class="form-label">เบอร์โทรศัพท์:</label>
                        <input type="tel" class="form-control" id="telephone" name="telephone" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">ที่อยู่:</label>
                        <input type="text" class="form-control" id="address" name="address" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">ชื่อผู้ใช้งาน:</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">รหัสผ่าน:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-success me-2"><i class="bi bi-save"></i> บันทึก</button>
                        <a href="employee.php" class="btn btn-secondary"><i class="bi bi-x-circle"></i> ยกเลิก</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>
