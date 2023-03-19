<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep Internetowy - Computer City - Wyniki</title>
    <link rel="stylesheet" href="style2.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,400;0,700;1,400&display=swap" rel="stylesheet">
    <link rel="icon"  href="C.ico">
</head>
<body>
    <header>
        <h1>Computer City</h1>
        <a href="sklep2.php" alt="Computer City - Strona Główna" title="Computer City - strona Główna">
            <img src="logo.png" class="image" id="header-image" alt="Computer City - Strona Główna" title="Computer City - strona Główna">
        </a>
    </header>
    <?php
    $karta = $_POST["karta-graf"];
    $dysk = $_POST["dysk-ssd"];
    $ram = $_POST["ram"];
    $proc = $_POST["procesor"];

    $karta_c = 2000;
    $dysk_c = 500;
    $ram_c = 250;
    $proc_c = 1750;

    $cena = ($karta * $karta_c) + ($dysk * $dysk_c) + ($ram * $ram_c) + ($proc * $proc_c);

    echo<<<END
        <div id="wynik">
            <div id="wynik-main">
                <p>Cena twojego zamówienia wynosi: $cena PLN.</p>
            </div><br/><br/>
            <table>
                <tr>
                    <th><p>Produkt</p></th>
                    <th><p>Ilość</p></th>
                    <th><p>Cena (PLN)</p></th>
                </tr>
                <tr>
                    <td><p>Karta graficzna</p></td>
                    <td><p>$karta</p></td>
                    <td><p>$karta_c</p></td>
                </tr>
                <tr>
                    <td><p>Dysk twardy SSD</p></td>
                    <td><p>$dysk</p></td>
                    <td><p>$dysk_c</p></td>
                </tr>
                <tr>
                    <td><p>Pamięć RAM</p></td>
                    <td><p>$ram</p></td>
                    <td><p>$ram_c</p></td>
                </tr>
                <tr>
                    <td><p>Procesor</p></td>
                    <td><p>$proc</p></td>
                    <td><p>$proc_c</p></td>
                </tr>
            </table>
            <p><a href="sklep2.php" title="Powrót do strony głównej">Powrót do menu głównego</a></p>
        </div>
    END
    ?>
</body>
</html>