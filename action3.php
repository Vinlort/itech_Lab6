<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
if (isset($_GET['managerWorkers'])) {
    include 'connection.php';
    $chief = $_GET['managerWorkers'];
    $cursor = $collection->find(
        [
            'chief' => $chief
        ]
    );
    $key = $chief . " Workers";
    $count = 0;
    $res = "Сотрудники руководителя $chief: ";
    foreach ($cursor as $document) {
        $worker = $document['worker'];
        $manager = $document['chief'];
        if (is_object($worker)) {
            $worker = (array)$worker;
            $worker = (implode('; ', $worker));
        }
    }
    echo $res;
    echo "<script> localStorage.setItem('$key', '$res');</script>";
}
?>
</body>
</html>