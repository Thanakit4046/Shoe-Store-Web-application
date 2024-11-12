<?php
include 'condb.php';
$p_name = $_POST['pname'];
$typeID = $_POST['typeID'];
$price = $_POST['price'];
$num = $_POST['num'];

//อัพโหลดรูปภาพ
if (is_uploaded_file($_FILES['file1']['tmp_name'])) {
    $new_image_name = 'pr_' . uniqid() . "." . pathinfo(basename($_FILES['file1']['name']), PATHINFO_EXTENSION);
    $image_upload_path = "../image/" . $new_image_name;
    move_uploaded_file($_FILES['file1']['tmp_name'], $image_upload_path);
} else {
    $new_image_name = "";
}
//คำสั่งเพิ่มข้อมูลในตาราง product
$sql = "INSERT INTO product (pro_name,type_id,price,amount,image) 
VALUES ('$p_name', '$typeID', '$price', '$num', '$new_image_name')";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script> alert('บันทึกข้อมูล'); </script>";
    echo "<script> window.location='addproduct.php'; </script>";
} else {
    echo "ไม่สำเร็จ";
}
