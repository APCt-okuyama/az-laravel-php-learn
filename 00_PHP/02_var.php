<?php
    $num = 7;
    $string = "my 変数 ";
    $bool = true;

    define('CONST_NAME1', '定数1');
    const CONST_NAME2 = '定数2';

    print($num);
    print($string);

    echo(CONST_NAME1);
    echo(CONST_NAME2);

    echo "配列".PHP_EOL;
    print("配列 リスト".PHP_EOL);


    $array = array("lemon", "apple", "banana");
    echo $array[1],PHP_EOL;
    
    //連想配列とよばれるMap
    $array = array(
        "lemon" => "yellow",
        "apple" => "red",
        "banana" => "yellow",
    );
    echo $array["lemon"],PHP_EOL;

    $array = [
        "lemon" => "yellow",
        "apple" => "red",
        "banana" => "yellow",
    ];
    echo $array["apple"],PHP_EOL; 
    //配列から削除
    unset($array["apple"]);

    //関数
    function mySayHello(){
        $name = "abc";
        echo "hi {$name}" . PHP_EOL;
    };

    mySayHello();
