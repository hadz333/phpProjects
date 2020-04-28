<!-- Setting Cookie -->
<?php
$cookie_name = "user";
$cookie_value = "John Doe";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
?>
<!DOCTYPE html>

<html>
<body>
<?php
if(!isset($_COOKIE[$cookie_name])) {
    echo "Cookie named '" . $cookie_name . "' is not set!";
} else {
    echo "Cookie '" . $cookie_name . "' is set!<br>";
    echo "Value is: " . $_COOKIE[$cookie_name];
    echo "<br><br>";
}
?>
<!-- Date and Time -->
<?php
date_default_timezone_set("America/Los_Angeles");
echo "Today is " . date("l") . ", " . date("m/d/Y") . "<br>";
?>
<br>
<!-- Automatically set to current date copyright -->
© 2010-<?php echo date("Y");?>
<br>

<?php 
echo "The time is: " . date("h:i:sa");
echo "<br>";
$d=strtotime("10:30pm April 15 2014");
echo "Created date is " . date("Y-m-d h:i:sa", $d);
echo "<br>";
$d=strtotime("tomorrow");
echo "Tomorrow: " . date("Y-m-d", $d) . "<br>";
echo "<br>";

// output the next 6 saturdays example
echo "The next 6 Saturdays <br>";
$startdate = strtotime("Saturday");
$enddate = strtotime("+6 weeks", $startdate);

while ($startdate < $enddate) {
  echo date("M d", $startdate) . "<br>";
  $startdate = strtotime("+1 week", $startdate);
}

// how many days until July 4th
$d1=strtotime("July 04");
$d2=ceil(($d1-time())/60/60/24);
echo "There are " . $d2 ." days until 4th of July.";
?>
<br><br>
<!-- Including files examples -->
<!-- 'include filename' will give you a warning and continue,
	while 'require filename' will throw a fatal error and halt the page. 
	require should be used if the file is critical to the page. -->
<div class="menu">
<?php include 'menu.php';?>
</div>

<h1>Welcome to my home page!</h1>
<p>Some text.</p>
<p>Some more text.</p>

<!-- Opening, Reading, writing to files 
	When opening file, "w" will erase file and give you write privileges.
	"a" (appending) will give you writing privileges and the file pointer will be at end of file with all contents kept.
	"r" is read-only. 
    Remember to always close file after use - don't want it to take up unnecessary server space -->

<?php
  $myfile = fopen("webdictionary.txt", "r") or die("Unable to open file!");
  //echo fread($myfile,filesize("webdictionary.txt"));
  // Output one line until end-of-file
  while(!feof($myfile)) {
    echo fgets($myfile) . "<br>";
  }
  fclose($myfile);



  // file creating and writing
  $myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
  $txt = "John Doe\n";
  fwrite($myfile, $txt);
  $txt = "Jane Doe\n";
  fwrite($myfile, $txt);
  fclose($myfile);

  $myfile = fopen("newfile.txt", "a") or die("Unable to open file!");
  $txt = "John Deere";
  fwrite($myfile, $txt);
  fclose($myfile);
?>
<br><br>
<!-- File upload -->
<form action="upload.php" method="post" enctype="multipart/form-data">
    Select image to upload:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
</form>


</body>
</html>