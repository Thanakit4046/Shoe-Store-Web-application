<?php
header('Content-Type: application/json');
include 'condb.php';

$sqlQuery = "SELECT * FROM product ORDER BY pro_id";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>