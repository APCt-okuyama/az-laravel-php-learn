<?php
class SimpleClass
{
    // プロパティの宣言
    public $var = 'a default value';

    //コンストラクター
    public function __construct()
    {
        echo "start __construct()", PHP_EOL;
    }

    // メソッドの宣言
    public function displayVar()
    {
        echo $this->var, PHP_EOL;
    }

    //static method
    public static function aStaticMethod() {
        echo "aStaticMethod", PHP_EOL;
    }
}

$a = new SimpleClass();
$b = new SimpleClass();

//関数へのアクセス
$a->displayVar();

//変数へのアクセス
echo $a->var, PHP_EOL;

//static method の利用
SimpleClass::aStaticMethod();
