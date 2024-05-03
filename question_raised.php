<?php
class Fruit
{
    public $name;

    // Methods
    function set_name($name)
    {
        $this->name = $name;
    }
    function get_name()
    {
        return $this->name;
    }
}

$apple = new Fruit();

$apple->set_name('Apple');

echo "$apple->get_name()"; // Why this shows () in screen?

var_dump($apple->get_name()); // TypeOf this is string

$str = "Hello";

echo "$str"; // This is valid for string. But not in Line 21??
