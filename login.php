<?php

    session_start();
    include 'connect.php';
    define('UPLPATH', 'images/');

    if (isset($_POST['submit'])) {
        $uspjesnaPrijava = false;
        $admin = false;
        $imeKorisnika = '';

        $prijavaImeKorisnika = $_POST['username'];
        $prijavaLozinkaKorisnika = $_POST['lozinka'];

        $sql = "SELECT korisnicko_ime, lozinka, razina FROM korisnik WHERE korisnicko_ime = ?";
            
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $prijavaImeKorisnika);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }
        
        mysqli_stmt_bind_result($stmt, $imeKorisnika, $lozinkaKorisnika, $levelKorisnika);
        mysqli_stmt_fetch($stmt);

        if (password_verify($_POST['lozinka'], $lozinkaKorisnika) && mysqli_stmt_num_rows($stmt) > 0) {
            $uspjesnaPrijava = true;
            if ($levelKorisnika == 1) {
                    $admin = true;
                } else {
                    $admin = false;
                }
            $_SESSION['username'] = $imeKorisnika;
            $_SESSION['level'] = $levelKorisnika;
        } else {
            $uspjesnaPrijava = false;
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Obs - prijava</title>
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

    <main id="login">
        <?php
            if (isset($_POST['submit'])) {
                if ($uspjesnaPrijava && $admin) {
                    echo '<div id="prijava-div">';
                        echo '<p id="prijava-p">Dobar dan, ' . $imeKorisnika . '! Uspješno ste prijavljeni kao administrator.</p>';
                        echo '<a id="prijava-a" href="administracija.php">Nastavite na administraciju</a>';
                    echo '</div>';
                } else if ($uspjesnaPrijava && !$admin) {
                    echo '<p id="prijava-p">Dobar dan, ' . $imeKorisnika . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
                } else if (isset($_SESSION['username']) && $_SESSION['level'] == 0) {
                    echo '<p id="prijava-p">Dobar dan, ' . $_SESSION['username'] . '! Uspješno ste prijavljeni, ali niste administrator.</p>';
                } else {
                    echo '<p id="prijava-p">Prijava neuspješna. Provjerite korisničko ime i lozinku.</p>';
                }
            }
        ?>
        <form action="" method="post">
            <h1>Prijava</h1>
            <div>
                <label for="username">Korisničko ime:</label>
                <input type="text" name="username" autofocus id="username">
                <span id="username-error" class="error"></span>
            </div>
            <div>
                <label for="lozinka">Lozinka:</label>
                <input type="password" name="lozinka" id="lozinka">
                <span id="lozinka-error" class="error"></span>
            </div>
            <div id="btn-div">
                <button type="submit" name="submit" id="submit">Prijavite se</button>
            </div>
            <div>
               <p>Nemate korisnički račun?</p>
               <a href="registracija.php">Registrirajte se</a> 
            </div>
        </form>
    </main>

    <footer>
        <p>©L'Obs - Les marques ou contenus du site nouvelobs.com sont soumis a la protection de la propriete intellectuelle</p>
    </footer>

</body>
</html>
