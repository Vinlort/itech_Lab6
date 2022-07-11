<?php include "connection.php" ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Лаба2</title>
    <script>
        function action1() {
            let project = document.getElementById("project").value;
            let date = document.getElementById("date").value;
            let result = localStorage.getItem(project + " " + date);
            document.getElementById('res').innerHTML = result;
        }
        function action2() {
            let chief = document.getElementById("managerProject").value;
            let result = localStorage.getItem(chief + "Count");
            document.getElementById('res').innerHTML = result;
        }
        function action3() {
            let chief = document.getElementById("managerWorkers").value;
            let result = localStorage.getItem(chief + " Workers");
            document.getElementById('res').innerHTML = result;
        }
    </script>
	<p>Выполнил Нижник Виталий, КИУКИ-19-4 </p>
</head>

<body>
<form method="get" action="action1.php">
    <p>Вывеcти данные о выполенных задачах <select name="project" id="project" onchange=action1()>
            <?php
            include 'connection.php';
            $project = $collection->distinct("project");
            foreach ($project as $document) {
                echo "<option>";
                print($document);
                echo "</option>";
            }
            ?>
        </select>
        <select name="date" id="date" onchange=action1()>
            <?php
            include 'connection.php';
            $timeEnd = $collection->distinct("time_end");
            foreach ($timeEnd as $document) {
                echo "<option>";
                print gmdate("H:i:s Y-m-d", $document);
                echo "</option>";
            }
            ?>
            </select>
            <input type="submit" value="ОК">
    </p>
</form>
    <form method="get" action="action2.php">
        <p>Количество проектов указанного руководителя <select name="managerProject" id="managerProject" onchange=action2()>
                <?php
                include 'connection.php';
                $manager = $collection->distinct("chief");
                foreach ($manager as $document) {
                    echo "<option>";
                    print($document);
                    echo "</option>";
                }
                ?>
                </select>
                <input type="submit" value="Ок"></p>
    </form>
    <form method="get" action="action3.php">
        <p>Вывести информацию о сотрудниках руководителя: <select name="managerWorkers" id="managerWorkers" onchange=action3()>
                <?php
                include 'connection.php';
                $manager = $collection->distinct("chief");
                foreach ($manager as $document) {
                    echo "<option>";
                    print($document);
                    echo "</option>";
                }
                ?>
                </select>
                <input type="submit" value="Ок"></p>
    </form>
<div id="res"></div>
</body>

</html>