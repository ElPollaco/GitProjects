<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portiernia</title>
    <link rel="stylesheet" href="style.css">
    <link rel="icon" href="klucz-icon.png">
</head>
<body>
    <div id="container">
        <header>
            <a href="index.php" title="Strona główna"><h1>Portiernia - <em>Hotel Vistula</em></h1></a>
        </header>
        <nav>
            <a href="index.php" title="Strona główna">Strona główna</a>
            <a href="#" title="Strona hotelu">Strona hotelu</a>
            <a href="#" title="O nas">O nas</a>
            <a href="#" title="FAQ">FAQ</a>
        </nav>
        <main>
            <section>
                <form method="POST" action="index.php">
                    <fieldset>
                        <div class="form">
                            <legend>Rezerwacja klucza</legend>
                            <label>Imię: </label><br>
                            <input name="imie" type="text"><br>
                            <label>Nazwisko: </label><br>
                            <input name="nazwisko" type="text"><br>
                            <label>Stanowisko: </label><br>
                            <select name="stanowisko">
                                <option>Właściciel</option>
                                <option>Pracownik</option>
                                <option>Klient</option>
                            </select><br>
                            <label>Wybierz klucz do pokoju: </label><br>
                            <?php
                                require 'fill.php';
                            ?>
                            <legend>Dodatkowe dane</legend><br>
                            <label>Miasto zamieszkania: </label><br>
                            <input name="miasto" type="text"><br>
                            <label>Telefon: </label><br>
                            <input name="tel" min="9" max="9" type="text"><br>
                            <input type="submit" value="Rezerwuj klucz">
                        </div>
                        <div class="wynik">
                        <?php
                            // FUNCTION: Funkcja wprowadza użytkownika do bazy danych i zmienia status zajęcia klucza.

                            // Podfunkcja tworząca użytkownika i dodająca go do bazy danych.
                            function addUser($conn, $imie, $nazw, $klucz, $rezultat){
                                $sqlMain = "SELECT klucze.id, klucze.Zajety FROM klucze WHERE klucze.id = $klucz;";
                                $queryMain = mysqli_query($conn, $sqlMain);

                                // sprawdza, czy wyznaczony przez nas klucz jest zajęty
                                while($resultMain = mysqli_fetch_assoc($queryMain)){
                                    if($resultMain['Zajety'] == 1){
                                        echo "<br><span class='error'>Ten klucz jest już zajęty, spróbuj ponownie później.</span>";
                                    }
                                    else{
                                        // aktualizuje klucz na posiadany przez użytkownika
                                        $sqlAdd = "UPDATE osoby SET osoby.Id_klucza = $klucz WHERE osoby.Imię = '$imie' AND osoby.Nazwisko = '$nazw';";
                                        $queryAdd = mysqli_query($conn, $sqlAdd);

                                        // i aktualizuje status klucza na zajęty (z 0 na 1)
                                        $sqlKey = "UPDATE klucze SET klucze.zajety = 1 WHERE klucze.id = $klucz;";
                                        $queryKey = mysqli_query($conn, $sqlKey);
                                        echo "<br><span class='success'>Klucz do pokoju nr $rezultat[nr_pokoju] uzyskano z powodzeniem!</span>";
                                    }
                                }
                            }

                            // Weryfikacja występowania zmiennych w formularzu.
                            if(empty($_POST["imie"]) || empty($_POST["nazwisko"]) || empty($_POST["stanowisko"]) || empty($_POST["klucz_do_pokoju"]) || empty($_POST["miasto"]) || empty($_POST["tel"])){
                                echo "<br><span class='error'>Brak danych. Proszę uzupełnić.</span>";
                            }
                            else{
                                // Tworzenie zmiennych.
                                $imie = $_POST['imie'];
                                $nazw = $_POST['nazwisko'];
                                $stanow = $_POST['stanowisko'];
                                $klucz = $_POST['klucz_do_pokoju'];
                                $miasto = $_POST['miasto'];
                                $tel = $_POST['tel'];

                                // Łączenie.
                                $conn = mysqli_connect('localhost', 'root', '', 'portiernia');
                                
                                // Tworzenie kwerendy analizującej przynależność zmiennej $klucz do id klucza.
                                $sqlVer = "SELECT klucze.id, klucze.id_pokoju, pokoje.nr_pokoju FROM klucze JOIN pokoje ON pokoje.Id = klucze.id_pokoju WHERE pokoje.nr_pokoju = '$klucz';";
                                $queryVer = mysqli_query($conn, $sqlVer);

                                // Sprawdzenie ze zgodnością wszystkich wyników w bazie na podst. kwerendy.
                                while($resultVer = mysqli_fetch_array($queryVer)){
                                    // Sprawdza zależności nazw pokojów do ich identyfikatorów.
                                    switch(true){
                                        case ($klucz == $resultVer['id']):
                                            $klucz = $resultVer['id'];
                                            break;
                                        case($klucz + 1 == $resultVer['id']):
                                            $klucz = $resultVer['id'];
                                            break;
                                        // BUG: 2 ostatnie case'y wywołują Warning o innym typie zmiennej $klucz, zignorować, gdyż sprawnie to działa.
                                        case($klucz == '3A' && $resultVer['id'] == 3):
                                            $klucz = $resultVer['id'];
                                            break;
                                        case($klucz == '3B' && $resultVer['id'] == 4):
                                            $klucz = $resultVer['id'];
                                            break;
                                    }

                                    // Sprawdza zależność id kluczy do stanowisk i opisów (patrz: baza danych 'portiernia')
                                    switch(true){
                                        // Dla nieprawidłowych zgodnie z kluczem, wyświetla błąd i nie wprowadza użytkownika do bazy danych.
                                        case (($klucz == 1 || $klucz == 2) && $stanow != 'Właściciel'):
                                            echo "<br><span class='error'>Nie jesteś właścicielem hotelu, nie masz dostępu do tych pokoi.</span>";
                                            break;
                                        case (($klucz >= 3 && $klucz <= 4) && $stanow == 'Klient'):
                                            echo "<br><span class='error'>Nie pracujesz w hotelu, nie masz dostępu do tych pokoi.</span>";
                                            break;
                                        case ($klucz == 5):
                                            echo "<br><span class='error'>Klucz nie jest na razie dostępny, wyrabiamy go.</span>";
                                            break;
                                        case ($klucz == 8):
                                            echo "<br><span class='error'>Klucz do pokoju hotelowego nr $resultVer[nr_pokoju] jest zgubiony, tym samym nie możemy przyznać dostępu do tego pokoju. Niezmiernie przepraszamy.</span>";
                                            break;
                                        case ($klucz == 11):
                                            echo "<br><span class='error'>Klucz do pokoju hotelowego nr $resultVer[nr_pokoju] jest wyłamany, tym samym nie możemy przyznać dostępu do tego pokoju. Niezmiernie przepraszamy.</span>";
                                            break;
                                        default:
                                        // W innym przypadku, sprawdza, czy użytkownik istnieje w bazie danych.
                                            $sqlUsers = "SELECT * FROM osoby WHERE Imię = '$imie' AND nazwisko = '$nazw';";
                                            $queryUsers = mysqli_query($conn, $sqlUsers);

                                            if(mysqli_num_rows($queryUsers) == 0){ //jeżeli użytkownik nie istnieje
                                                $sqlAdd = "INSERT INTO osoby VALUES(NULL, '$imie', '$nazw', '$stanow', NULL, '$miasto', '$tel');"; // dodaje nowego użytkownika bez klucza
                                                $queryAdd = mysqli_query($conn, $sqlAdd);

                                                addUser($conn, $imie, $nazw, $klucz, $resultVer); // Odniesienie do podfunkcji
                                            }
                                            elseif(mysqli_num_rows($queryUsers) > 0){ // jeżeli użytkownik istnieje, sprawdza, czy wypożyczył już jakiś klucz
                                                $sqlKeyCheck = "SELECT klucze.id, klucze.Zajety, osoby.Imię, osoby.Nazwisko, pokoje.Nr_pokoju FROM klucze JOIN osoby ON klucze.Id = osoby.Id_klucza JOIN pokoje ON pokoje.id = klucze.id_pokoju WHERE klucze.Zajety = 1 AND osoby.Imię = '$imie' AND osoby.Nazwisko = '$nazw';";
                                                $queryKeyCheck = mysqli_query($conn, $sqlKeyCheck);

                                                if(mysqli_num_rows($queryKeyCheck) == 0){
                                                    // gdy nie ma, robi to samo, jak wyżej dla przypadku, gdy użytkownik nie istnieje
                                                    addUser($conn, $imie, $nazw, $klucz, $resultVer); // Odniesienie do podfunkcji
                                                }
                                                else{
                                                    while($resultKeyCheck = mysqli_fetch_assoc($queryKeyCheck)){
                                                        if($resultKeyCheck['Zajety'] == 1){ // przypadek, gdy użytkownik posiada już zajęty klucz
                                                            echo "<span class='error'>Posiadasz już zajęty klucz. Najpierw zwróć obecnie posiadany klucz nr $resultKeyCheck[id] (pokój nr $resultKeyCheck[Nr_pokoju]), a potem wypożycz nowy.</span>";
                                                        }
                                                    }
                                                }
                                            }                                               
                                        }
                                }
                                $conn->close();
                            }
                        ?>
                        </div>
                    </fieldset>
                </form>
            </section>
            <section>
                <form method="POST" action="index.php">
                    <fieldset>
                        <div class="form">
                            <legend>Oddanie klucza</legend>
                            <label>Imię: </label><br>
                            <input name="returnName" type="text"><br>
                            <label>Nazwisko: </label><br>
                            <input name="returnSurname" type="text"><br>
                            <label>Wybierz klucz, który chcesz zwrócić: </label><br>
                            <?php
                                require 'fill.php';
                            ?>
                            <input type="submit" value="Zwróć klucz">
                        </div>
                        <div class="wynik">
                            <?php
                                if(empty($_POST['returnName']) || empty($_POST['returnSurname']) || empty($_POST['klucz_do_pokoju'])){
                                    echo "<br><span class='error'>Brak danych. Proszę uzupełnić.</span>";
                                }
                                else{
                                    $zwrImie = $_POST['returnName'];
                                    $zwrNazw = $_POST['returnSurname'];
                                    $zwrKlucz = $_POST['klucz_do_pokoju'];

                                    $conn = mysqli_connect('localhost', 'root', '', 'portiernia');

                                    $sqlVer = "SELECT klucze.id, klucze.id_pokoju, pokoje.nr_pokoju FROM klucze JOIN pokoje ON pokoje.Id = klucze.id_pokoju WHERE pokoje.nr_pokoju = '$zwrKlucz';";
                                    $queryVer = mysqli_query($conn, $sqlVer);

                                    while($resultVer = mysqli_fetch_array($queryVer)){
                                        switch(true){
                                            case ($zwrKlucz == $resultVer['id']):
                                                $zwrKlucz = $resultVer['id'];
                                                break;
                                            case($zwrKlucz + 1 == $resultVer['id']):
                                                $zwrKlucz = $resultVer['id'];
                                                break;
                                            case($zwrKlucz == '3A' && $resultVer['id'] == 3):
                                                $zwrKlucz = $resultVer['id'];
                                                break;
                                            case($zwrKlucz == '3B' && $resultVer['id'] == 4):
                                                $zwrKlucz = $resultVer['id'];
                                                break;
                                        }
                                    }

                                    $sqlUsers = "SELECT * FROM osoby WHERE Imię = '$zwrImie' AND nazwisko = '$zwrNazw';";
                                    $queryUsers = mysqli_query($conn, $sqlUsers);

                                    if($queryUsers){ 
                                        if(mysqli_num_rows($queryUsers) == 0){
                                            echo "<br><span class='error'>Nie ma takiego użytkownika w bazie danych.</span>";
                                        }
                                        else{
                                            $sqlKeyCheck = "SELECT klucze.id, klucze.Zajety, osoby.Imię, osoby.Nazwisko, pokoje.Nr_pokoju FROM klucze JOIN osoby ON klucze.Id = osoby.Id_klucza JOIN pokoje ON pokoje.id = klucze.id_pokoju WHERE klucze.Zajety = 1 AND osoby.Imię = '$zwrImie' AND osoby.Nazwisko = '$zwrNazw';";
                                            $queryKeyCheck = mysqli_query($conn, $sqlKeyCheck);

                                            if(mysqli_num_rows($queryKeyCheck) == 0){
                                                echo "<br><span class='error'>Nie posiadasz żadnego klucza przy sobie. Spróbuj ponownie później.</span>";
                                            }
                                            else{
                                                while($resultKeyCheck = mysqli_fetch_assoc($queryKeyCheck)){
                                                    if($resultKeyCheck['id'] != $zwrKlucz){
                                                        echo "<br><span class='error'>Nie posiadasz klucza nr $zwrKlucz z pokoju $_POST[klucz_do_pokoju] do zwrotu. Może ktoś inny go posiada?</span>";
                                                    }
                                                    else{
                                                        $sqlUpdateKey = "UPDATE klucze SET klucze.zajety = 0 WHERE klucze.id = $zwrKlucz;";
                                                        $sqlUpdateUser = "UPDATE osoby set osoby.Id_klucza = NULL WHERE osoby.Imię = '$zwrImie' AND osoby.Nazwisko = '$zwrNazw';";

                                                        $queryUpdateKey = mysqli_query($conn, $sqlUpdateKey);
                                                        $queryUpdateUser = mysqli_query($conn, $sqlUpdateUser);

                                                        echo "<span class='success'>Oddano klucz $zwrKlucz z pokoju $_POST[klucz_do_pokoju] z powodzeniem!</span>";
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    $conn->close();
                                }
                            ?>
                        <div>
                    </fieldset>
                </form>
            </section>
        </main>
        <footer>
            <p><em>Hotel Vistula</em> &copy 2022 - Firma należy do Kacpra Mysłowca - Wszelkie prawa zastrzeżone</p>
        </footer>
    </div>
</body>
</html>