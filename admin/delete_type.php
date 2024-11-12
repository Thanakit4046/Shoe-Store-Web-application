<?php
include 'condb.php';

// ตรวจสอบว่ามีการส่งค่า id มาหรือไม่
if (isset($_GET['id'])) {
    $type_id = $_GET['id'];

    // ลบข้อมูลประเภทสินค้าจากฐานข้อมูล
    $sql = "DELETE FROM type WHERE type_id = $type_id";
    if (mysqli_query($conn, $sql)) {
        // ลบสำเร็จ กลับไปที่หน้า type_management.php
        header("Location: type_management.php");
    } else {
        // ถ้าลบไม่สำเร็จ แสดงข้อผิดพลาด
        echo "เกิดข้อผิดพลาดในการลบ: " . mysqli_error($conn);
    }

    mysqli_close($conn);
} else {
    // ถ้าไม่มีการส่งค่า id มา กลับไปที่หน้า type_management.php
    header("Location: roduct_type_list.php");
}
?>
