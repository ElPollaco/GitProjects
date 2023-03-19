<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pętle for zad 8a Lampa</title>
    <style>
        table{
            width: 500px;
            height: 500px;
            border-collapse: collapse;
        }
        td{
            width: 10%;
            height: 10%;
            border: 2px solid black;
            text-align: center;
        }
    </style>
</head>
<body>
    <table>
        <?php
            for($a = 1; $a <= 10; $a++){
                if($a % 2 == 0){
                    echo "<tr class='even'>";
                    echo "<style>
                    .even{
                        background-color: yellow;
                    }
                    </style>";
                }
                else{
                    echo "<tr class='odd'>";
                    echo "<style>
                    .odd{
                        background-color: orange;
                    }
                    </style>";
                }
                for($b = 1; $b <= 10; $b++){
                    echo "<td>";
                    echo $a * $b;
                    echo "</td>";
                }
            }
        ?>
    </table>
</body>
</html>
