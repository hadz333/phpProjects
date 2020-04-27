<!DOCTYPE html>
<html>
<body>
<h5>Test $POST</h5>

<!-- # demonstrating $_SERVER and $_POST superglobals (PHP_SELF below gets current file name) -->
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // collect value of input field
    $name = $_POST['fname'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
        echo $name;
    }
}
?>
<br><br><br>

<a href="test_get.php?make=Subaru&model=Forester&year=2004">Test $GET</a>

</body>
</html>