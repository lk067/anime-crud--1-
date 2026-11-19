<?php
require 'db.php';

$id = $_GET['id'];
$melding = "";

if (isset($_POST['opslaan'])) {
    $naam = $_POST['naam'];
    $categorie = $_POST['categorie'];
    $calorieen = $_POST['calorieen'];
    $benodigdheden = $_POST['benodigdheden'];

    if ($naam == "" || $categorie == "" || $calorieen == "" || $benodigdheden == "") {
        $melding = "Vul alle velden in!";
    } else {
        $sql = "UPDATE ingredienten SET naam = ?, categorie = ?, calorieen = ?, benodigdheden = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute([$naam, $categorie, $calorieen, $benodigdheden, $id]);

        header("Location: index.php");
        exit;
    }
}

// gegevens van de ingredient ophalen
$stmt = $db->prepare("SELECT * FROM ingredienten WHERE id = ?");
$stmt->execute([$id]);
$ingredient = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$ingredient) {
    echo "Deze ingredient bestaat niet";
    exit;
}
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Ingredient aanpassen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Ingredient aanpassen</h1>

<p class="fout"><?php echo $melding; ?></p>

<form method="post">
    <label>Naam</label>
    <input type="text" name="naam" value="<?php echo htmlspecialchars($ingredient['naam']); ?>">

    <label>Categorie</label>
    <input type="text" name="categorie" value="<?php echo htmlspecialchars($ingredient['categorie']); ?>">

    <label>Calorieën</label>
    <input type="number" name="calorieen" value="<?php echo $ingredient['calorieen']; ?>">

    <label>Benodigdheden</label>
    <input type="text" name="benodigdheden" value="<?php echo htmlspecialchars($ingredient['benodigdheden']); ?>">

    <br><br>
    <input type="submit" name="opslaan" value="Opslaan" class="knop">
    <a href="index.php">Terug</a>
</form>

</body>
</html>
