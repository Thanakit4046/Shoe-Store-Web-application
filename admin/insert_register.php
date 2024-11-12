<?php
// เปิดการแสดงข้อผิดพลาด
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'condb.php';  // เชื่อมต่อฐานข้อมูล

// รับข้อมูลจากฟอร์ม
$firstname = $_POST['name'];
$lastname = $_POST['lastname'];
$telephone = $_POST['telephone'];
$username = $_POST['username'];
$password = $_POST['password'];

// เข้ารหัสรหัสผ่านเพื่อความปลอดภัย
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// กำหนดค่าเริ่มต้นสำหรับ status
$status = '1';

// ตรวจสอบว่ามีการส่งข้อมูลครบถ้วนหรือไม่
if (!empty($firstname) && !empty($lastname) && !empty($telephone) && !empty($username) && !empty($password)) {
    // คำสั่งเพิ่มข้อมูลลงในตาราง tb_employee
    $sql = "INSERT INTO tb_employee (name, lastname, telephone, username, password, status) 
            VALUES ('$firstname', '$lastname', '$telephone', '$username', '$hashed_password', '$status')";

    $result = mysqli_query($conn, $sql);  // ส่งคำสั่งไปยังฐานข้อมูล
    if ($result) {
        echo "เพิ่มข้อมูลสำเร็จ";
        echo "<script>window.location.href='employee.php';</script>";  // เปลี่ยนไปยังหน้า employee.php หลังจากเพิ่มข้อมูลสำเร็จ
        exit();  // หยุดการทำงานหลังจากเปลี่ยนหน้า
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);  // แสดงข้อผิดพลาดถ้ามี
        echo "<script>alert('ไม่สามารถบันทึกข้อมูลได้');</script>";
    }
} else {
    echo "กรุณากรอกข้อมูลให้ครบถ้วน";
}

mysqli_close($conn);  // ปิดการเชื่อมต่อฐานข้อมูล

?>