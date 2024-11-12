

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="container text-center">
    <form method="POST" action="insert_member.php "></form>
    <label > ชื่อ</label>
    <input type="text" name="fname" class="form-control" placeholder="...ชื่อ" require > <br>
    <label > นามสกุล</label>
    <input type="text" name="lname" class="form-control" placeholder="...นามสกุล" require > <br>
    <label > เบอร์โทร</label>
    <input type="text" name="telephone" class="form-control" placeholder="...เบอร์โทร" require > <br>
    <input type="submit" value="submit" class="btn-success">
    <a href="" class="btn btn-danger">Cancel</a>
</div>
</body>
</html>