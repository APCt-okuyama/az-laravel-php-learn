<?php
echo "start";

function bar() 
{
  echo "I exist immediately upon program start.\n";
}

bar();

$greet = function($name)
{
    printf("Hello %s\r\n", $name);
};
$greet("無名関数の例1");
$greet("無名関数の例2");

$message = 'hello';

$example = function () use ($message){
    var_dump($message);
};
$example();
