<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zamawianie okien</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        <header>
            <h1>Okienka</h1>
        </header>
        <main>
            <section id="left">
                <form method="GET" action="index.php" enctype=”text/plain”>
                    <label>Wysokość okna:</label>
                    <input type="number" step="0.01" min="70" max="90" name="wys"><br>
                    <label>Szerokość okna:</label>
                    <input type="number" step="0.01" min="70" max="90" name="szer"><br>
                    <label>Uchwyt:</label><br>
                    <input type="radio" name="uchwyt" value="prawy">Prawy
                    <input type="radio" name="uchwyt" value="lewy">Lewy<br>
                    <label>Kolor:</label><br>
                    <select id="kolor" name="kolor">
                        <option value="biały">Biały</option>
                        <option value="czarny">Czarny</option>
                        <option value="zółty dąb">Żółty dąb</option>
                        <option value="antracyt">Antracyt</option>
                    </select><br>
                    <input type="submit" value="Zatwierdź"></button>
                </form>
            </section>
            <section id="right">
                <form method="POST" action="index.php" enctype=”text/plain”>
                    <h2>Panel logowania</h2>
                    <label>Login<label>
                    <input name="login">
                    <label>Hasło<label>
                    <input type="password" name="haslo"><br>
                    <input type="submit" value="ZALOGUJ SIĘ">
                    <?php
                        if(!isset($_POST['login']) && !isset($_POST['haslo'])){
                            echo "<br>Nie udało się zalogować, brak danych.";
                        }
                        else{
                            if($_POST['login'] != 'OKNA' && $_POST['haslo'] != 'OKNA'){
                                echo '<br>Nieprawidłowe dane logowania. Spróbuj jeszcze raz.';
                            }
                            else{
                                echo<<<END
                                <p>Zmień cenę wybranego wymiaru</p>
                                <label>Wysokość:</label>
                                <input type="number" step="0.01" name="newWys">
                                <label>Szerokość:</label>
                                <input type="number" step="0.01" name="newSzer">
                                <label>Nowa cena:</label>
                                <input type="number" step="0.01" name="newCena"><br>
                                <input type="submit" value="Zatwierdź">
                                END;
                            }
                        }
                    ?>
                    <?php
                        if(!isset($_POST['newWys']) && !isset($_POST['newSzer']) && !isset($_POST['newCena'])){
                            echo "<br>Brak danych do dodania nowej wartości.";
                        }
                        else{   
                            $newWys = $_POST['newWys'];
                            $newSzer = $_POST['newSzer'];
                            $newCena = $_POST['newCena'];

                            $conn = mysqli_connect('localhost', 'root', '', 'okna');
                        
                            $sql = "UPDATE okna SET `$newSzer` = $newCena WHERE wys = $newWys;";
                            $query = mysqli_query($conn, $sql);

                            echo "<br>Zmiana ceny wykonana powodzeniem!";
                            $conn->close();
                        }
                    ?>
                </form>
            </section>
            <div id="wynik">
                <?php
                    if(!isset($_GET['wys']) || !isset($_GET['szer']) || !isset($_GET['uchwyt']) || !isset($_GET['kolor'])){
                        echo "<br>Brak danych.";
                    }
                    else{
                        $wys = $_GET['wys'];
                        $szer = $_GET['szer'];
                        $uchwyt = $_GET['uchwyt'];
                        $kolor = $_GET['kolor'];

                        $conn = mysqli_connect('localhost', 'root', '', 'okna');

                        $sql = "SELECT okna.$szer FROM okna WHERE okna.wys = $wys;";
                        $query = mysqli_query($conn, $sql);

                        while($res = mysqli_fetch_array($query)){
                            $wiadomosc = "Okno o wymiarach $wys x $szer metrów kwadratowych z uchwytem " . $uchwyt . "m i kolorem o nazwie $kolor kosztuje " . round($res[$szer], 2) . " zł.";
                            echo $wiadomosc;

                            echo<<<END
                            <br><br>
                            <a href="mailto: jakub0705@interia.pl?body=$wiadomosc">
                                <input type="button" id="zamow" value="ZAMÓW">
                            </a><br>
                            END;
                        }

                        $conn->close();
                    }
                ?>
            </div>
        </main>
        <footer>
            <p>Stworzył: Jakub Lampa 2022 &copy Wszelkie prawa zastrzeżone</p>
        </footer>
    </div>
</body>
</html>