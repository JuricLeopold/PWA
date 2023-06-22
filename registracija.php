<?php

    session_start();
    include 'connect.php';
    define('UPLPATH', 'images/');

    $ime = $_POST['ime'] ?? '';
    $prezime = $_POST['prezime'] ?? '';
    $username = $_POST['username'] ?? '';   
    $lozinka = $_POST['pass'] ?? '';
    $hashed_password = password_hash($lozinka, CRYPT_BLOWFISH);
    $razina = 0;
    $registriranKorisnik = false;
    $msg = "";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $sql = "SELECT korisnicko_ime FROM korisnik WHERE korisnicko_ime = ?";
        $stmt = mysqli_stmt_init($dbc);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
        }

        if (mysqli_stmt_num_rows($stmt) > 0) {
            $msg='Korisničko ime već postoji!';
        } else {
            $sql = "INSERT INTO korisnik (ime, prezime,korisnicko_ime, lozinka, razina) VALUES (?, ?, ?, ?, ?)";
            $stmt = mysqli_stmt_init($dbc);
            if (mysqli_stmt_prepare($stmt, $sql)) {
                mysqli_stmt_bind_param($stmt, 'ssssd', $ime, $prezime, $username, $hashed_password, $razina);
                mysqli_stmt_execute($stmt);
                $registriranKorisnik = true;
            }
        }

        mysqli_close($dbc);
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Obs - registracija</title>
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

    <?php
        if ($registriranKorisnik == true) {
            echo '<p id="registracion-success">Korisnik je uspješno registriran!</p>';
        } else {
    ?>

    <main id="registracija">
        <form enctype="multipart/form-data" action="" method="POST">
            <div>
                <label for="ime">Ime: </label>
                <input type="text" name="ime" id="ime">
                <span id="porukaIme" class="error"></span>
            </div>
            <div>
                <label for="prezime">Prezime: </label>
                <input type="text" name="prezime" id="prezime">
                <span id="porukaPrezime" class="error"></span>
            </div>
            <div>
                <label for="korisnicko_ime">Korisničko ime:</label>
                <input type="text" name="username" id="username">
                <span id="porukaUsername" class="error"></span>
                <?php echo '<br><span class="error">'.$msg.'</span>'; ?>
            </div>
            <div>
                <label for="password">Lozinka: </label>
                <input type="password" name="pass" id="pass">
                <span id="porukaPass" class="error"></span>
            </div>
            <div>
                <label for="pphoto">Ponovite lozinku: </label>
                <input type="password" name="passRep" id="passRep">
                <span id="porukaPassRep" class="error"></span>
            </div>
            <button type="submit" id="submit">Prijava</button>
        </form>

        <script type="text/javascript">
            document.getElementById("submit").onclick = function(event) {
            
                var slanjeForme = true;
                
                var poljeIme = document.getElementById("ime");
                var ime = document.getElementById("ime").value;
                if (ime.length == 0) {
                    slanjeForme = false;
                    poljeIme.style.border="1px solid red";
                    document.getElementById("porukaIme").innerHTML="<br>Unesite ime!<br>";
                } else {
                    poljeIme.style.border="3px solid green";
                    document.getElementById("porukaIme").innerHTML="";
                }
                
                var poljePrezime = document.getElementById("prezime");
                var prezime = document.getElementById("prezime").value;
                if (prezime.length == 0) {
                    slanjeForme = false;
                    poljePrezime.style.border="1px solid red";
                    document.getElementById("porukaPrezime").innerHTML="<br>Unesite Prezime!<br>";
                } else {
                    poljePrezime.style.border="3px solid green";
                    document.getElementById("porukaPrezime").innerHTML="";
                }
                
                var poljeUsername = document.getElementById("username");
                var username = document.getElementById("username").value;
                if (username.length == 0) {
                    slanjeForme = false;
                    poljeUsername.style.border="1px solid red";
                    document.getElementById("porukaUsername").innerHTML="<br>Unesite korisničko ime!<br>";
                } else {
                    poljeUsername.style.border="3px solid green";
                    document.getElementById("porukaUsername").innerHTML="";
                }
                
                var poljePass = document.getElementById("pass");
                var pass = document.getElementById("pass").value;
                var poljePassRep = document.getElementById("passRep");
                var passRep = document.getElementById("passRep").value;
                if (pass.length == 0 || passRep.length == 0 || pass != passRep) {
                    slanjeForme = false;
                    poljePass.style.border="1px solid red";
                    poljePassRep.style.border="1px solid red";
                    document.getElementById("porukaPass").innerHTML="<br>Lozinke nisu iste!<br>";
                    document.getElementById("porukaPassRep").innerHTML="<br>Lozinke nisu iste!<br>";
                } else {
                    poljePass.style.border="3px solid green";
                    poljePassRep.style.border="3px solid green";
                    document.getElementById("porukaPass").innerHTML="";
                    document.getElementById("porukaPassRep").innerHTML="";
                }
                
                if (slanjeForme != true) {
                    event.preventDefault();
                }

            };
 
        </script>
    </main>

    <?php
        }
    ?>

    
    <footer>
        <p>©L'Obs - Les marques ou contenus du site nouvelobs.com sont soumis a la protection de la propriete intellectuelle</p>
    </footer>

</body>
</html>

