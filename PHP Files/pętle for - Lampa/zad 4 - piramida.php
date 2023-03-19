<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pętle for zad 4 Lampa</title>
    <style>
        div{
            width: 400px;
            height: 400px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div>
        <?php
            for($a = 1; $a <= 25; $a++){
                echo "<br>";
                for($b = 1; $b <= $a; $b++){
                    echo "*";
                }
            }
        ?>
    </div>
</body>
</html>
