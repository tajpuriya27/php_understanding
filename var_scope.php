<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$x = 10; // global scope
function localScope()
{
    $x = 5; // local scope
    echo $x;
}
function staticScope()
{
    static $x = 0;
    echo $x;
    $x++;
}

function globalScope()
{
    global $x;
    echo $x;
    $x++;
}

staticScope();
echo "<br>";
staticScope();
echo "<br>";
staticScope();
echo "<br>";
globalScope();
echo "<br>";
echo $x;
