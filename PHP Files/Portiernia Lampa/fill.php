<?php
    // FUNCTION: Funkcja wypisuje zgodnie z kwerendą wszystkie pokoje w tagu <option>.

    // Łączenie.
    $conn = mysqli_connect('localhost', 'root', '', 'portiernia');

    // Tworzenie kwerendy.
    $sql = "SELECT pokoje.nr_pokoju FROM pokoje JOIN klucze ON klucze.id_pokoju = pokoje.id ORDER BY pokoje.id ASC;";
    $query = mysqli_query($conn, $sql);

    // Tworzenie echo do HTML, cz. 1.
    echo<<<END
    <select name="klucz_do_pokoju">
    END;

    // Wypisywanie wszystkich pokoi.
    while($result = mysqli_fetch_assoc($query)){
        echo "<option>$result[nr_pokoju]</option>";
    }

    // Tworzenie echo do HTML, cz. 2
    echo<<<END
    </select><br><br><br>
    END;

    // Zamknięcie połączenia.
    $conn->close();
?>