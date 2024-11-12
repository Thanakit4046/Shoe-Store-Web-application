<?php
session_start();
include 'condb.php'; // เรียกใช้งานไฟล์เชื่อมต่อฐานข้อมูล

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $type_name = $_POST['type_name'];

    // ตรวจสอบว่าไม่ได้กรอกข้อมูลว่าง
    if (!empty($type_name)) {
        // บันทึกข้อมูลประเภทสินค้า
        $sql = "INSERT INTO type (type_name) VALUES ('$type_name')";

        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = "เพิ่มประเภทสินค้าสำเร็จ!";
        } else {
            $_SESSION['error'] = "เกิดข้อผิดพลาด: " . mysqli_error($conn);
        }
    } else {
        $_SESSION['error'] = "กรุณากรอกชื่อประเภทสินค้า!";
    }

    mysqli_close($conn);
    header("Location: add_product_type.php");
    exit();
}
?>
