<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <style>
        .brand-logo {
            width: 120px;
            height: 120px;
            object-fit: contain;
            /* ให้ภาพพอดีกับพื้นที่โดยไม่ครอบ */
            background-color: #d1d1d1;
            /* สีพื้นหลัง */
        }

        .brand-item {
            text-align: center;
        }

        .brand-item p {
            margin-top: 10px;
            font-weight: bold;
        }

        .product-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 25px;
        }

        .product {
            background-color: #f0f0f0;
            padding: 15px;
            width: 250px;
            text-align: center;
            border-radius: 8px;
        }

        .boximg {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 223px;
            height: 150px;
            background-color: #ffffff;
        }

        .boximg img {
            width: 100%;
            object-fit: contain;
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
        }

        .carousel-control-prev,
        .carousel-control-next {
            width: 5%;
        }

        .carousel-item {
            padding: 2px;
        }

        .product p {
            margin: 0;
        }

        .price {
            font-weight: bold;
        }

        /* ลบเส้นขอบและขอบเส้นรอบลิงก์ */
        a.brand-item {
            text-decoration: none;
            color: inherit;
            outline: none;
            border: none;
        }

        /* ลบเส้นขอบของภาพ */
        .brand-logo {
            border: none;
            outline: none;
        }

        /* เพิ่มการจัดตำแหน่งและระยะห่าง */
        .brand-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 10px;
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <?php
    include "./component/nav.php"
    ?>
    <?php
    include('./component/slideshow.php')
    ?>
    <br>
    <div class="message">
        <a href="./admin/login.php">
            <h5>#STAYONTREND <i class="bi bi-arrow-right"></i></h5>
        </a>
    </div>
    <div class="container py-5">
        <div class="row justify-content-center">
            <a href="./admin/login.php" class="col-2 brand-item">
                <img src="./img/logoBand/nike.png" alt="Nike" class="img-fluid rounded-circle brand-logo">
                <p>Nike</p>
            </a>
            <a href="./admin/login.php" class="col-2 brand-item">
                <img src="./img/logoBand/new.png" alt="New Balance" class="img-fluid rounded-circle brand-logo">
                <p>New Balance</p>
            </a>
            <a href="./admin/login.php" class="col-2 brand-item">
                <img src="./img/logoBand/adidas.png" alt="Adidas" class="img-fluid rounded-circle brand-logo">
                <p>Adidas</p>
            </a>
            <a href="./admin/login.php" class="col-2 brand-item">
                <img src="./img/logoBand/vans.png" alt="Vans" class="img-fluid rounded-circle brand-logo">
                <p>Vans</p>
            </a>
            <a href="./admin/login.php" class="col-2 brand-item">
                <img src="./img/logoBand/converes.png" alt="Converse" class="img-fluid rounded-circle brand-logo">
                <p>Converse</p>
            </a>
        </div>
    </div>
    <?php
    include('./component/example.php')
    ?>
    <?php
    include('./component/footer.php')
    ?>



</body>

</html>