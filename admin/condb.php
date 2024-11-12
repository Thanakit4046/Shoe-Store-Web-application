
<?php
$servername = "localhost";  // หรือ IP Address ของเซิร์ฟเวอร์
$username = "root";         // Username ของฐานข้อมูล
$password = "";             // Password ของฐานข้อมูล
$dbname = "database";  // ชื่อฐานข้อมูลของคุณ

// สร้างการเชื่อมต่อ
$conn = new mysqli($servername, $username, $password, $dbname);

// ตรวจสอบการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
