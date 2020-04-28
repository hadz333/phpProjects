<!-- Sanitizing (removing illegal characters) and validating input data -->
<!-- Validating Email -->
<?php
$email = "john.doe@example.com";

// Remove all illegal characters from email
$email = filter_var($email, FILTER_SANITIZE_EMAIL);

// Validate e-mail
if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo("$email is a valid email address");
} else {
    echo("$email is not a valid email address");
}
?>
<br>
<!-- Validating IP Address -->
<?php
$ip = "127.0.0.1";

if (!filter_var($ip, FILTER_VALIDATE_IP) === false) {
    echo("$ip is a valid IP address");
} else {
    echo("$ip is not a valid IP address");
}
?>
<br>
<!-- Validating integers -->
<?php
$int = 100;

if (!filter_var($int, FILTER_VALIDATE_INT) === false) {
    echo("Integer is valid");
} else {
    echo("Integer is not valid");
}
?>
<br>
<!-- Validating URL -->
<?php
$url = "https://www.w3schools.com";

// Remove all illegal characters from a url
$url = filter_var($url, FILTER_SANITIZE_URL);

// Validate url
if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
    echo("$url is a valid URL");
} else {
    echo("$url is not a valid URL");
}
?>
<br>
<!-- Validate IPv6 address -->
<?php
$ip = "2001:0db8:85a3:08d3:1319:8a2e:0370:7334";

if (!filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) === false) {
    echo("$ip is a valid IPv6 address");
} else {
    echo("$ip is not a valid IPv6 address");
}
?>
<br>
<!-- Remove all HTML tags, and all chars with ASCII > 127 -->
<?php
$str = "<h1>Hello WorldÆØÅ!</h1>";

$newstr = filter_var($str, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_HIGH);
echo $newstr;
?>
<br><br>
<br><br>
<!-- JSON -->
<!-- Encode associative array into JSON -->
<?php
$age = array("Peter"=>35, "Ben"=>37, "Joe"=>43);

echo json_encode($age);
?>
<br>
<!-- decode JSON into PHP associative array -->
<?php
$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

var_dump(json_decode($jsonobj, true));
?>
<br>
<!-- How to access values from a PHP object -->
<?php
$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

$obj = json_decode($jsonobj);

echo $obj->Peter . " ";
echo $obj->Ben . " ";
echo $obj->Joe . " <br>";

// how to loop through values 
foreach($obj as $key => $value) {
	echo $key . " => " . $value . "<br>";
}
?>
<br>
<!-- How to access values from a PHP associative array -->
<?php
$jsonobj = '{"Peter":35,"Ben":37,"Joe":43}';

$arr = json_decode($jsonobj, true);

echo $arr["Peter"] . " ";
echo $arr["Ben"] . " ";
echo $arr["Joe"] . " <br>";

// how to loop through values 
foreach($arr as $key => $value) {
	echo $key . " => " . $value . "<br>";
}
?>
<br>
