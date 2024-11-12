<?php
session_start();
include 'condb.php';

// ตรวจสอบว่ามีการส่ง id มาหรือไม่
if (isset($_GET['id'])) {
    $pro_id = $_GET['id'];

    // ดึงข้อมูลสินค้าจากฐานข้อมูลตาม id
    $sql = "SELECT * FROM product WHERE pro_id = '$pro_id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
}

// ตรวจสอบว่ามีการส่งข้อมูลจากฟอร์มมาหรือไม่
if (isset($_POST['update'])) {
    $pro_id = $_POST['pro_id'];
    $pro_name = $_POST['pro_name'];
    $price = $_POST['price'];

    // อัปเดตข้อมูลสินค้าในฐานข้อมูล
    $sql = "UPDATE product SET pro_name = '$pro_name', price = '$price' WHERE pro_id = '$pro_id'";
    if (mysqli_query($conn, $sql)) {
        // หลังอัปเดตสำเร็จ redirect กลับไปยังหน้าจัดการสินค้า
        header("Location: product.php");
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
    <title>แก้ไขสินค้า</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
</head>

<body>
    <?php include('./componrnt/menu1.php'); ?>
    <div id="layoutSidenav_content">
        <div class="container">
            <br>
            <h2>แก้ไขสินค้า</h2>
            <form action="edit_product.php" method="POST">
                <input type="hidden" name="pro_id" value="<?= $row['pro_id']; ?>">
                <div class="form-group">
                    <label for="pro_name">ชื่อสินค้า:</label>
                    <input type="text" name="pro_name" class="form-control" value="<?= $row['pro_name']; ?>" required>
                </div>
                <div class="form-group">
                    <label for="price">ราคา:</label>
                    <input type="text" name="price" class="form-control" value="<?= $row['price']; ?>" required>
                </div>
         
                <br>
                <button type="submit" name="update" class="btn btn-success">บันทึกการแก้ไข</button>
            </form>
        </div>
    </div>
</body>

</html>