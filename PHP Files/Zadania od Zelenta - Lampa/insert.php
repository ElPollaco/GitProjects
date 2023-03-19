<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8">
    <title>Dziennik szkolny</title>
    <meta http-equiv="X-Ua-Compatible" content="IE=edge">
    <link rel="stylesheet" href="main.css">
</head>
<body>
<h1>Zadanie 4</h1>
<form method="POST" action="insert.php">
    <label>Wprowadź dane dla nowego ucznia</label><br><br><br>
    <label>Imię:</label><br>
    <input name="Imie" minlength="2"><br>
    <label>Nazwisko:</label><br>
    <input name="Nazwisko" minlength="2"><br>
    <label>Średnia:</label><br>
    <input type="number" name="Srednia" step="0.01" min="1" max="6"><br>
    <?php
        $conn = mysqli_connect('localhost', 'root', '', 'szkola');

        if(!$conn){
            echo "Błąd połączenia!";
            exit();
        }
        else{
            $sql = "SELECT klasa.nazwa FROM klasa;";
            $query = mysqli_query($conn, $sql);

            echo<<<END
            <label>Klasa:</label><br>
            <select name='klasy'>
            END;

            while($result = mysqli_fetch_assoc($query)){
                echo "<option>$result[nazwa]</option>";
            }

            echo<<<END
            </select><br>
            <input type="submit" value="Dodaj ucznia">
            END;
        }

        if(empty($_POST['Imie']) || empty($_POST['Nazwisko']) || empty($_POST['Srednia']) || empty($_POST['klasy'])){
            echo "<br>Brakuje pewnych danych. Proszę spróbować jeszcze raz.";
            exit();
        }
        else{
            $imie = $_POST['Imie'];
            $nazwisko = $_POST['Nazwisko'];
            $srednia = $_POST['Srednia'];
            $klasa = $_POST['klasy'];

            echo "$imie, $nazwisko, $srednia, $klasa";

            $sqlGet = "SELECT klasa.id FROM klasa JOIN uczen ON klasa.id = uczen.id_klasy;";
            $queryGet = mysqli_query($conn, $sqlGet);
            $resultGet = mysqli_fetch_assoc($queryGet);

            $sql = "INSERT INTO uczen VALUES (NULL, '$nazwisko', '$imie', $srednia, $resultGet[id]);";
            $query = mysqli_query($conn, $sql);
            if(!$query){
                echo "<br>Nieprawidłowa kwerenda!";
                exit();
            }
            else{
                echo "<br>Dodanie zakończone sukcesem!";
            }
        }
    ?>
</form>
<p>Wróć do:</p>
<a href="index.php">Zadania 1</a>
<a href="index1.php">Zadania 2</a>
<a href="index2.php">Zadania 3</a>
</body>
</html>