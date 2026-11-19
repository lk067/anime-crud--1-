<?php
require 'db.php';

$id = $_GET['id'];

if (isset($_POST['ja'])) {
    $stmt = $db->prepare("DELETE FROM ingredienten WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit;
}

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
    <title>Ingredient verwijderen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Ingredient verwijderen</h1>

<p>Weet je zeker dat je <b><?php echo htmlspecialchars($ingredient['naam']); ?></b> wilt verwijderen?</p>

<form method="post">
    <input type="submit" name="ja" value="Ja, verwijderen" class="knop rood">
    <a href="index.php">Nee</a>
</form>

</body>
</html>
