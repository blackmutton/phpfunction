<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>自訂函式</title>
</head>

<body>
    <h1>自訂函式</h1>
    <?php
    include_once "db.php";

    dd(all("students", "WHERE `id`>5 && `id`<10"));
    dd(find(3));

    ?>
</body>

</html>