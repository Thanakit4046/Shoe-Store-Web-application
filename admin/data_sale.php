<?php
header('Content-Type: application/json');
include 'condb.php';

$sqlQuery = "SELECT SUM(total_price)as sumTotal,dateMonth FROM tb_order GROUP BY dateMonth ORDER BY dateMonth";

$result = mysqli_query($conn,$sqlQuery);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

mysqli_close($conn);

echo json_encode($data);
?>