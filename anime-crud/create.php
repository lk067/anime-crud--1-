<?php
require 'db.php';

$melding = "";

if (isset($_POST['opslaan'])) {
    $naam = $_POST['naam'];
    $categorie = $_POST['categorie'];
    $calorieen = $_POST['calorieen'];
    $benodigdheden = $_POST['benodigdheden'];

    if ($naam == "" || $categorie == "" || $calorieen   == "" || $benodigdheden == "") {
        $melding = "Vul alle velden in!";
    } else {
        $sql = "INSERT INTO ingredienten (naam, categorie, calorieen, benodigdheden) VALUES (?, ?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$naam, $categorie, $calorieen, $benodigdheden]);

        header("Location: index.php");
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Ingredient toevoegen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


<h1>Ingredient toevoegen</h1>

<p class="fout"><?php echo $melding; ?></p>

<form method="post">
    <label>Naam</label>
    <input type="text" name="naam">
<br></br>
     <select name="categorie">
    <option value="">-- Kies een categorie --</option>
    <option value="Groente">Groente</option>
    <option value="Vlees">Vlees</option>
    <option value="Zuivel">Zuivel</option>
    <option value="Overig">Overig</option>
</select>  

    <label>Calorieën</label>
    <input type="number" name="calorieen">

    <label>Benodigdheden</label>
    <input type="text" name="benodigdheden">

    <br><br>
    <input type="submit" name="opslaan" value="Opslaan" class="knop">
    <a href="index.php">Terug</a>
</form>

</body>
</html>
