
<?php 
header('Content-Type: application/json');
$date = $_GET['date'] ?? null;
$tasker_id=$_GET['tasker_id'];
$arr[]=$date;
$arr[]=$tasker_id;
echo json_encode($date ? array_merge($arr) : ["11:00"]);
