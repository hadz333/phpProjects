<!DOCTYPE html>
<html>
<body>

<?php
class Fruit {
  // constant
  const LEAVING_MESSAGE = "Thank you for visiting!";

  // Properties
  public $name;
  public $color;

  function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color;
  }
  // adding final keyword prevents method overriding
  final protected function intro() {
    echo "The fruit is {$this->name} and the color is {$this->color}. <br>";
    // accessing constant from within own class
    echo self::LEAVING_MESSAGE . "<br>";
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
echo "<br>";

// Inheritance
// Strawberry is inherited from Fruit
class Strawberry extends Fruit {

  public function __construct($name, $color, $weight) {
    $this->name = $name;
    $this->color = $color;
    $this->weight = $weight;
  }
  public function message() {
    echo "Am I a fruit or a berry? <br>";
    $this->intro();
  }
  // trying to implement Strawberry's own intro method (overriding Fruit's intro) would cause error due to final keyword used
}
$strawberry = new Strawberry("Strawberry", "red", 50); // OK. __construct() is public
$strawberry->message(); // OK. message() is public and it calls intro() (which is protected) from within the derived class

// accessing Fruit's constant
echo Fruit::LEAVING_MESSAGE;
?>
<br><br>
<h4>Abstract Classes </h4>

<!-- Abstract Classes -->
<?php
// Parent class
abstract class Car {
  public $name;
  public function __construct($name) {
    $this->name = $name;
  }
  abstract public function intro() : string;

  // abstract function with an argument
  abstract protected function prefixVehicle($model) : string;
}

// Child classes
class Audi extends Car {
  public function intro() : string {
    return "Choose German quality! I'm an $this->name!";
  }
  public function prefixVehicle($model) : string {
    return " Best: " . $this->name . $model;
  }
}

class Volvo extends Car {
  public function intro() : string {
    return "Proud to be Swedish! I'm a $this->name!";
  }
  public function prefixVehicle($model) : string {
    return " 2nd Best: " . $this->name . $model;
  }
}

class Citroen extends Car {
  public function intro() : string {
    return "French extravagance! I'm a $this->name!";
  }
  public function prefixVehicle($model) : string {
    return " Worst: " . $this->name . $model;
  }
}

$audi = new Audi("Audi");
echo $audi->intro();
echo $audi->prefixVehicle(" A4");
echo "<br>";

$volvo = new volvo("Volvo");
echo $volvo->intro();
echo $volvo->prefixVehicle(" XC60");
echo "<br>";

$citroen = new citroen("Citroen");
echo $citroen->intro();
echo $citroen->prefixVehicle(" Who knows");
echo "<br>";

?>

<!-- Abstract class example where more arguments are passed in than exist in abstract method declaration (this is allowed) -->
<?php
abstract class ParentClass {
  // Abstract method with an argument
  abstract protected function prefixName($name);
}

class ChildClass extends ParentClass {
  // The child class may define optional arguments that are not in the parent's abstract method
  public function prefixName($name, $separator = ".", $greet = "Dear") {
    if ($name == "John Doe") {
      $prefix = "Mr";
    } elseif ($name == "Jane Doe") {
      $prefix = "Mrs";
    } else {
      $prefix = "";
    }
    return "{$greet} {$prefix}{$separator} {$name}";
  }
}

$class = new ChildClass;
echo $class->prefixName("John Doe");
echo "<br>";
echo $class->prefixName("Jane Doe");
echo "<br>";
?>


<!-- Traits are primarily used to counter inheritance restrictions in php, 
  where one class can only extend (inherit) from one other class. -->
<?php
trait message1 {
  public function msg1() {
    echo "OOP is fun! ";
  }
}

trait message2 {
  public function msg2() {
    echo "OOP reduces code duplication!";
  }
}

class Welcome {
  use message1;
}

class Welcome2 {
  use message1, message2;
}

$obj = new Welcome();
$obj->msg1();
echo "<br>";

$obj2 = new Welcome2();
$obj2->msg1();
$obj2->msg2();
?>
<br>
<!-- Static functions -->
<!-- These methods can be accessed without creating an instance of their class -->
<?php
class greeting {
  public static function welcome() {
    echo "Hello World!";
  }
}

class SomeOtherClass {
  public function message() {
    // can also be called from here
    greeting::welcome();
  }
}
// calls static function without instantiation 
greeting::welcome();
?>
<br>
<!-- Another static method example -->
<?php
class domain {
  protected static function getWebsiteName() {
    return "Runescape.com";
  }
}
// child class can call parent's static class with parent::
class domainW3 extends domain {
  public $websiteName;
  public function __construct() {
    $this->websiteName = parent::getWebsiteName();
  }
}

$domainW3 = new domainW3;
echo $domainW3 -> websiteName;
?>
<br>

<!-- Static properties example -->
<?php
class pi {
  public static $value = 3.14159;
}

// Get static property
echo pi::$value;
?>
</body>
</html>
