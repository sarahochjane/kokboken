<?php
require __DIR__ . '/include/uppkoppling.php';


if(isset($_POST["action"])) {
	$action = $_POST["action"];

	if ($action == "save") {

		if (!empty($_GET['id'])) {
			$stmt = $DB->prepare("UPDATE recept SET name = ?, ingredients = ?, instructions = ?
				WHERE id = ?");

			$stmt->bind_param('sssi', $_POST['name'], $_POST['ingredients'], $_POST['instructions'], $_GET['id']);

			$stmt->execute();
		}
		else {
			$stmt = $DB->prepare("INSERT INTO recept (name, ingredients, instructions)
				VALUES(?, ?, ?)");

			$stmt->bind_param('sss', $_POST['name'], $_POST['ingredients'], $_POST['instructions']);

			$stmt->execute();

			header("Location: ?id=" . $stmt->insert_id);
			die();
		}
	}

	if ($action == "delete") {

		$stmt = $DB->prepare("DELETE FROM recept WHERE id = ?");

		$stmt->bind_param('i', $_GET['id']);

		$stmt->execute();

		header("Location: index.php");
		die();
	}
}


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

<h1>Lägg till eller redigera recept</h1>

<form action="" method="POST">
	Namn:<br />
	<input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>"><br />
	Ingredienslista:<br/>
	<textarea name="ingredients" cols="40" rows="10"><?php echo htmlspecialchars($ingredients); ?></textarea><br />
	Instruktion:<br />
	<textarea name="instructions" cols="40" rows="10"><?php echo htmlspecialchars($instructions); ?></textarea><br />
	<button type="reset" name="reset" />Återställ</button>
	<button type="submit" name="action" value="save"/>Spara</button>
	<button type="submit" name="action" value="delete">Ta bort</button>
	<a href="index.php">Tillbaka</a>
</body>

</html>
