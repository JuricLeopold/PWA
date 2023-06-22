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
    <title>L'Obs - unos</title>
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

    <main>
        <form enctype="multipart/form-data" name="form" method="post" action="skripta.php">
            <div>
                <label for="naslov">Naslov vijesti:</label>
                <input type="text" name="naslov" autofocus id="naslov">
                <span id="naslov-error" class="error"></span>
            </div>
            <div>
                <label for="sazetak">Kratki sažetak vijesti:</label>
                <textarea name="sazetak" cols="30" rows="10" id="sazetak"></textarea>
                <span id="sazetak-error" class="error"></span>
            </div>
            <div>
                <label for="sadrzaj">Sadržaj vijesti:</label>
                <textarea name="sadrzaj" cols="30" rows="10" id="sadrzaj"></textarea>
                <span id="sadrzaj-error" class="error"></span>
            </div>
            <div>
                <label for="kategorija">Kategorija vijesti:</label>
                <select name="kategorija" id="kategorija">
                    <option value="" disabled selected>Odaberi kategoriju</option>
                    <option value="politika">Politika</option>
                    <option value="nekretnine">Nekretnine</option>
                </select>
                <span id="kategorija-error" class="error"></span>
            </div>
            <div>
                <label for="slika">Slika:</label>
                <input type="file" name="slika" id="slika">
                <span id="slika-error" class="error"></span>
            </div>
            <div class="checkbox">
                <label for="archive">Arhiva:</label>
                <input type="checkbox" name="archive" id="checkbox">
            </div>
            <button type="submit" id="submit">Pošalji</button>
            <button type="reset">Poništi</button>
        </form>
    </main>
    
    <footer>
        <p>©L'Obs - Les marques ou contenus du site nouvelobs.com sont soumis a la protection de la propriete intellectuelle</p>
    </footer>


    <script type="text/javascript">
        document.getElementById("submit").onclick = function(event) {
        
            var slanjeForme = true;
            
            var poljeTitle = document.getElementById("naslov");
            var title = document.getElementById("naslov").value;
            if (title.length < 5 || title.length > 30) {
                slanjeForme = false;
                poljeTitle.style.border="1px solid red";
                document.getElementById("naslov-error").innerHTML="Naslov mora biti između 5 i 30 znakova!<br>";
                poljeTitle.scrollIntoView();
            } else {
                poljeTitle.style.border="3px solid green";
                document.getElementById("naslov-error").innerHTML="";
            }
            
            var poljeAbout = document.getElementById("sazetak");
            var about = document.getElementById("sazetak").value;
            if (about.length < 10 || about.length > 100) {
                slanjeForme = false;
                poljeAbout.style.border="1px solid red";
                document.getElementById("sazetak-error").innerHTML="Kratki sadržaj mora biti između 10 i 100 znakova!<br>";
            } else {
                poljeAbout.style.border="3px solid green";
                document.getElementById("sazetak-error").innerHTML="";
            }

            var poljeContent = document.getElementById("sadrzaj");
            var content = document.getElementById("sadrzaj").value;
            if (content.length == 0) {
                slanjeForme = false;
                poljeContent.style.border="1px solid red";
                document.getElementById("sadrzaj-error").innerHTML="Sadržaj mora biti unesen!<br>";
            } else {
                poljeContent.style.border="3px solid green";
                document.getElementById("sadrzaj-error").innerHTML="";
            }

            var poljeCategory = document.getElementById("kategorija");
            if(document.getElementById("kategorija").selectedIndex == 0) {
                slanjeForme = false;
                poljeCategory.style.border="1px solid red";
                document.getElementById("kategorija-error").innerHTML="Kategorija mora biti odabrana!<br>";
            } else {
                poljeCategory.style.border="3px solid green";
                document.getElementById("kategorija-error").innerHTML="";
            }

            var poljeSlika = document.getElementById("slika");
            var pphoto = document.getElementById("slika").value;
            if (pphoto.length == 0) {
                slanjeForme = false;
                poljeSlika.style.border="1px solid red";
                document.getElementById("slika-error").innerHTML="Slika mora biti unesena!<br>";
            } else {
                poljeSlika.style.border="3px solid green";
                document.getElementById("slika-error").innerHTML="";
            }

            if (slanjeForme != true) {
                event.preventDefault();
            }
 
        };
    </script>

</body>
</html>



