<?php
require 'db.php';

$melding = "";

if (isset($_POST['opslaan'])) {
    $titel = $_POST['titel'];
    $genre = $_POST['genre'];
    $afleveringen = $_POST['afleveringen'];
    $jaar = $_POST['jaar'];
    $studio = $_POST['studio'];

    // checken of alles is ingevuld
    if (empty($titel) || empty($genre) || empty($afleveringen) || empty($jaar) || empty($studio)) {
        $melding = "Vul alle velden in!";
    } else {
        $sql = "INSERT INTO anime (titel, genre, afleveringen, jaar, studio) VALUES (?, ?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$titel, $genre, $afleveringen, $jaar, $studio]);

        header("Location: index.php");
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Anime toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Anime toevoegen</h1>

<p class="fout"><?php echo $melding; ?></p>

<form method="post">
    <label>Titel</label>
    <input type="text" name="titel">

    <label>Genre</label>
    <input type="text" name="genre">

    <label>Afleveringen</label>
    <input type="number" name="afleveringen">

    <label>Jaar</label>
    <input type="number" name="jaar">

    <label>Studio</label>
    <input type="text" name="studio">

    <br><br>
    <input type="submit" name="opslaan" value="Opslaan" class="knop">
    <a href="index.php">Terug</a>
</form>

</body>
</html>
