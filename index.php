<h1>自訂函式</h1>
<?php
// 在頁面上快速顯示陣列內容

$a = ['A', 'B', 'C', 'D', 'E'];
$b = [
    '姓名' => '陳宇彤',
    '學號' => '13',
    '數學' => 90,
    '國語' => 90,
    '英文' => 90,
];

/* echo "<pre>";
print_r($a);
echo "</pre>";
echo "<pre>";
print_r($b);
echo "</pre>"; */

dd($a);
dd($b);


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

?>