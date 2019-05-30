<?php

class MenuItem
{
    public $name;

    public $color;

    public $width;

    public function __construct($name = null, $color = null, $width = null)
    {
        $this->name = $name;
        $this->color = $color;
        $this->width = $width;
    }

    public function highlight()
    {
        $this->color = "red";
    }

}

class MainMenuItem extends MenuItem
{
    public $borderStyle;

    public function __construct($name = null, $color = null, $width = null, $borderStyle)
    {
        parent::__construct($name, $color, $width);
        $this->borderStyle = $borderStyle;
    }

    public function highlight(){
        parent::highlight();
        $this->borderStyle = "solid";
    }

}

$item = new MenuItem("Bar", "black", 200);
$mainItem = new MainMenuItem("Bar", "black", 200, "none");
var_dump($item, $mainItem);

$item->highlight();
$mainItem->highlight();
var_dump($item, $mainItem);

//задание 5

/*class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}
$a1 = new A();
$a2 = new A(); //объекты $a1 и $a2 класса А

$a1->foo(); // 1 - обращаемся к методу foo класса A и статичную переменную $x увеличиваем на единицу и выводим
//и так происходит с каждым обращением к методу foo,так как каждый раз обращаемся к одному и тому же методу одного и того же класса
$a2->foo(); // 2

$a1->foo(); // 3
$a2->foo(); // 4
*/


//задание 6
class A {
    public function foo() {
        static $x = 0;
        echo ++$x;
    }
}

class B extends A {
}

$a1 = new A(); //объект $a1 класса А
$b1 = new B(); //объект $a1 класса B, который является наследником класса А

$a1->foo();// 1 у каждого объекта свой собственный метод foo
$b1->foo();// 1 поэтому обращение к методу объекта a1 не повлияет на переменную $x объекта b1

$a1->foo();// 2
$b1->foo();// 2

