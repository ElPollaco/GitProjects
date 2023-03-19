<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Dziennik szkolny</title>
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">
    <link rel="stylesheet" href="main.css">

</head>
<body>
<h1>Zadanie 1</h1>
<form>
    <label>Wpisz nazwę klasy<label><br>
    <input name="klasy" placeholder="Wpisz nazwę klasy">
    <input type="submit" value="Pokaż oceny">
</form>
<?php
    if(empty($_GET['klasy'])){
        echo "<br>Brak wybranej klasy!";
        exit();
    }
    else{
        $conn = mysqli_connect('localhost', 'root', '', 'szkola');

        if(!$conn){
            echo "<br>Błąd połączenia!";
            exit();
        }
        else{
            $klasa = $_GET['klasy'];

            $sql1 = "SELECT uczen.Imie, uczen.Nazwisko, uczen.Srednia_ocen FROM uczen JOIN klasa ON klasa.id = uczen.id_klasy WHERE klasa.nazwa = '$klasa' ORDER BY uczen.Nazwisko ASC;";
            $query1 = mysqli_query($conn, $sql1);
            
            if(!$query1){
                echo "<br>Nierpawidłowa kwerenda!";
                exit();
            }
            else{
                if(mysqli_num_rows($query1) == 0){
                    echo "<br>Brak danych dla danej klasy w bazie danych!";
                    exit();
                }
                else{
                    $liczbaPorzadkowa = 1;

                    echo<<<END
                    <table>
                    <th>L.p.</th>
                    <th>Imię</th>
                    <th>Nazwisko</th>
                    <th>Średnia ocen</th>
                    END;

                    while($result1 = mysqli_fetch_array($query1)){
                        echo "<tr>";
                        echo "<td>$liczbaPorzadkowa</td>";
                        echo "<td>$result1[Imie]</td>";
                        echo "<td>$result1[Nazwisko]</td>";
                        echo "<td>$result1[Srednia_ocen]</td>";
                        echo "<tr>";

                        $liczbaPorzadkowa++;
                    }
                    echo "</table>";

                    $sql2 = "SELECT AVG(uczen.Srednia_ocen) AS Srednia_klasowa FROM uczen JOIN klasa ON klasa.id = uczen.id_klasy WHERE klasa.nazwa = '$klasa';";
                    $query2 = mysqli_query($conn, $sql2) or die('Kwerenda nieprawidłowa.');
                    $result2 = mysqli_fetch_array($query2);

                    echo "<br>Średnia klasowa wynosi: " . round($result2['Srednia_klasowa'], 2);

                    $conn->close();
                }
            }
        }
    }
?><br><br>
<a href="insert.php">Wprowadź nowe dane</a>
</body>
</html>