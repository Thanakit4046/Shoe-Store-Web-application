<?php
session_start();
include 'condb.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $address = $_POST['address'];
    $telephone = $_POST['telephone'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Hash รหัสผ่านก่อนบันทึกลงฐานข้อมูล
    $password_hashed = password_hash($password, PASSWORD_DEFAULT);

    // ตรวจสอบว่าชื่อผู้ใช้ซ้ำหรือไม่
    $check_user = "SELECT * FROM tb_customer WHERE username = '$username'";
    $result = mysqli_query($conn, $check_user);

    if (!$result) {
        // Debug การทำงานของ Query
        echo "Error: " . mysqli_error($conn);
        exit();
    }

    if (mysqli_num_rows($result) > 0) {
        $_SESSION["Error"] = "Username นี้มีคนใช้งานแล้ว";
        header("Location: register.php");
        exit();
    } else {
        // บันทึกข้อมูลผู้ใช้ใหม่ลงฐานข้อมูล
        $sql = "INSERT INTO tb_customer (name, lastname, address, telephone, username, password)
                VALUES ('$name', '$lastname', '$address', '$telephone', '$username', '$password_hashed')";

        if (mysqli_query($conn, $sql)) {
            // Debug หลังจากบันทึกข้อมูลสำเร็จ
            echo "User added successfully!";
            
            $_SESSION["emp_username"] = $username;
            $_SESSION["emp_name"] = $name;
            $_SESSION["emp_userid"] = mysqli_insert_id($conn);

            // ตรวจสอบการใช้ header() ว่ามีปัญหาหรือไม่
            header("Location: login.php");
            exit(); // ใส่ exit หลังจาก header เพื่อหยุดการประมวลผลของโค้ดที่เหลือ
        } else {
            // แสดง Error หากเกิดปัญหาในการบันทึกข้อมูล
            $_SESSION["Error"] = "เกิดข้อผิดพลาด: " . mysqli_error($conn);
            header("Location: register.php");
            exit();
        }
    }
}

mysqli_close($conn);
