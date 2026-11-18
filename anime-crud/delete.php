<?php
require 'db.php';

$id = $_GET['id'];

if (isset($_POST['ja'])) {
    $stmt = $db->prepare("DELETE FROM anime WHERE id = ?");
    $stmt->execute([$id]);

    header("Location: index.php");
    exit;
}

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
    <title>Anime verwijderen</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h1>Anime verwijderen</h1>

<p>Weet je zeker dat je <b><?php echo htmlspecialchars($anime['titel']); ?></b> wilt verwijderen?</p>

<form method="post">
    <input type="submit" name="ja" value="Ja, verwijderen" class="knop rood">
    <a href="index.php">Nee</a>
</form>

</body>
</html>
