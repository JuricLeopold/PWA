<?php

    session_start();
    include 'connect.php';
    define('UPLPATH', 'images/');

    if (isset($_POST['naslov'])) {
        $naslov = $_POST['naslov'];
    }
    if (isset($_POST['sazetak'])) {
        $sazetak = $_POST['sazetak'];
    }
    if (isset($_POST['sadrzaj'])) {
        $sadrzaj = $_POST['sadrzaj'];
    }
    if (isset($_POST['kategorija'])) {
        $kategorija = $_POST['kategorija'];
    }
    if (isset($_FILES['slika']['name'])) {
        $slika = $_FILES['slika']['name'];
    }
    if (isset($_POST['archive'])) {
        $archive = $_POST['archive'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Obs - article</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <header>
        <h1>L'OBS</h1>
        <nav>
            <a href="index.php">NASLOVNICA</a>
            <a href="kategorija.php?id=politika">POLITIKA</a>
            <a href="kategorija.php?id=nekretnine">NEKRETNINE</a>
            <a href="unos.php">UNOS</a>
            <?php
                if (isset($_SESSION['username']) && $_SESSION['level'] == 1) {
                    echo '<a href="administracija.php">ADMINISTRACIJA</a>';
                    echo '<a href="logout.php">ODJAVA</a>'; 
                } else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
                    echo '<a href="logout.php">ODJAVA</a>';
                } else {
                    echo '<a href="login.php">PRIJAVA</a>';
                }
            ?>
        </nav>
    </header>

    <main id="unos">
        <section>
            <h4>
                L'Obs &gt; <?php echo $kategorija ?>
            </h4>
            <h1>
                <?php echo $naslov ?>
            </h1>
            <?php echo "<img src='images/$slika'>" ?>
            <h2>
                <?php echo $sazetak ?>
            </h2>
            <div id="date">
                Napisano: <?php echo date("F j Y, G:i a") ?>
            </div>
            <p>
                <?php echo $sadrzaj ?>
            </p>
        </section>
    </main>
    
    <footer>
        <p>©L'Obs - Les marques ou contenus du site nouvelobs.com sont soumis a la protection de la propriete intellectuelle</p>
    </footer>

</body>
</html>

<?php

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (empty($_POST['naslov']) || empty($_POST['sazetak']) || empty($_POST['sadrzaj']) || empty($_POST['kategorija']) || empty($_FILES['slika']['name'])) {
            echo "";
        } else {

            include 'connect.php';

            $picture = $_FILES['slika']['name'];
            $title = $_POST['naslov'];
            $about = $_POST['sazetak'];
            $content = $_POST['sadrzaj'];
            $category = $_POST['kategorija'];
            $date = date('d.m.Y.');
            if(isset($_POST['archive'])) {
                $archive = 1;
            } else {
                $archive = 0;
            }

            $target_dir = 'images/'.$picture;
            move_uploaded_file($_FILES["slika"]["tmp_name"], $target_dir);

            $query = "INSERT INTO vijesti (datum, naslov, sazetak, tekst, slika, kategorija, arhiva ) 
            VALUES ('$date', '$title', '$about', '$content', '$picture', '$category', '$archive')";

            $result = mysqli_query($dbc, $query);
            
            mysqli_close($dbc);

        }
    }

?>

