<?php

    session_start();
    include 'connect.php';
    define('UPLPATH', 'images/');

    if (!isset($_SESSION['username']) || $_SESSION['level'] != 1) {
        header("Location: login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>L'Obs - administracija</title>
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

    <main id="administracija">
        <?php

            $query = "SELECT * FROM vijesti";
            $result = mysqli_query($dbc, $query);
            while($row = mysqli_fetch_array($result)) {

                echo '
                    <form enctype="multipart/form-data" name="form" method="post" action="" id="form-admin">
                        <div>
                            <label for="naslov">Naslov vijesti:</label>
                            <input type="text" name="naslov" autofocus value="'.$row['naslov'].'">
                        </div>
                        <div>
                            <label for="sazetak">Kratki sažetak vijesti:</label>
                            <textarea name="sazetak" cols="30" rows="10">'.$row['sazetak'].'</textarea>
                        </div>
                        <div>
                            <label for="sadrzaj">Sadržaj vijesti:</label>
                            <textarea name="sadrzaj" cols="30" rows="10">'.$row['tekst'].'</textarea>
                        </div>
                        <div>
                            <label for="kategorija">Kategorija vijesti:</label>
                            <select name="kategorija">
                                <option value="politika"' . ($row["kategorija"] == "politika" ? ' selected' : '') . '>Politika</option>
                                <option value="nekretnine"' . ($row["kategorija"] == "nekretnine" ? ' selected' : '') . '>Nekretnine</option>
                            </select>
                        </div>
                        <div>
                            <label for="slika">Slika:</label>
                            <input type="file" name="slika" value="'.$row['slika'].'" id="slika">
                        </div>
                        <div class="checkbox">
                            <label for="archive">Arhiva:</label>';
                                if($row['arhiva'] == 0) {
                                    echo '<input type="checkbox" name="archive" id="checkbox">';
                                } else {
                                    echo '<input type="checkbox" name="archive" id="checkbox" checked>';
                                }
                            echo '</div>
                        <input type="hidden" name="id" value="'.$row['id'].'">
                        <button type="submit" name="update">Promijeni</button>
                        <button type="reset">Poništi</button>
                        <button type="submit" name="delete">Izbriši</button>
                    </form>';
            }

            if(isset($_POST['delete'])){
                $id=$_POST['id'];
                $query = "DELETE FROM vijesti WHERE id=$id ";
                $result = mysqli_query($dbc, $query);

                echo "<meta http-equiv='refresh' content='0'>";
            }

            if (isset($_POST['update'])) {
                $title = $_POST['naslov'];
                $about = $_POST['sazetak'];
                $content = $_POST['sadrzaj'];
                $category = $_POST['kategorija'];
                if (isset($_POST['archive'])) {
                    $archive = 1;
                } else {
                    $archive = 0;
                }
            
                $id = $_POST['id'];
            
                if (!empty($_FILES['slika']['name'])) {
                    $picture = $_FILES['slika']['name'];
                    $target_dir = 'images/' . $picture;
                    move_uploaded_file($_FILES['slika']['tmp_name'], $target_dir);
            
                    $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', 
                        slika='$picture', kategorija='$category', arhiva='$archive' WHERE id=$id";
                } else {
                    $query = "UPDATE vijesti SET naslov='$title', sazetak='$about', tekst='$content', 
                        kategorija='$category', arhiva='$archive' WHERE id=$id";
                }
            
                $result = mysqli_query($dbc, $query);
            
                echo "<meta http-equiv='refresh' content='0'>";
            }
                
        ?>
    </main>

    
    <footer>
        <p>©L'Obs - Brandovi ili sadržaji na web stranici nouvelobs.com su pod zaštitom intelektualnog vlasništva</p>
    </footer>

</body>
</html>