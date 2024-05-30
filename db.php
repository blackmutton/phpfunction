<?php
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');
/**
 * 在指定資料表中查找特定位置資料
 * @param $table 資料表名稱
 * @param $where where語法
 **/
function all($table, $where)
{
    global $pdo;

    $sql = "SELECT * FROM `{$table}` {$where}";
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

/** 
 * 在指定資料表中查找特定條件資料
 * @param $table 指定資料表名稱
 * @param $arg 想要的指定條件(可以是陣列形式或id的整數形式)

 **/
function find($table, $arg)
{
    global $pdo;
    $sql = "SELECT * FROM `{$table}` WHERE ";

    if (is_array($arg)) {
        foreach ($arg as $key => $value) {
            $tmp[] = "`$key`= '{$value}'";
            // print_r($tmp);
        }
        $sql .= join(" && ", $tmp);
    } else {

        $sql .= "`id` ='{$arg}'";
    }
    echo $sql;
    $row = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $row;
}
/**
 * 更新資料表中的資料
 * @param string $table 資料表名稱
 * @param array $cols 欄位名稱和對應的值
 * @param mixed $arg 條件參數，可以是陣列或單一值
 * @return int 返回受影響的行數
 */
function update($table, $cols, $arg)
{
    global $pdo;

    $sql = "UPDATE `{$table}` SET ";

    foreach ($cols as $key => $value) {
        $tmp[] = "`$key` ='{$value}'";
    }

    $sql .= join(",", $tmp);

    if (is_array($arg)) {
        foreach ($arg as $key => $value) {
            $tmp[] = "`$key`='{$value}'";
        }
        $sql .= "WHERE" . join("&&", $tmp);
    } else {
        $sql .= " WHERE `id` ='{$arg}'";
    }

    return $pdo->exec($sql);
}

function insert($table, $cols)
{
    global $pdo;
    $sql = "INSERT INTO`{$table}` ";
    $sql .= "(`" . join("`,`", array_keys($cols)) . "`)";
    $sql .= " VALUES('" . join("','", $cols) . "')";

    // echo $sql;
    return $pdo->exec($sql);
}




/** 
 * 在頁面上快速顯示陣列內容
 * direct dump
 * @param array $array 輸入的參數須為陣列 
 **/

function dd($array)
{
    if (is_array($array)) {

        echo "<pre>";
        print_r($array);
        echo "</pre>";
    } else {
        echo "錯誤：函式dd()參數須為陣列";
    }
}
