<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal społecznościowy</title>
    <link rel="stylesheet" href="styl5.css">
</head>
<body>
    <main>
        <header id="head-left">
            <h2>Nasze osiedle</h2>
        </header>
        <header id="head-right">
            <?php
                $conn = mysqli_connect('localhost', 'root', '', 'portal');
                $sql = "SELECT COUNT(*) FROM dane;";

                $query = mysqli_query($conn, $sql);
                $result = mysqli_fetch_array($query);

                echo "<h5>Liczba użytkowników portalu: $result[0]<h5>";
                
                mysqli_close($conn);
            ?>
        </header>
        <section id="sec-left">
            <h3>Logowanie</h3>
            <form action="uzytkownicy.php" method="post">
                <label for="login">login:</label>
                <input type="text" id="login" name="login">
                <label for="pass">hasło:</label>
                <input type="password" id="pass" name="pass">
                <input type="submit" value="Zaloguj">
            </form>
        </section>
        <section id="sec-right">
            <h3>Wizytówka</h3>
            <?php
                if(isset($_POST['login']) && isset($_POST['pass']) && !empty($_POST['login']) && !empty($_POST['pass'])){
                    $login = $_POST['login'];
                    $haslo = $_POST['pass'];

                    $conn = mysqli_connect('localhost', 'root', '', 'portal');
                    $sql = "SELECT uzytkownicy.haslo FROM uzytkownicy WHERE uzytkownicy.login = '$login';";

                    $query = mysqli_query($conn, $sql);
                    if(mysqli_num_rows($query) == 0){
                        echo "Login nie istnieje";
                    }
                    else{
                        while($result = mysqli_fetch_array($query)){
                            if(sha1($haslo) != $result[0]){
                                echo "Hasło nieprawidłowe";
                            }
                            else{
                                $sql2 = "SELECT uzytkownicy.login, dane.rok_urodz, dane.przyjaciol, dane.hobby, dane.zdjecie FROM uzytkownicy JOIN dane ON dane.id = uzytkownicy.id WHERE uzytkownicy.login = '$login';";
                                $query2 = mysqli_query($conn, $sql2);

                                $result2 = mysqli_fetch_array($query2);

                                echo<<<END
                                    <article id="visitor">
                                        <img src="$result2[4]">
                                END;
                                echo '<h4>'. $result2[0] .' ('. date('Y') - $result2[1] . ')</h4>';
                                echo<<<END
                                        <p>hobby: $result2[3]</p>
                                        <h1><img src="icon-on.png">$result2[2]</h1>
                                        <a href="dane.html"><button id="vis-button">Więcej informacji</button></a>
                                    </article>
                                END;
                            }
                        }
                    }

                    mysqli_close($conn);
                }
            ?>
        </section>
        <footer>
            Stronę wykonał: 03250700896
        </footer>
    </main>
</body>
</html>