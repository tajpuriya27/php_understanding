<?php
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