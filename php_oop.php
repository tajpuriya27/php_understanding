<?php
echo "<a href='./index.php'>Home</a><br/>";
class Fruit
{
    // Properties
    public $name;
    public $color;

    // Methods
    function set_name($name)
    {
        $this->name = $name;
    }
    function get_name()
    {
        return $this->name;
    }
    function set_color($color)
    {
        $this->color = $color;
    }
    function get_color()
    {
        return $this->color;
    }
}
$apple = new Fruit();
$banana = new Fruit();
$apple->set_name('Apple');
$apple->set_color('Reddish');
$banana->set_name('Banana');
$banana->set_color('Yellow');

echo $apple->get_name() . " is " . $apple->get_color() . "<br>";
echo $banana->get_name() . " is " . $banana->get_color() . "<br>";
