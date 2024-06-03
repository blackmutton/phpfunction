<?php

class DB
{
    protected $dsn = "mysql:host=Localhost;charset=utf8;dbname=school";
    protected $pdo;
    protected $table;

    public function __construct($table)
    {
        $this->pdo = new PDO($this->dsn, 'root', '');
        $this->table = $table;
    }

    public function all(...$arg)
    {
        $sql = "select * from $this->table ";
        /* if (!empty($arg[0]) && is_array($arg[0])) {
            $tmp = $this->array2sql($arg);
            $sql = $sql . "where " . implode("&&", $tmp);
        }
        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        } */
        $sql = $this->select($sql, ...$arg);

        echo $sql;
        return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    function find($arg)
    {

        $sql = "SELECT * FROM `{$this->table}` WHERE ";

        if (is_array($arg)) {
            $tmp = $this->array2sql($arg);
            $sql .= join(" && ", $tmp);
        } else {

            $sql .= "`id` ='{$arg}'";
        }
        echo $sql;
        return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
    }

    function save($array)
    {
        if (isset($arry['id'])) {
            $sql = "UPDATE `{$this->table}` SET";

            $tmp = $this->array2sql($array);
            $sql .= join(",", $tmp);
            $sql .= " WHERE `id`='{$array['id']}'";
        } else {
            $sql = "INSERT INTO `{$this->table}`";
            $sql .= "(`" . join("`,`", array_keys($array)) . "`)";
            $sql .= " VALUES('" . join("','", $array) . "')";
        }
        echo $sql;
        return $this->pdo->exec($sql);
    }

    function del($arg)
    {
        $sql = "DELETE from `{$this->table}` WHERE";
        if (is_array($arg)) {
            $tmp = $this->array2sql($arg);
            $sql .= join("&&", $tmp);
        } else {
            $sql .= "`id`='{$arg}'";
        }
        return $this->pdo->exec($sql);
    }
    function count(...$arg)
    {

        $sql = "SELECT count(*) FROM `{$this->table}`";
        // 第一個參數限定為陣列
        /* if (!empty($arg[0]) && is_array($arg[0])) {
            $tmp = $this->array2sql($arg[0]);
            $sql = $sql . "where" . implode("&&", $tmp);
        } */
        // 最多只能有2個參數
        /*  if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        } */
        $sql = $this->select($sql, ...$arg);
        echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }

    function math($math, $col, ...$arg)
    {
        $sql = "SELECT $math(`$col`) FROM (`$this->table`)";
        $sql = $this->select($sql, ...$arg);

        echo $sql;
        return $this->pdo->query($sql)->fetchColumn();
    }
    protected function array2sql($array)
    {
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
    }

    protected function select($sql, ...$arg)
    {
        if (!empty($arg[0]) && is_array($arg[0])) {
            $tmp = $this->array2sql($arg[0]);
            $sql = $sql . "where" . implode(" && ", $tmp);
        }
        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }
        return $sql;
    }

    function q($sql)
    {
        return $this->pdo->query($sql)->fetchAll();
    }
}

function dd($array)
{
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}
$Student = new DB('students');
$Dept = new DB('dept');
// $Dept->save(['code' => '901', 'name' => '資工系']);
// $Dept->del(16);
$data = ['code' => 801, 'name' => '電子系'];
$Dept->save($data);
echo "<pre>";
print_r($Student->find(['name' => '王琇榆']));
echo "</pre>";

echo $Student->count(['dept' => 2], ' order by `name` desc');
echo "<br>";
echo $Student->math('max', 'graduate_at');
