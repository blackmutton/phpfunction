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
    dd(find("students", ['uni_id' => 'F200000035']));
    dd(find("students", ['uni_id' => 'F200000035', 'parents' => '孔進豐']));
    update('students', ['dept' => '3'], 3);
    // insert('dept', ['code' => '801', 'name' => '綜合演藝學系']);
    del('dept', ['name' => '綜合演藝學系']);
    update('students', ['dept' => '2'], ['dept' => '1']);
    // limit需要放最後，否則會錯誤
    dd(q("select * from `students` where `dept`='3'  order by `id` desc limit 10"));

    ?>
</body>

</html>