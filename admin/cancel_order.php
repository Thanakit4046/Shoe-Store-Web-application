<?php
include 'condb.php';
$ids= $_GET['id'];

$sql="UPDATE tb_order SET order_status = 0 WHERE orderID='$ids' ";
$result=mysqli_query($conn,$sql);
if ($result) {
    echo "<script>alert('ยกเลิกใบสั่งซื้อเรียบร้อย');</script>";
    echo "<script>window.location='report_order.php';</script>";
} else {
    echo "Error: " . mysqli_error($conn);  // แสดง error SQL
}


mysqli_close($conn);

?>