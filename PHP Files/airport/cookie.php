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
    if(isset($_COOKIE['ciastko'])){
        echo "Miło nam, że znów nas odiwedziłeś";
    }
    else{
        setcookie('ciastko',time()+3600*2);
        echo "Dzień dobry! Sprawdź regulamin naszej strony";
    }
    ?>
</body>
</html>