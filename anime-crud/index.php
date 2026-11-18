<?php
require 'db.php';

$result = $db->query("SELECT * FROM anime");
$animes = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <title>Anime lijst</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Mijn anime lijst</h1>
<a href="create.php" class="knop">Anime toevoegen</a>
<br><br>

<table>
    <tr>
        <th>ID</th>
        <th>Titel</th>
        <th>Genre</th>
        <th>Afleveringen</th>
        <th>Jaar</th>
        <th>Studio</th>
        <th></th>
    </tr>
    <?php foreach ($animes as $anime) { ?>
    <tr>
        <td><?php echo $anime['id']; ?></td>
        <td><?php echo htmlspecialchars($anime['titel']); ?></td>
        <td><?php echo htmlspecialchars($anime['genre']); ?></td>
        <td><?php echo $anime['afleveringen']; ?></td>
        <td><?php echo $anime['jaar']; ?></td>
        <td><?php echo htmlspecialchars($anime['studio']); ?></td>
        <td>
            <a href="update.php?id=<?php echo $anime['id']; ?>" class="knop">Edit</a>
            <a href="delete.php?id=<?php echo $anime['id']; ?>" class="knop rood">Delete</a>
        </td>
    </tr>
    <?php } ?>
</table>

</body>
</html>
