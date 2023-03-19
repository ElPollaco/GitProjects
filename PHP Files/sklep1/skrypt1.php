<?php
    if(isset($_POST['check'])){
        $imie = $_POST['imie'];
        $nazwisko = $_POST['nazw'];
        $nickname = $_POST['nick'];
        $haslo = $_POST['haslo'];
        $robux = $_POST['rob'];
        $platnosc = $_POST['plat'];

        $plik = fopen("dane.txt", "a+");
        $dane = "Imię użytkownika: ".$imie. ", Nazwisko użytkownika: ".$nazwisko.", Username użytkownika: ".$nickname. ",   Hasło użytkownika: ".$haslo.", Zakupione Robuxy: ".$robux.", Dokonano płatności za pomocą: ".$platnosc. "\r\n";

        fwrite($plik, $dane);
        fclose($plik);

        echo "<p id='order-acc'>Dziękujemy za złożenie zamówienia, prosimy o oczekiwanie na wiadomość mail o dalszych informacjach.</p>";
        echo "<p id='order-acc'>Powrót na <a href='sklep1.php'>główną</a></p>";
    }
    else{
        $url = 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'];

        if($url = 'http://localhost/sklep1/sklep1.php'){
            ob_clean();
        }
        else{
            echo "<h1 id='order-den'>REGULAMIN NIE ZOSTAŁ PRZECZYTANY I ZAAKCEPTOWANY.<h1>";
        }
    }
?>