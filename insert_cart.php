<?php
session_start();
include 'condb.php';

// แสดงข้อผิดพลาดเพื่อการ debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// รับข้อมูลลูกค้า
$cusID=$_SESSION["cus_userid"];
$cusName = $_POST['cus_name'];
$_SESSION["cus_userid"];
$cusAddress = $_POST['cus_add'];
$cusTel = $_POST['cus_tel'];
$dmonth = date("F");

// ตรวจสอบความยาวของเบอร์โทร
if (strlen($cusTel) > 15) {
    echo "<script>alert('เบอร์โทรศัพท์ยาวเกินไป'); window.history.back();</script>";
    exit();
}

// จัดการไฟล์รูปภาพที่อัปโหลด
if (isset($_FILES['cus_image']) && $_FILES['cus_image']['error'] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES['cus_image']['tmp_name'];
    $fileName = $_FILES['cus_image']['name'];
    $fileSize = $_FILES['cus_image']['size'];
    $fileType = $_FILES['cus_image']['type'];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // กำหนดชื่อไฟล์ใหม่เพื่อป้องกันการชนกันของชื่อ
    $newFileName = uniqid() . '.' . $fileExtension;

    // กำหนดโฟลเดอร์เก็บไฟล์
    $uploadFileDir = 'uploads/';
    $dest_path = $uploadFileDir . $newFileName;

    // ตรวจสอบชนิดของไฟล์ (ถ้าต้องการจำกัดเฉพาะรูปภาพ)
    $allowedfileExtensions = array('jpg', 'jpeg', 'png', 'gif');
    if (in_array($fileExtension, $allowedfileExtensions)) {
        // ย้ายไฟล์ไปยังโฟลเดอร์เก็บรูป
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $imagePath = $dest_path; // เก็บที่อยู่ของไฟล์รูปภาพ
        } else {
            echo "<script>alert('เกิดข้อผิดพลาดในการอัปโหลดรูป'); window.history.back();</script>";
            exit();
        }
    } else {
        echo "<script>alert('ชนิดของไฟล์ไม่รองรับ'); window.history.back();</script>";
        exit();
    }
} else {
    echo "<script>alert('กรุณาอัปโหลดรูป'); window.history.back();</script>";
    exit();
}

// เพิ่มข้อมูลการสั่งซื้อใน tb_order
$sql = "insert into tb_order(id,cus_name, address, telephone, total_price, order_status, dateMonth, image_path)
        values ('$cusID','$cusName', '$cusAddress', '$cusTel', '".$_SESSION["sum_price"]."', '1', '$dmonth', '$imagePath')";
mysqli_query($conn, $sql) or die(mysqli_error($conn));

// รับ orderID ที่เพิ่มล่าสุด
$orderID = mysqli_insert_id($conn);
$_SESSION["order_id"] = $orderID;

// วนลูปเพิ่มรายละเอียดสินค้า
for ($i = 0; $i <= (int)$_SESSION["intLine"]; $i++) {
    if (($_SESSION["strProductID"][$i]) != "") {
        // ดึงข้อมูลสินค้า
        $sql1 = "select * from product where pro_id = '".$_SESSION["strProductID"][$i]."' ";
        $result1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_array($result1);
        $price = $row1['price'];
        $total = $_SESSION["strQty"][$i] * $price;

        // เพิ่มข้อมูลสินค้าใน order_detail
        $sql2 = "insert into order_detail(orderID, pro_id, orderPrice, orderQty, Total)
                 values ('$orderID', '".$_SESSION["strProductID"][$i]."', '$price', '".$_SESSION["strQty"][$i]."', '$total')";
        if (mysqli_query($conn, $sql2)) {
            // ตัดสต็อกสินค้า
            $sql3 = "update product set amount = amount - '".$_SESSION["strQty"][$i]."' where pro_id = '".$_SESSION["strProductID"][$i]."'";
            mysqli_query($conn, $sql3);
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// ปิดการเชื่อมต่อฐานข้อมูล
mysqli_close($conn);

// ทำลาย session
//session_destroy();

// แจ้งเตือนเมื่อการบันทึกสำเร็จ
echo "<script>alert('บันทึกข้อมูลเสร็จแล้ว'); window.location.href='print_order.php';</script>";
?>
