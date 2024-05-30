<style>
    * {
        font-family: 'Courier New', Courier, monospace;
    }
</style>
<h1>自訂函式</h1>
<?php


/* 
* 在頁面上快速顯示陣列內容
* direct dump
* @param $array 輸入的參數須為陣列 
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
/* 
* 使用迴圈來畫星星
*  @param $shape 形狀名,字串
*  @param $stars 星星的大小,數值
*/

function star($shape = '正三角形', $n = 7)
{
    switch ($shape) {
        case "正三角形":
        case 'equilateral triangle':
            for ($row = 1; $row <= $n; $row++) {
                for ($space = 1; $space <= $n - $row; $space++) {
                    echo "&nbsp;";
                }
                for ($col = 1; $col <= $row * 2 - 1; $col++) {
                    echo "*";
                }
                echo "<br>";
            }
            break;
        case "菱形":
        case 'diamond':
            for ($row = 1; $row < $n * 2; $row++) {
                if ($row > $n) {
                    $stars = $n * 2 - $row;
                } else {
                    $stars = $row;
                }
                for ($space = 1; $space <= $n - $stars; $space++) {
                    echo "&nbsp;";
                }
                for ($col = 1; $col <= $stars * 2 - 1; $col++) {
                    echo "*";
                }
                echo "<br>";
            }
            break;
        case "矩形":
        case 'rectangle':
            for ($row = 1; $row <= $n; $row++) {
                for ($col = 1; $col <= $n; $col++) {
                    echo "*";
                }
                echo "<br>";
            }
            break;
    }
}

?>