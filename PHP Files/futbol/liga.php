<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Piłka nożna</title>
    <link rel="stylesheet" href="styl2.css">
</head>
<body>
    <div id="container">
        <header>
            <h3>Reprezentacja polski w piłce nożnej</h3>
            <img src="obraz1.jpg" alt="reprezentacja">
        </header>
        <main>
            <div id="form-block">
                <section id="left">
                    <form method="POST" action="liga.php">
                        <select name="pozycja">
                            <option value="1">Bramkarze</option>
                            <option value="2">Obrońcy</option>
                            <option value="3">Pomocnicy</option>
                            <option value="4">Napastnicy</option>
                        </select>
                        <input type="submit" value="Zobacz">
                    </form>
                    <img src="zad2.png" alt="piłka">
                    <p>Autor: 000000000000000000</p>
                </section>
                <section id="right">
                    <?php
                        if(isset($_POST['pozycja'])){
                            $conn = mysqli_connect('localhost', 'root', '', 'egzamin2');

                            $pozycja = $_POST['pozycja'];
                            $sql = "SELECT zawodnik.imie, zawodnik.nazwisko FROM zawodnik WHERE zawodnik.pozycja_id = $pozycja;";
                            $query = mysqli_query($conn, $sql);

                            echo "<ol>";
                            while($result = mysqli_fetch_array($query)){
                                echo "<li><p>$result[imie] $result[nazwisko]</p></li>";
                            }
                            echo "</ol>";
                            
                            mysqli_close($conn);
                        }
                    ?>
                </section>
            </div>
            <section id="bottom-title">
            <h3>Liga mistrzów</h3>
            </section>
            <section id="bottom-clubs">
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'egzamin2');

                    $sql = "SELECT liga.zespol, liga.punkty, liga.grupa FROM liga ORDER BY punkty DESC";
                    $query = mysqli_query($conn, $sql);
                    while($result = mysqli_fetch_array($query)){
                        echo<<<END
                            <section class="team-info">
                                <h2>$result[zespol]</h2>
                                <h1>$result[punkty]</h1>
                                <p>grupa: $result[grupa]</p>
                            </section>
                        END;
                    }

                    mysqli_close($conn);
                ?>
            </section>
        </main>
    </div>
</body>
</html>