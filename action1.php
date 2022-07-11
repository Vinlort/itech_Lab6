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
        if (isset($_GET['project']) && isset($_GET['date'])) {
            include 'connection.php';
            $project = $_GET['project'];
            $date = $_GET['date'];
            $time_end = strtotime($date)+7200;
            $cursor = $collection->find(
                [
                    'project' => $project,
                    'time_end' => $time_end
                ]
            );
            $key = $project . " " . $date;
            $res = "<ol>";
            foreach ($cursor as $document) {
                $title = $document['title'];
                $description = $document['description'];
                $worker = $document['worker'];
                $time_start =  $document['time_start'];
                $time_start = gmdate("H:i:s Y-m-d", $time_start);
                $time_end = $document['time_end'];
                $time_end = gmdate("H:i:s Y-m-d", $time_end);
                $chief = $document['chief'];
                if (is_object($worker)) {
                    $worker = (array)$worker;
                    $worker = (implode(', ', $worker));
                }
                $res = $res . "Название: $title, описание $description, работники $worker, проект $project, менеджер: $chief, начало: $time_start, конец:$time_end";
            }
            $res = $res . "</ol>";
            echo $res;
            echo "<script> localStorage.setItem('$key', '$res');</script>";
        }
        ?>
</body>
</html>