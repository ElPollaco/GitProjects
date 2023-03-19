<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pętle for zad 6 Lampa</title>
</head>
<body>
    <?php
        for($a = 1; $a <= 50; $a+=2){
            echo "<br>";
            for($b = 1; $b <= $a; $b+=2){
                echo "*";
            }
        }
    ?>
</body>
</html>
