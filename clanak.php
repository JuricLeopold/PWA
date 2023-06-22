<?php
    session_start();
    include 'connect.php';
    define('UPLPATH', 'images/');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Obs - članak</title>
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
        <?php

            $id = $_GET['id'];
            $query = "SELECT * FROM vijesti WHERE id = $id";
            $result = mysqli_query($dbc, $query);

            if ($row = mysqli_fetch_array($result)) {
                ?>
                <section>
                    <h4>
                        L'Obs &gt; <span><?php echo $row['kategorija']; ?></span>
                    </h4>
                    <h1>
                        <?php echo $row['naslov']; ?>
                    </h1>
                    <img src="<?php echo UPLPATH . $row['slika']; ?>">
                    <h2>
                        <i><?php echo $row['sazetak']; ?></i>
                    </h2>
                    <div id="date">
                        Napisano: <span><?php echo $row['datum']; ?></span>
                    </div>
                    <p>
                        <?php echo $row['tekst']; ?>
                    </p>
                </section>
                <?php
            } else {
                echo "No results found.";
            }
        ?>
    </main>

    
    <footer>
        <p>©L'Obs - Les marques ou contenus du site nouvelobs.com sont soumis a la protection de la propriete intellectuelle</p>
    </footer>

</body>
</html>