<?php
require __DIR__ . '/include/uppkoppling.php';



$name = $ingredients = $instructions = null;

if (isset($_GET['id'])) {
	$stmt = $DB->prepare("SELECT name, ingredients, instructions FROM recept
		WHERE id = ?");

	$stmt->bind_param('i', $_GET['id']);
	$stmt->execute();
	$stmt->bind_result($name, $ingredients, $instructions);
	$stmt->fetch();
}
?>

<!DOCTYPE html>

<head>
	<title>Redigera</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>

<h1><?php echo htmlspecialchars($name); ?></h1>

<p><?php echo nl2br(htmlspecialchars($ingredients)); ?></p>
<p><?php echo nl2br(htmlspecialchars($instructions)); ?></p>

<a href="index.php">Tillbaka</a>
<a href="recept_redigera.php?id=<?php echo $_GET['id']; ?>">Ändra</a>
</body>

</html>

