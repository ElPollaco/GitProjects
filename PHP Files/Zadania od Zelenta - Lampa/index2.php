<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Dziennik szkolny</title>
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<h1>Zadanie 3</h1>
<form method="GET" action="index2.php">
    <?php
        $conn = mysqli_connect('localhost', 'root', '', 'szkola');

        if(!$conn){
            echo "Błąd połączenia!";
            exit();
        }
        else{
            $sql3 = "SELECT klasa.nazwa FROM klasa ORDER BY klasa.nazwa ASC;";
            $query3 = mysqli_query($conn, $sql3);

            echo<<<END
            <label>Wybierz klasę:</label><br>
            <select name="klasy">
            END;

            while($result3 = mysqli_fetch_assoc($query3)){
                echo "<option>$result3[nazwa]</option>";
            }

            echo<<<END
            </select><br>
            <input type='submit' value='Pokaż oceny'>
            END;
        }

        if(empty($_GET['klasy'])){
            echo "<br>Brak wybranej klasy!";
            exit();
        }
        else{
            $conn = mysqli_connect('localhost', 'root', '', 'szkola');

            if(!$conn){
                echo "Błąd połączenia!";
                exit();
            }
            else{
                $klasa = $_GET['klasy'];

                $sql = "SELECT uczen.Imie, uczen.Nazwisko, uczen.Srednia_ocen FROM uczen JOIN klasa ON klasa.id = uczen.id_klasy WHERE klasa.nazwa = '$klasa' ORDER BY uczen.Nazwisko ASC;";
                $query = mysqli_query($conn, $sql);

                if(!$query){
                    echo "Nieprawidłowa kwerenda!";
                    exit();
                }
                else{
                    $liczbaPorzadkowa = 1;

                    $sql1 = "SELECT klasa.nazwa, wychowawca.imie, wychowawca.nazwisko FROM klasa JOIN wychowawca ON wychowawca.id_klasy = klasa.id WHERE klasa.nazwa = '$klasa';";
                    $query1 = mysqli_query($conn, $sql1);

                    if(!$query1){
                        echo "Nieprawidłowa kwerenda!";
                        exit();
                    }
                    else{
                        $result1 = mysqli_fetch_assoc($query1);
                        echo "<p>Wychowawca: $result1[imie] $result1[nazwisko]</p>";
                    }

                    echo<<<END
                    <table>
                        <th>L.p.</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>Średnia ocen</th>
                    END;

                    while($result = mysqli_fetch_array($query)){
                        echo "<tr>";
                        echo "<td>$liczbaPorzadkowa</td>";
                        echo "<td>$result[Imie]</td>";
                        echo "<td>$result[Nazwisko]</td>";
                        echo "<td>$result[Srednia_ocen]</td>";
                        echo "<tr>";
        
                        $liczbaPorzadkowa++;
                    }

                    echo<<<END
                    </table>
                    END;
        
                    $sql2 = "SELECT AVG(uczen.Srednia_ocen) AS Srednia_klasowa FROM uczen JOIN klasa ON klasa.id = uczen.id_klasy WHERE klasa.nazwa = '$klasa';";
                    $query2 = mysqli_query($conn, $sql2);
                    $result2 = mysqli_fetch_array($query2);
        
                    echo "<br>Średnia klasowa wynosi: " . round($result2['Srednia_klasowa'], 2);
        
                    $conn->close();
                }
            }
        }
    ?>
</form><br>
<a href="insert.php">Wprowadź nowe dane</a>
</body>
</html>