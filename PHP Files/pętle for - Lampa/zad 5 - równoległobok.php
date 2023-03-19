<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pętle for zad 5 Lampa</title>
    <style>
        div{
            width: auto;
            height: auto;
            float: left;
        }
        #a{
            text-align: right;
        }
        #b{
            text-align: justify;
        }
        #c{
            text-align: left;
        }
    </style>
</head>
<body>
    <div id="a">
        <?php
            for($a = 1; $a <= 25; $a++){
                echo "<br>";
                for($b = 1; $b <= $a; $b++){
                    echo "*";
                }
            }
        ?>
    </div>
    <div id="b">
        <?php
            for($a = 1; $a <= 25; $a++){
                echo "<br>";
                for($b = 1; $b <= 50; $b++){
                    echo "*";
                }
            }
        ?>
    </div>
    <div id="c">
        <?php
            for($a = 1; $a <= 25; $a++){
                echo "<br>";
                for($b = 25; $b >= $a; $b--){
                    echo "*";
                }
            }
        ?>
    </div>
</body>
</html>
