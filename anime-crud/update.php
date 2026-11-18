<?php
require 'db.php';

$id = $_GET['id'];
$melding = "";

if (isset($_POST['opslaan'])) {
    $titel = $_POST['titel'];
    $genre = $_POST['genre'];
    $afleveringen = $_POST['afleveringen'];
    $jaar = $_POST['jaar'];
    $studio = $_POST['studio'];

    if (empty($titel) || empty($genre) || empty($afleveringen) || empty($jaar) || empty($studio)) {
        $melding = "Vul alle velden in!";
    } else {
        $sql = "UPDATE anime SET titel = ?, genre = ?, afleveringen = ?, jaar = ?, studio = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$titel, $genre, $afleveringen, $jaar, $studio, $id]);

        header("Location: index.php");
        exit;
    }
}

// gegevens van de anime ophalen
$stmt = $db->prepare("SELECT * FROM anime WHERE id = ?");
$stmt->execute([$id]);
$anime = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$anime) {
    echo "Deze anime bestaat niet";
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Anime aanpassen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Anime aanpassen</h1>

<p class="fout"><?php echo $melding; ?></p>

<form method="post">
    <label>Titel</label>
    <input type="text" name="titel" value="<?php echo htmlspecialchars($anime['titel']); ?>">

    <label>Genre</label>
    <input type="text" name="genre" value="<?php echo htmlspecialchars($anime['genre']); ?>">

    <label>Afleveringen</label>
    <input type="number" name="afleveringen" value="<?php echo $anime['afleveringen']; ?>">

    <label>Jaar</label>
    <input type="number" name="jaar" value="<?php echo $anime['jaar']; ?>">

    <label>Studio</label>
    <input type="text" name="studio" value="<?php echo htmlspecialchars($anime['studio']); ?>">

    <br><br>
    <input type="submit" name="opslaan" value="Opslaan" class="knop">
    <a href="index.php">Terug</a>
</form>

</body>
</html>
