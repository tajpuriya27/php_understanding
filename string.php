

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$var1 = "Hello I am Learning PHP";

echo strlen($var1); // 23
echo "<br>";
echo strpos($var1, "PHP"); // 20
echo "<br>";
echo strpos($var1, "zzz"); // false
/*
This is not displayed on screen. It is like hidden property of CSS
*/

echo "False is not displayed on screen" . false;
echo "<br>";
var_dump(strpos($var1, "zzz")); // bool(false)

echo "<hr>";
$strVar = "Hello I am Learning PHP in lower case";
echo strtoupper($strVar); // HELLO I AM LEARNING PHP IN LOWER CASE
echo "<br>";
echo "$strVar"; // Hello I am Learning PHP in lower case

echo "<hr>";
$strVar = "HELLO I AM LEARNING PHP IN Upper CASE";
echo strtolower($strVar); // hello i am learning php in upper case
echo "<br>";
echo "$strVar"; // HELLO I AM LEARNING PHP IN LOWER CASE

echo "<hr>";
$phpvar = "Hello World!";
echo str_replace("World", "Team", $phpvar);
echo "<br>";
echo "$phpvar";

echo "<hr>";
echo "<h3>Reverse a string</h3>";
$x = "Hello World!";
echo "<br/> After Reversing: " . strrev($x);
echo "<br/> Before reversing: " . $x;

echo "<hr>";
$x = " Hello World! ";
echo strlen(trim($x)); //12
echo "<br>";
echo strlen($x); // 14