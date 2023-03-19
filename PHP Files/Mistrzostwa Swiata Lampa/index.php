<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Predykcja tabelki na Mistrzostwa Świata</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div id="container">
        <div id="tables">
            <div id="group-table">
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'tabelka grupowa');
                    $sql = "SELECT * FROM `grupa c` ORDER BY Punkty DESC, 'Różnica bramek' DESC;";
                    $query = mysqli_query($conn, $sql);

                    echo<<<END
                        <h1>TABELA GRUPY C</h1>
                        <table>
                            <tr>
                                <th>L.p</th>
                                <th>Flaga</th>
                                <th>Drużyna</th>
                                <th>Rozegrane mecze</th>
                                <th>Wygrane</th>
                                <th>Remisy</th>
                                <th>Przegrane</th>
                                <th>Bramki zdobyte</th>
                                <th>Bramki stracone</th>
                                <th>Różnica bramek</th>
                                <th>Punkty</th>
                            </tr>
                    END;

                    $i = 1; // zmienna która będzie przypisana jako liczba pozycyjna

                    // wypisanie tabeli nr 1 z zespołami
                    while($result = mysqli_fetch_array($query)){
                        echo<<<END
                        <tr>
                            <td>$i</td>
                            <td><img src="$result[1]"></td>
                            <td>$result[0]</td>
                            <td>$result[2]</td>
                            <td>$result[3]</td>
                            <td>$result[4]</td>
                            <td>$result[5]</td>
                            <td>$result[6]</td>
                            <td>$result[7]</td>
                            <td>$result[8]</td>
                            <td><b>$result[9]</b></td>
                        </tr>
                        END;
                        $i++;
                    }
                    echo<<<END
                        </table>
                    END;

                    mysqli_close($conn);
                ?>
            </div>
            <div id="match-table">
                <?php
                    $conn = mysqli_connect('localhost', 'root', '', 'tabelka grupowa');

                    echo<<<END
                        <h1>Mecze grupowe</h1>
                        <table>
                            <tr>
                                <th>L.p</th>
                                <th>Drużyna 1</th>
                                <th>Drużyna 2</th>
                                <th>Stadion</th>
                                <th>Godzina</th>
                                <th>Wynik</th>
                            </tr>
                    END;

                    $sql2 = "SELECT * FROM mecze";
                    $query2 = mysqli_query($conn, $sql2);

                    // wypełnienie tabeli nr 2 o najbliższych meczach
                    while($result2 = mysqli_fetch_array($query2)){
                        echo<<<END
                            <tr>
                                <td>$result2[0]</td>
                                <td>$result2[1]</td>
                                <td>$result2[2]</td>
                                <td>$result2[3]</td>
                                <td>$result2[4]</td>
                                <td>$result2[5]</td>
                            </tr>
                        END;
                    }
                    echo "</table>";

                    mysqli_close($conn);
                ?>
            </div>
        </div>
        <div id="betting">
            <form method="GET" action="index.php" id="betting-form">
                    <?php
                        echo<<<END
                            <h1>Ustaw zakład i wygraj pieniądze!</h1>
                            <table>
                                <tr>
                                    <th>Numer meczu</th>
                                    <th>Drużyna 1</th>
                                    <th>Remis</th>
                                    <th>Drużyna 2</th>
                                    <th>Wynik</th>
                                </tr>
                                <tr>
                        END;
                        $conn = mysqli_connect('localhost', 'root', '', 'tabelka grupowa');

                        $sql3 = "SELECT `id`, `drużyna 1`, `drużyna 2` FROM mecze;";
                        $query3 = mysqli_query($conn, $sql3);
                        $i = 1; // zmienna $i do prawidłowego ustawiania input radio

                        // wypisanie tabeli nr3 o zakładach danymi zespołami
                        while($result3 = mysqli_fetch_array($query3)){
                            echo<<<END
                                <td name="numerMeczu">$result3[id]</td>
                                <td>
                                    $result3[1]<br><input type="radio" name="rezultatMeczu$i">
                                </td>
                                <td><input type="radio" name="rezultatMeczu$i"></td>
                                <td>
                                    $result3[2]<br><input type="radio" name="rezultatMeczu$i">
                                </td>
                                <td><input type="text" name="wynik$i" pattern="[0-9]:[0-9]" placeholder="Wpisz dane w formacie: l:l, np. 3:0, 2:1."></td>
                            </tr>
                            END;

                            $i++;
                        }
                        echo "</table>";
                        echo "<input type='submit' value='ZATWIERDŹ ZAKŁADY'><br>";

                        mysqli_close($conn);
                        ?>
                </table>
            </form>
            <div id="results">
                <?php
                    ob_start(); // funkcja weryfikująca czyszczenie wiadomości echo/print - początek (w tym momencie zbiera wszystkie echo, jakie wystąpiły)

                    $conn = mysqli_connect('localhost', 'root', '', 'tabelka grupowa');
                    $sql4 = "SELECT `id`, `drużyna 1`, `drużyna 2` FROM mecze;";
                    $query4 = mysqli_query($conn, $sql4);
                    $i = 1; // licznik $i z poprzedniego skryptu php

                    while($result4 = mysqli_fetch_array($query4)){
                        if(empty($_GET['rezultatMeczu' . $i]) || empty($_GET['wynik' . $i])){ // jeśli jakakolwiek opcja nie bedzie zaznaczona
                            ob_end_clean(); // funkcja weryfikująca czyszczenie wiadomości echo/print - koniec (w tym momencie czyści wszystkie echo, jakie wystąpiły)
                            echo "<br><span class='error'>Dla każdego meczu zaznacz jedną z 3 opcji, a następnie wpisz typowany wynik.</span>"; // i tu nowa wiadomość
                            break;
                        }
                        else{
                            // pobranie wyniku meczu i przekształcenie w tabelę
                            $wynikMeczu = $_GET['wynik' . $i];
                            $scoreArray = str_split($wynikMeczu);

                            // weryfikacja wyników pomiędzy drużynami
                            switch(true){
                                case ($scoreArray[0] > $scoreArray[2]):
                                    $zwroc = "Twoja predykcja: $result4[1] pokona drużynę $result4[2] wynikiem $wynikMeczu.<br>";
                                    break;
                                case ($scoreArray[0] < $scoreArray[2]):
                                    $zwroc = "Twoja predykcja: $result4[1] zostanie pokonana przez drużynę $result4[2] wynikiem $wynikMeczu.<br>";
                                    break;
                                case ($scoreArray[0] == $scoreArray[2]):
                                    $zwroc = "Twoja predykcja: $result4[1] zremisuje z drużyną $result4[2] wynikiem $wynikMeczu.<br>";
                                    break;
                            }
                            echo $zwroc;

                            require_once("verifyArrayNumber.php");

                            foreach ($scoreArray as $arrayValue){
                                if(!is_numeric($arrayValue)){
                                    continue;
                                }
                                else{
                                    $randNumber = rand(0, 9999);
                                    $newScoreArray = array(0 => 0, 1 => ":", 2 => 0);

                                    switch(true){
                                        case ($randNumber >= 0 && $randNumber < 5000): // 50% szans na 1 gol lub brak bramek
                                            $randScore = rand(0, 1);
                                            echo "Liczba wylowowana to: $randNumber. Pokaże się $randScore.<br>";
                                            verifyArrayNumber($randScore, $newScoreArray);                                        
                                            break;
                                        case ($randNumber >= 5000 && $randNumber < 7500): // 25% szans na 2 gole
                                            $randScore = 2;
                                            echo "Liczba wylowowana to: $randNumber. Pokaże się $randScore.<br>"; 
                                            verifyArrayNumber($randScore, $newScoreArray);                                        
                                            break;
                                        case ($randNumber >= 7500 && $randNumber < 8750): // 12.5% szans na 3 gole
                                            $randScore = 3;
                                            echo "Liczba wylowowana to: $randNumber. Pokaże się $randScore.<br>";  
                                            verifyArrayNumber($randScore, $newScoreArray);                                      
                                            break;
                                        case ($randNumber >= 8750 && $randNumber < 9375): // 6.25% szans na 4 gole
                                            $randScore = 4;
                                            echo "Liczba wylowowana to: $randNumber. Pokaże się $randScore.<br>";
                                            verifyArrayNumber($randScore, $newScoreArray);                                         
                                            break;
                                        case ($randNumber >= 9375 && $randNumber < 9688): // 3.125% (zaokrąglone do przodu) szans na 5 goli
                                            $randScore = 5;
                                            echo "Liczba wylowowana to: $randNumber. Pokaże się $randScore.<br>"; 
                                            verifyArrayNumber($randScore, $newScoreArray);                                       
                                            break;
                                        case ($randNumber >= 9688 && $randNumber <= 9999): // 3.125% (zaokrąglone do przodu) szans na od 6 do 9 goli
                                            $randScore = rand(6, 9);
                                            echo "Liczba wylowowana to: $randNumber. Pokaże się $randScore.<br>";
                                            verifyArrayNumber($randScore, $newScoreArray);
                                            break;
                                    }   
                                }
                            }
                    
                            // dodanie wiadomości o sukcesie dla działania programu
                            if($i == 6){
                                echo "<br><span class='success'>działa</span><br>";
                            }
                            $i++;
                        }
                    }
                    mysqli_close($conn);
                ?>
            </div>
        </div>
    </div>
</body>
</html>