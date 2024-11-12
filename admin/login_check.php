<?php
include 'condb.php';
session_start();
$user = $_POST["username"];
$password = $_POST["password"];

// ค้นหาข้อมูลผู้ใช้จากตาราง tb_employee (สำหรับ Admin)
$sql = "SELECT * FROM tb_employee WHERE username ='$user'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($row) {
    // ตรวจสอบรหัสผ่านสำหรับ Admin
    if (password_verify($password, $row["password"])) {
        // หากรหัสผ่านถูกต้อง
        $_SESSION["emp_username"] = $row["username"];
        $_SESSION["emp_userid"] = $row["id"];
        $_SESSION["emp_name"] = $row["name"];
        $_SESSION["lastName"] = $row["lastname"];
        $_SESSION["Error"] = "";
        header("Location: admin.php"); // ไปที่หน้า admin (หลังบ้าน)
        exit();
    } else {
        // หากรหัสผ่านไม่ถูกต้อง
        $_SESSION["Error"] = "username หรือ password ไม่ถูกต้อง";
        header("Location: login.php");
        exit();
    }
} else {
    // หากไม่พบใน tb_employee ให้ค้นหาต่อใน tb_customer (สำหรับลูกค้า)
    $sql = "SELECT * FROM tb_customer WHERE username ='$user'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if ($row) {
        // ตรวจสอบรหัสผ่านสำหรับลูกค้า
        if (password_verify($password, $row["password"])) {
            // หากรหัสผ่านถูกต้อง
            $_SESSION["cus_username"] = $row["username"];
            $_SESSION["cus_userid"] = $row["id"];
            $_SESSION["cus_name"] = $row["name"];
            $_SESSION["lastName"] = $row["lastname"];
            $_SESSION["Error"] = "";
            header("Location: ../main.php"); // ไปที่หน้า main (หน้าบ้าน)
            exit();
        } else {
            // หากรหัสผ่านไม่ถูกต้อง
            $_SESSION["Error"] = "username หรือ password ไม่ถูกต้อง";
            header("Location: login.php");
            exit();
        }
    } else {
        // หากไม่พบผู้ใช้ทั้งใน tb_employee และ tb_customer
        $_SESSION["Error"] = "username หรือ password ไม่ถูกต้อง";
        header("Location: login.php");
        exit();
    }
}

mysqli_close($conn);
?>
