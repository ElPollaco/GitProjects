<?php
    $i = 0;
    if(!isset($_COOKIE['ciastek'])){
        setcookie('ciastek', "$i", time() + 60 * 60 * 24);
    }
    else{
        $i = ++$_COOKIE['ciastek'];
        setcookie('ciastek', "$i", time() + 60 * 60 * 24);
    }
?>
<!DOCTYPE html>
<html lang="en" value="html">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cookies</title>
</head>
<body>
    <p>
        <?php
            if(isset($_COOKIE['ciastek']) && $_COOKIE['ciastek'] == 1){
                echo "Odwiedziłeś dziś tą stronę " . $_COOKIE['ciastek'] . " raz.";
            }
            elseif(isset($_COOKIE['ciastek']) && $_COOKIE['ciastek'] > 1){
                echo "Odwiedziłeś dziś tą stronę  " . $_COOKIE['ciastek'] . " razy.";
            }
        ?>
    </p>
    <hr>
    <form method="GET" action="index.php">
        <input type="text" name="tekst">
        <input type="submit" value="Wyślij zapytanie">
        <div id="w-zap">
            <?php
                if(empty($_GET['tekst'])){
                    echo "<p>Brak nazwy! Proszę wprowadzić nazwę ciasteczka.</p>";
                }
                else{
                    $tekst = $_GET['tekst'];

                    if(!isset($_COOKIE["$tekst"])){
                        setcookie("$tekst", "<p>Stworzono ciasteczko o nazwie $tekst.</p>", time() + 60 * 60);
                    }
                    else{
                        setcookie("$tekst", "<p>Ciasteczko o nazwie $tekst już istnieje.</p>", time() + 60 * 60);
                    }
                    echo $_COOKIE["$tekst"];
                }
            ?>
        </div>
    </form>
    <hr>
    <br>
    <form>
        <input type="text" id="napis" value="kliknij">
        <button>PRZYCISK</button>
        <div id="wyn-js">
            <p></p>
        </div>
    </form>
    <script src="ciastek.js"></script>
</body>
</html>