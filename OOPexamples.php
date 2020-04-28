<!DOCTYPE html>
<html>
<body>

<?php
class Fruit {
  // Properties
  public $name;
  public $color;

  function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color;
  }

  // Methods
  function set_name($name) {
    $this->name = $name;
  }
  function get_name() {
    return $this->name;
  }
  function set_color($color) {
    $this->color = $color;
  }
  function get_color() {
    return $this->color;
  }
}

$apple = new Fruit("Apple", "Green");

echo "Name: " . $apple->get_name();
echo "<br>";
echo "Color: " . $apple->get_color() . "<br>";

var_dump($apple instanceof Fruit);
?>
 
</body>
</html>
