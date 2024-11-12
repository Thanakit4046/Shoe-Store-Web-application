<?php
session_start();
include 'condb.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .custom-img {
            height: 100%;
            object-fit: cover;
        }

        .vh-1000 {
            min-height: 100vh;
        }
    </style>
</head>

<body>
    <section class="vh-1000" style="background-color: #0066CC;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card" style="border-radius: 1rem;">
                        <div class="row g-0" style="height: 100%;">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/img2.webp"
                                    alt="register form" class="img-fluid custom-img" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">

                                    <form method="POST" action="register_check.php">
                                        <div class="d-flex align-items-center mb-3 pb-1">
                                            <span class="h1 fw-bold mb-0">KMD</span>
                                        </div>

                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Create your account</h5>

                                        <div class="form-outline mb-4">
                                            <input type="text" name="name" placeholder="Enter your name" class="form-control form-control-lg" required />
                                            <label class="form-label">Name</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" name="lastname" placeholder="Enter your lastname" class="form-control form-control-lg" required />
                                            <label class="form-label">Last Name</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" name="address" placeholder="Enter your address" class="form-control form-control-lg" required />
                                            <label class="form-label">Address</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" name="telephone" placeholder="Enter your telephone number" class="form-control form-control-lg" required />
                                            <label class="form-label">Telephone</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="text" name="username" placeholder="Enter your username" class="form-control form-control-lg" required />
                                            <label class="form-label">Username</label>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="password" name="password" placeholder="Enter your password" class="form-control form-control-lg" required />
                                            <label class="form-label">Password</label>
                                        </div>

                                        <?php
                                        if (isset($_SESSION['Error']) && !empty($_SESSION['Error'])) {
                                            echo "<div class='text-danger'>";
                                            echo $_SESSION["Error"];
                                            echo "</div>";
                                            $_SESSION['Error'] = ""; // ล้างค่า Error หลังจากแสดงผลแล้ว
                                        }
                                        ?>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-dark btn-lg btn-block" type="submit">Register</button>
                                        </div>

                                        <p class="mb-5 pb-lg-2" style="color: #393f81;">Already have an account? <a href="login.php"
                                                style="color: #393f81;">Login here</a></p>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>