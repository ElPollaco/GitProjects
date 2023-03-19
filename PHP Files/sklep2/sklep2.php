<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sklep Internetowy - Computer City</title>
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
    <nav>
        <div class="produkty" name="karta-graficzna">
            <img src="karta-graf.png" class="image" alt="Karta graficzna RTX 3070" title="Karta graficzna RTX 3070">
            <p>Karta graficzna RTX 3070</p>
        </div>
        <div class="produkty" name="dysk-ssd">
            <img src="ssd.png" class="image" alt="Dysk Twardy SSD 1 TB" title="Dysk Twardy SSD 1 TB">
            <p>Dysk Twardy SSD 1 TB</p>
        </div>
        <div class="produkty" name="pamiec-ram">
            <img src="ram.png" class="image" id="image-ram" alt="Pamięć RAM 8GB" title="Pamięć RAM 8GB">
            <p>Pamięć RAM 8GB</p>
        </div>
        <div class="produkty" name="rpocesor">
            <img src="procesor.png" class="image" alt="Procesor Intel Core i7" title="Procesor Intel Core i7">
            <p>Procesor Intel Core i7</p>
        </div>
    </nav>
    <div id="form">
        <form action="answer.php" method="post">
            <div id="checkbox-menu">
                <table>
                    <tr>
                        <td>
                            <p>Wybierz produkty, jakie chcesz zakupić: </p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><input type="checkbox" name="elementy" value="karta-graf">Karta Graficzna</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><input type="checkbox" name="elementy" value="dysk-ssd">Dysk Twardy SSD</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><input type="checkbox" name="elementy" value="ram">Pamięć RAM</p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p><input type="checkbox" name="elementy" value="procesor">Procesor</p>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="karta-graf ukryty">
                <p>Podaj liczbę kart graficznych: <input type="number" name="karta-graf" value="0"></p>
            </div>
            <div class="dysk-ssd ukryty">
                <p>Podaj liczbę dysków twardych SSD: <input type="number" name="dysk-ssd" value="0"></p>
            </div>
            <div class="ram ukryty">
                <p>Podaj liczbę kości pamięci RAM: <input type="number" name="ram" value="0"></p>
            </div>
            <div class="procesor ukryty">
                <p>Podaj liczbę procesorów: <input type="number" name="procesor" value="0"></p>
            </div>
            <button type="submit">Złóż zamówienie</button>
        </form>
    </div>
    <footer>
        <h3>Sklep Internetowy - Computer City 2022 &copy; Wszelkie prawa zastrzeżone</h3>
    </footer>
    <script src="script2.js"></script>
</body>
</html>