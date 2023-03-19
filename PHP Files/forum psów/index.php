<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="language" content="PL">
    <link rel="stylesheet" href="styl.css">
    <title>Forum o psach</title>
</head>
<body>
    <header>
        <h1>Forum miłośników psów</h1>
    </header>
    <section id="lewy">
        <img src="Avatar.png" alt="Użytkownik forum">
        <?php
            $connect = mysqli_connect('localhost', 'root', '', 'forumpsy');

            $kw = "SELECT konta.nick, konta.postow, pytania.pytanie FROM konta JOIN pytania ON pytania.konta_id = konta.id WHERE konta.id = 1;";
            $zap = mysqli_query($connect, $kw);

            while($wynik = mysqli_fetch_array($zap)){
                echo "<h4>Użytkownik: " . $wynik[0] . "</h4>";
                echo "Liczba postów: " . $wynik[1] . "<br>";
                echo $wynik[2];
            }
            mysqli_close($connect);
        ?>
        <video controls loop>
            <source src="video.mp4" type="video/mp4"></source>
        </video>
    </section>
    <section id="prawy">
        <form method="post" action="index.php">
            <textarea rows="4" cols="40" name="tekst"></textarea><br>
            <input type="submit" value="Dodaj odpowiedź"/>
        </form>
        <?php
            $wiadomosc = $_POST['tekst'];

            if(isset($wiadomosc) && !empty($wiadomosc)){

                $connect = mysqli_connect('localhost', 'root', '', 'forumpsy');
                $kw = "INSERT INTO odpowiedzi VALUES(null, 1, 5, '$wiadomosc')";

                mysqli_query($connect, $kw);
            }
            else{
                echo "Brak danych w polu formularza!";
            }
        ?>
        <h2>Odpowiedzi na pytanie</h2>
        <?php
            $connect = mysqli_connect('localhost', 'root', '', 'forumpsy');

            $kw = "SELECT odpowiedzi.id, odpowiedzi.odpowiedz, konta.nick FROM odpowiedzi JOIN konta ON konta.id = odpowiedzi.konta_id WHERE odpowiedzi.Pytania_id = 1;";
            $zap = mysqli_query($connect, $kw);

            echo "<ol>";
            while($wynik = mysqli_fetch_array($zap)){
                echo "<li>" . $wynik[1] . " <i>" . $wynik[2] . "</i>" . "</li>";
                echo "<hr>";
            }
            echo "</ol>";
            mysqli_close($connect);
        ?>
    </section>
    <footer>
        Autor: Jakub Lampa
        <a href="http://mojestrony.pl" target="_blank">Zobacz nasze realizacje</a>
    </footer>
</body>
</html>