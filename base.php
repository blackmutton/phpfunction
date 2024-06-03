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
        if (!empty($arg[0]) && is_array($arg[0])) {
            $tmp = $this->array2sql($arg);
            $sql = $sql . "where " . implode("&&", $tmp);
        }
        if (!empty($arg[1])) {
            $sql = $sql . $arg[1];
        }

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
    protected function array2sql($array)
    {
        foreach ($array as $key => $value) {
            $tmp[] = "`$key`='$value'";
        }
        return $tmp;
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
$Dept->del(16);
echo "<pre>";
print_r($Student->find(['name' => '王琇榆']));
echo "</pre>";
