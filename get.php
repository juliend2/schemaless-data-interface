<?php
include 'db.php';
$records = get_all_by_namespace($pdo, $_GET['namespace']);
$data = $records;
header('Content-Type: application/json');
echo json_encode($data);
die;