<?php
session_start(); // เริ่มการทำงานของ session
if (!isset($_SESSION["cus_username"])) {
    header("Location: login.php");
    exit();
}

include 'condb.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>สินค้าทั้งหมด</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        .card {
            transition: all 0.3s ease-in-out;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        .card-body h5 {
            font-size: 1.25rem;
            margin-bottom: 10px;
        }

        .card-body b {
            font-size: 1.5rem;
        }

        .filter-buttons {
            margin-bottom: 20px;
        }

        .btn-category {
            background-color: #f8f9fa;
            color: #333;
            border: 2px solid #333;
            border-radius: 50px;
            padding: 10px 20px;
            margin: 0 10px;
            font-weight: bold;
            transition: all 0.3s ease;
        }

        .btn-category:hover {
            background-color: #333;
            color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-3px);
        }

        .btn-category:active {
            background-color: #555;
            border-color: #555;
            transform: translateY(0);
        }
    </style>
</head>

<body>
    <?php include "./component/menu.php"; ?>

    <!-- Filter Buttons for product types -->
    <div class="container mt-4">
        <div class="filter-buttons text-center">
            <a href="?type_id=1" class="btn btn-category">Nike</a>
            <a href="?type_id=4" class="btn btn-category">New Balance</a>
            <a href="?type_id=3" class="btn btn-category">Adidas</a>
            <a href="?type_id=2" class="btn btn-category">Vans</a>
            <a href="?type_id=5" class="btn btn-category">Converse</a>
        </div>
    </div>


    <div class="container mt-5">
        <div class="row justify-content-center">
            <?php
            // ตรวจสอบว่ามีการส่งคำค้นหาหรือประเภทสินค้ามาหรือไม่
            $searchQuery = "";
            $typeId = 0;

            if (isset($_GET['search'])) {
                $searchQuery = mysqli_real_escape_string($conn, $_GET['search']); // ป้องกัน SQL Injection
            }

            if (isset($_GET['type_id'])) {
                $typeId = intval($_GET['type_id']); // เปลี่ยนเป็น integer
            }

            // สร้าง SQL เพื่อค้นหาสินค้า
            if ($searchQuery != "") {
                $sql = "SELECT * FROM product WHERE pro_name LIKE '%$searchQuery%' ORDER BY pro_id";
            } elseif ($typeId > 0) {
                // ถ้ามี type_id ให้กรองสินค้าตามประเภท
                $sql = "SELECT * FROM product WHERE type_id = $typeId ORDER BY pro_id";
            } else {
                // ถ้าไม่มีการค้นหาและไม่มี type_id ให้แสดงสินค้าทั้งหมด
                $sql = "SELECT * FROM product ORDER BY pro_id";
            }

            $result = mysqli_query($conn, $sql);

            // แสดงผลลัพธ์
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-3 mb-4">
                        <a href="sh_product.php?id=<?= $row['pro_id'] ?>" style="text-decoration: none; color: inherit;">
                            <div class="card h-100">
                                <img src="image/<?= $row['image'] ?>" class="card-img-top" alt="<?= $row['pro_name'] ?>">
                                <div class="card-body text-center">
                                    <h5 class="text-success"><?= $row['pro_name'] ?></h5>
                                    <p class="text-muted">ID: <?= $row['pro_id'] ?></p>
                                    <p>ราคา ฿ <b class="text-danger"><?= $row['price'] ?></b></p>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php
                }
            } else {
                ?>
                <p class="text-center">ไม่พบสินค้าที่ตรงกับประเภทหรือการค้นหา</p>
            <?php
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <?php include('./component/footer.php'); ?>
</body>

</html>