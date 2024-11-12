<?php
include 'condb.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // ลบรูปภาพจากโฟลเดอร์ก่อน
    $sql = "SELECT image FROM product WHERE pro_id = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    $image = $row['image'];

    if (file_exists("../image/" . $image)) {
        unlink("../image/" . $image); // ลบรูปภาพจากโฟลเดอร์
    }

    // ลบข้อมูลสินค้าออกจากฐานข้อมูล
    $sql = "DELETE FROM product WHERE pro_id = '$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<script>alert('ลบสินค้าสำเร็จ');</script>";
        echo "<script>window.location='product.php';</script>";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
