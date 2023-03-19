<?php
    echo "Zadanie 1<br>";
    $tablicaA = array("0", 2 => "2", 17 => "17", 5 => "5", 6 => "6");
    $tablicaA[] = "18";
    $tablicaA[1] = "1";

    print_r($tablicaA);

    echo "<br><br>Zadanie 2<br>";
    echo<<<END
    <form method="GET" action="tablice.php">
        <h3>Który index z tablicy z zadania 1 chcesz wyśwtelić?</h3>
        <input type="number" name="number">
        <input type="submit" value="POTWIERDŹ">
    </form>
    END;

    if(isset($_GET['number'])){
        $liczba = $_GET['number'];
        $dl = count($tablicaA);

        if($liczba >= 0 && $liczba == $tablicaA[$liczba]){
            echo "Indeks nr $tablicaA[$liczba] reprezentuje liczbę $liczba.";
        }
        else{
            echo "Nie ma takiego indeksu w tablicy!";
        }
    }
    else{
        echo "Brak indeksu!";
    }

    echo "<br><br>Zadanie 3<br>";
    echo "<hr>";


    $tablicaC = array();
    $liczbaC = "0";
    $indeks = 3;

    for($i = 0; $i < 30; $i++){
        $tablicaC += array($indeks => "$liczbaC");
        $indeks++;
    }
    print_r($tablicaC);
    echo "<hr>";


    $tablicaD = array();
    $liczbaD = "0";
    $indeks = 3;

    for($i = 0; $i < 30; $i++){
        $tablicaD += array($indeks => "$liczbaD");
        $indeks++;
        $liczbaD++;
    }
    print_r($tablicaD);
    echo "<hr>";


    $tablicaE = array();
    $liczbaE = "0";
    $indeks = 3;

    for($i = 0; $i < 30; $i++){
        $tablicaE += array($indeks => "$liczbaE");
        $indeks++;
        $liczbaE+=2;
    }
    print_r($tablicaE);
    echo "<hr>";


    $tablicaF = array();
    $indeks = 3;

    for($i = 0; $i < 30; $i++){
        $liczbaF = rand(20, 30);
        $tablicaF += array($indeks => "$liczbaF");
        $indeks++;
    }
    print_r($tablicaF);

    echo "<hr>";
    echo "<br><br>Zadanie 4<br>";
    echo<<<END
    <form method="GET" action="tablice.php">
        Ile liczb ma zawierać tablica?<br>
        <input type="number" min="1" name="dlug"><br>
        <input type="submit" value="STWÓRZ"><br>
    </form>
    END;

    if(!isset($_GET['dlug'])){
        echo "Brak wskazanej długości tablicy!";
    }
    else{
        $dlug = $_GET['dlug'];
        $tablicaWlasna = [];

        for($i = 0; $i < $dlug; $i++){
            $liczLos = rand(1, 20);
            $tablicaWlasna[] += $liczLos;
        }
        print_r($tablicaWlasna);
        echo "<br>Największa wartość tablicy to: " . max($tablicaWlasna);
        echo "<br>Najmniejsza wartość tablicy to: " . min($tablicaWlasna);

        $suma = array_sum($tablicaWlasna);
        if($suma % 2 == 0){
            echo "<br>Suma wszystkich wartości tablicy wynosi: <span style='color: red'>$suma</span>";
        }
        else{
            echo "<br>Suma wszystkich wartości tablicy wynosi: <span style='color: blue'>$suma</span>";
        }

        if($dlug >= 4){
            echo "<br><br>Usuwany element o indeksie nr 4 to liczba $tablicaWlasna[4].";
            unset($tablicaWlasna[4]);
            echo "<br>Po usunięciu, tablica zmieniła się na taką:<br>";
            print_r($tablicaWlasna);
        }
        else{
            echo "<br>Ta tablica nie ma liczby o indeksie nr 4.";
        }

        echo "<br><br>Dodana do końca tablicy zostanie liczba 99.";
        array_push($tablicaWlasna, 99);
        echo "<br>Po dodaniu nowej wartości, tablica zmieniła się na taką:<br>";
        print_r($tablicaWlasna);

        echo "<br><br>Dodana na początek tablicy zostanie liczba 111.";
        array_unshift($tablicaWlasna, 111);
        echo "<br>Po dodaniu nowej wartości, tablica zmieniła się na taką:<br>";
        print_r($tablicaWlasna);

        $ilIndeksow = count($tablicaWlasna);
        echo "<br><br>Po zmodyfikowaniu tablicy, tablica ta jest $ilIndeksow-elementowa.";
    }
?>