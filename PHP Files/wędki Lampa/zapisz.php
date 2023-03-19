<?php
    if(!empty($_POST['im']) && !empty($_POST['naz']) && !empty($_POST['adr'])){
        $conn = mysqli_connect('localhost', 'root', '', 'wedkowanie2');

        $im = $_POST['im'];
        $naz = $_POST['naz'];
        $adr = $_POST['adr'];

        $sql = "INSERT INTO karty_wedkarskie VALUES (NULL, '$im', '$naz', '$adr', NULL, NULL);";
        $query = mysqli_query($conn, $sql);

        mysqli_close($conn);

        header("Location: karta.html");
    }
?>