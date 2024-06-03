<?php
// 物件的藍圖
class Animal
{
    public $name = 'amimal';
    // protected能被繼承，但無法被存取
    protected $age = 12;
    // private只能在此藍圖中存取，也無法被繼承
    private $weight = 20;

    public function __construct($name)
    {
        // 將原本繼承public的$name指定為括號中的$name
        $this->name = $name;
    }

    public function run()
    {
        echo $this->name;
        echo " is running";
        echo $this->weight;
    }

    private function speed()
    {
        return 'high speed';
    }
}
// 讓cat繼承animal
class Cat extends Animal
{
    public $name = 'cat';

    public function run()
    {
        echo "cat is running";
        // 讓cat存取animal中的protected
        echo $this->age;
        // 先在public中呼叫private，讓外部能存取
        echo $this->speed();
    }

    private function speed()
    {
        return 'low speed';
    }
}
// $cat才是物件，需要靠new創建
// $cat = new Cat();

// 取用物件的方法是靠->
// echo $cat->name;

// 需要用方法的形式存取屬於protected的類別，若想要呈現屬於private的類別則也需要先讓在public的方法中呼叫
// echo $cat->run();

// 然而若是直接使用方法的形式依然無法存取屬於private的類別
// echo $cat->speed();
// echo $cat->weight;

$ani = new Animal('john');
$ani->run();
