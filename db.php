<?php
$dsn = "mysql:host=localhost;charset=utf8;dbname=school";
$pdo = new PDO($dsn, 'root', '');
/* 
在指定資料表中查找特定位置資料
@param $table 資料表名稱
@param $where where語法
*/
function all($table,$where)
{
    global $pdo;

    $sql = "SELECT * FROM `{$table}` {$where}";
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

/* 
在dept資料表中查找特定id資料
@param $id dept資料表中的id

*/
function find($id)
{
    global $pdo;

    $sql = "SELECT * FROM `dept` WHERE `id` ='{$id}'";
    $rows = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}


/* 
在頁面上快速顯示陣列內容
direct dump
@param $array 輸入的參數須為陣列 
*/

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
