<?php
include 'db.php';

$errors = [];

if ($_POST) {
    var_dump($_POST);
    $res = insert_record($pdo, $_POST['record']);
    // var_dump($res);
    if ($res) {
        header('Location: index.php');
    } else {
        $errors[] = "There was an error while inserting the data";
    }
    die;
} else {

    $stmt = $pdo->prepare("
        SELECT namespace, count(*) AS n_rows 
        FROM records 
        GROUP BY namespace 
        ORDER BY namespace
    ");
    $stmt->execute(); 
    $namespaces = $stmt->fetchAll();

}

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
            <a href="index.php">Back</a>
        </p>
        <?php if (!empty($errors)): ?>
        <p>
            <?php foreach ($errors as $err): ?>
                <?php echo $err ?>
            <?php endforeach ?>
        </p>
        <?php endif ?>
        <form action="new.php" method="post">
            <select name="" id="namespaces" onchange="setSibling(this)">
                <option value="">None</option>
                <?php foreach ($namespaces as $ns): ?>
                    <option value="<?php echo $ns['namespace'] ?>"><?php echo $ns['namespace'] ?></option>
                <?php endforeach ?>
            </select>
            <input type="text" name="record[namespace]" placeholder="Namespace"><br>
            <textarea name="record[data]" id="data" cols="30" rows="10" placeholder='{"key":"value..."}'></textarea><br>
            <button>Save</button>
        </form>
        
    </div>
    <script>
        function setSibling(selectElement) {
            const input = selectElement.nextElementSibling
            console.log('value', selectElement.value, input)
            input.value = selectElement.value
        }
    </script>
</body>
</html>