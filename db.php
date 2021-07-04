<?php

include 'config.php';

try {
  $pdo = new PDO("mysql:host=".DB_HOST.";dbname=".DB_NAME, DB_USER, DB_PASS, [
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"
  ]);
  //echo "Connected to $dbname at $host successfully.";
} catch (PDOException $pe) {
  die("Could not connect to the database ".DB_NAME." :" . $pe->getMessage());
}


function insert_record($db, $opts) {
  $sql = 'INSERT INTO records (namespace, data) VALUES (:namespace, :data)';
  $stmt = $db->prepare($sql);
  $executed = $stmt->execute([
    'namespace' => $opts['namespace'],
    'data' => $opts['data']
  ]);
  return $db->lastInsertId();
}