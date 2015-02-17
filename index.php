<?php
require __DIR__ . '/include/uppkoppling.php';
?><!DOCTYPE html>

<head>
    <title>Kokboken</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
<h1>Välkommen till studentkokboken.se</h1>

<p>Här hittar du alla recept du behöver i livet (jo, det är sant).</p>

<a href="recept_redigera.php">Lägg till</a>

<ul>
    <?php
    $result = $DB->query("SELECT * FROM recept");

    while ($row = $result->fetch_object()) {
        ?>
        <li><a href="recept_visa.php?id=<?php echo $row->id; ?>"><?php echo htmlspecialchars($row->name ?: 'Namnlös'); ?></a></li>
        <?php
    }
    ?>
</ul>

</body>
</html>
