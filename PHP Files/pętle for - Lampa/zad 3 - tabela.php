<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pętle for zad 3 Lampa</title>
    <style>
        table, td{
            border: 1px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
    <?php
        echo "<table>";
        for($a = 1; $a <= 13; $a++){
            echo "<tr>";
            echo "<td>";
            echo $a;
            echo "</td>";
            echo "</tr>";
        }
        echo "</table>";
    ?>
</body>
</html>
