<?php
require 'db.php';

$result = $db->query("SELECT * FROM ingredienten");
$ingredienten = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Ingredient lijst</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>


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
