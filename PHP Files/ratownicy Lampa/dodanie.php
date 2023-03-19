<?php
    if(!empty($_POST['amb-no']) && !empty($_POST['med1']) && !empty($_POST['med2']) && !empty($_POST['med3'])){
        $ambNumber = $_POST['amb-no'];
        $med1 = $_POST['med1'];
        $med2 = $_POST['med2'];
        $med3 = $_POST['med3'];

        $conn = mysqli_connect('localhost', 'root', '', 'ee09') or die("Niepowodzenie w połączeniu z bazą danych.");
        $sql = "INSERT INTO ratownicy VALUES (NULL, $ambNumber, '$med1', '$med2', '$med3');";

        $query = mysqli_query($conn, $sql);

        echo "Do bazy zostało wysłane zapytanie: $sql.";

        mysqli_close($conn);
    }
?>