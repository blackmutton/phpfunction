<?php
include_once "base.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <?php
    $total = $Student->count();
    $div = 20;
    $pages = ceil($total / $div);
    // $now = (isset($_GET['p'])) ? $_GET['p'] : 1;
    $now = $_GET['p'] ?? 1;
    $start = ($now - 1) * $div;
    $rows = $Student->all([], " limit $start, $div");

    foreach ($rows as $idx => $row) {
        echo ($idx + 1) . '=>' . $row['name'] . "<br>";
    }

    ?>
    <hr>

    <?php
    if ($now - 1 > 0) {
        echo "<a href='?p=" . ($now - 1) . "'> < </a>";
    }
    for ($i = 1; $i <= $pages; $i++) {
        echo "<a href='?p=$i'>$i</a>";
    }
    if ($now + 1 <= $pages) {
        echo "<a href='?p=" . ($now + 1) . "'> > </a>";
    }
    ?>
</body>

</html>