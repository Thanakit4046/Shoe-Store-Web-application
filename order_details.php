<?php
include 'condb.php';

if (isset($_GET['orderID'])) {
    $orderID = intval($_GET['orderID']);

    // ดึงข้อมูลรายละเอียดคำสั่งซื้อ
    $sql = "SELECT * FROM tb_order WHERE orderID = $orderID";
    $result = mysqli_query($conn, $sql);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // แสดงรายละเอียดของคำสั่งซื้อ
        echo "<h2>รายละเอียดคำสั่งซื้อ: {$row['orderID']}</h2>";
        echo "<p>ชื่อ-นามสกุล: {$row['cus_name']}</p>";
        echo "<p>ราคารวม: ฿ " . number_format($row['total_price'], 2) . "</p>";
        echo "<p>วันที่สั่งซื้อ: " . date("d-m-Y", strtotime($row['reg_date'])) . "</p>";
        // เพิ่มข้อมูลอื่น ๆ ตามต้องการ
    } else {
        echo "<p>ไม่พบคำสั่งซื้อ</p>";
    }
}
mysqli_close($conn);
?>
