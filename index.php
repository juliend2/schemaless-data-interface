<?php
include 'db.php';
$stmt = $pdo->prepare("
    SELECT namespace, count(*) AS n_rows 
    FROM records 
    GROUP BY namespace 
    ORDER BY namespace
");
$stmt->execute(); 
$rows = $stmt->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Schemaless</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>
    <div class="container">
        <p>
            <a href="new.php">New Record</a>
        </p>
        <table>
            <tr>
                <th>Namespace</th>
                <th>Number of records</th>
            </tr>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td>
                        <?php echo $row['namespace'] ?>
                    </td>
                    <td>
                        <?php echo $row['n_rows'] ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
</body>
</html>