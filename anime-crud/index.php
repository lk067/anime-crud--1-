<?php
require 'db.php';

// wat er in de URL staat ophalen
$zoek = $_GET['zoek'] ?? "";
$categorie = $_GET['categorie'] ?? "";

// geen categorie gekozen? dan % = alle categorieën
$zoekCategorie = $categorie;
if ($zoekCategorie == "") {
    $zoekCategorie = "%";
}

$stmt = $db->prepare("SELECT * FROM ingredienten WHERE naam LIKE ? AND categorie LIKE ? ORDER BY naam");
$stmt->execute(["%" . $zoek . "%", $zoekCategorie]);
$ingredienten = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Ingredient lijst</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<form method="get">
    <input type="text" name="zoek" placeholder="Zoek op naam..." value="<?php echo htmlspecialchars($zoek); ?>">

    <select name="categorie">
        <option value="">Alle categorieën</option>
        <option value="Groente" <?php if ($categorie == "Groente") echo "selected"; ?>>Groente</option>
        <option value="Vlees" <?php if ($categorie == "Vlees") echo "selected"; ?>>Vlees</option>
        <option value="Zuivel" <?php if ($categorie == "Zuivel") echo "selected"; ?>>Zuivel</option>
        <option value="Overig" <?php if ($categorie == "Overig") echo "selected"; ?>>Overig</option>
    </select>

    <input type="submit" value="Zoeken" class="knop">
    <a href="index.php">Reset</a>
</form>

<h1>Mijn ingredient lijst</h1>
<a href="create.php" class="knop">Ingredient toevoegen</a>
<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Naam</th>
        <th>Categorie</th>
        <th>Calorieën</th>
        <th>benodigdheden</th>
        <th></th>
    </tr>
    <?php foreach ($ingredienten as $ingredient) { ?>
    <tr>
        <td><?php echo $ingredient['id']; ?></td>
        <td><?php echo htmlspecialchars($ingredient['naam']); ?></td>
        <td><?php echo htmlspecialchars($ingredient['categorie']); ?></td>
        <td><?php echo $ingredient['calorieen']; ?></td>
        <td class="benodigdheden"><?php echo htmlspecialchars($ingredient['benodigdheden']); ?></td>
        <td>
            <a href="update.php?id=<?php echo $ingredient['id']; ?>" class="knop">Edit</a>
            <a href="delete.php?id=<?php echo $ingredient['id']; ?>" class="knop rood">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
