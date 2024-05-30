<?php
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');

// 將函式中的foreach進行簡化
function array2sql($array)
{
    foreach ($array as $key => $value) {
        $tmp[] = "`$key`='$value'";
    }
    return $tmp;
}


/**
 * 將update和insert結合起來
 *  @param string $table 資料表名稱
 *  @param mixed $array 條件參數
 **/
function save($table, $array)
{
    if (isset($array['id'])) {
        update($table, $array, $array['id']);
    } else {
        insert($table, $array);
    }
}

/**
 * 在指定資料表中利用where語法查找特定位置資料
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
        $tmp = array2sql($arg);
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

    $tmp = array2sql($cols);

    $sql .= join(",", $tmp);

    if (is_array($arg)) {
        $tt = array2sql($arg);
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
        $tmp = array2sql($arg);
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

/** 
 *在使用更複雜語法時可使用的萬用函式
 *@param $sql sql語法
 **/
function q($sql)
{
    global $pdo;
    return $pdo->query($sql)->fetchAll();
}
