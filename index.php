<style>
    * {
        font-family: 'Courier New', Courier, monospace;
    }
</style>
<h1>自訂函式</h1>
<?php
include_once "library.php";
// 在頁面上快速顯示陣列內容

$a = ['A', 'B', 'C', 'D', 'E'];
$b = [
    '姓名' => '陳宇彤',
    '學號' => '13',
    '數學' => 90,
    '國語' => 90,
    '英文' => 90
];

/* echo "<pre>";
print_r($a);
echo "</pre>";
echo "<pre>";
print_r($b);
echo "</pre>"; */

dd($a);
dd($b);
star();
star('菱形', 11);
star('矩形', 10);


?>