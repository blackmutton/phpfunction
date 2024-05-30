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
 * @param array $cols 想調整成的結果
 * @param mixed $arg 條件參數，可以是陣列或單一值
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
            $tt[] = "`$key`='{$value}'";
        }
        $sql .= " WHERE" . join("&&", $tt);
    } else {
        $sql .= " WHERE `id` ='{$arg}'";
    }
    // echo $sql;

    return $pdo->exec($sql);
}

/**
 * 插入指定資料表新資料
 * @param string $table 資料表名稱
 * @param array $cols 欄位名稱和對應的值
 */
function insert($table, $cols)
{
    global $pdo;
    $sql = "INSERT INTO`{$table}` ";
    // array_keys()取得陣列key值，使用在二為陣列很方便
    $sql .= "(`" . join("`,`", array_keys($cols)) . "`)";
    $sql .= " VALUES('" . join("','", $cols) . "')";

    // echo $sql;
    return $pdo->exec($sql);
}

/** 
 * 刪除指定資料庫的資料
 * @param string $table 資料表名稱
 * @param mixed $arg 想要刪除的資料條件，可為整數的id或陣列條件 
 **/
function del($table, $arg)
{
    global $pdo;

    $sql = "DELETE FROM `{$table}` WHERE ";
    if (is_array($arg)) {
        foreach ($arg as $key => $value) {
            $tmp[] = "`$key`='{$value}'";
        }
        $sql .= join(" && ", $tmp);
    } else {
        $sql .= " `id`='{$arg}'";
    }
    echo $sql;
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
