<?php
include 'db.php';
$records = get_all_by_namespace($pdo, $_GET['namespace']);
$data = $records;
header('Content-Type: application/json;charset=utf-8');

// Is Asking for a JSONP answer?
if (isset($_GET['callback']) && $_GET['callback'] != '') {

    // Example:
    // http://localhost/schemaless/get.php?namespace=bobjoie&callback=func
    echo $_GET['callback']."(". json_encode($data) . ')';
    
} else {
    // Only JSON:

    // Example:
    // http://localhost/schemaless/get.php?namespace=bobjoie
    echo json_encode($data);
}

die;