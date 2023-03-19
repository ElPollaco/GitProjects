<?php
    if(!$_COOKIE['ciasteczko']){
        setcookie("ciasteczko", "<b>Dzień dobry! Strona lotniska używa ciasteczek</b>", time() + 60*60*2);    
    }
    else{
        setcookie("ciasteczko", "<i>Witaj ponownie na stronie lotniska</i>", time() + 60*60*2);    
    } 
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Port lotniczy</title>
    <link rel="stylesheet" href="styl5.css">
</head>
<body>
    <div id="container">
        <header>
            <div id="banner-left">
                <img src="zad5.png" alt="logo lotnisko">
            </div>
            <div id="banner-mid">
                <h1>Przyloty</h1>
            </div>
            <div id="banner-right">
                <h3>przydatne linki</h3>
                <a href="00000000000000000000/kwerendy.txt">Pobierz...</a>
            </div>
        </header>
        <main>
            <table>
                <tr>
                    <th>Czas</th>
                    <th>Kierunek</th>
                    <th>Numer rejsu</th>
                    <th>Status</th>
                </tr>
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'egzamin lampa');
                    $sql = "SELECT czas, kierunek, nr_rejsu, status_lotu FROM przyloty ORDER BY czas ASC;";
                    $query = mysqli_query($conn, $sql);

                    while($wynik = mysqli_fetch_array($query)){
                        echo<<<END
                            <tr>
                                <td>$wynik[0]</td>
                                <td>$wynik[1]</td>
                                <td>$wynik[2]</td>
                                <td>$wynik[3]</td>
                            </tr>
                        END;
                    }

                    mysqli_close($conn);
                ?>
            </table>
        </main>
        <footer>
            <div id="footer-left">
                <p>
                    <?php
                        echo $_COOKIE['ciasteczko'];
                    ?>
                </p>
            </div>
            <div id="footer-right">
                Autor: 000000000000000000000000
            </div>
        </footer>
    </div>
</body>
</html>