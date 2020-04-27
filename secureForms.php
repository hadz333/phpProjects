<!DOCTYPE HTML>  
<html>
<head>
<style>
  .error {
  	color: red;
  }
</style>
</head>
<body>  

<?php
// define variables and set to empty values
// every time page is reloaded or submit button is clicked, these are initially reset
$name = $email = $gender = $comment = $website = "";
$nameErr = $emailErr = $genderErr = $websiteErr = "";

// checks to make sure server request used POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // error text only shows up when required field is not entered
  if (empty($_POST["name"])) {
  	$nameErr = "Name is required";
  } else {
  	$name = test_input($_POST["name"]);
  	// if name isn't valid, set error text (not blank anymore)
	if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
	  $nameErr = "Only letters and white space allowed";
	}
  }
  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } else {
    $email = test_input($_POST["email"]);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  		$emailErr = "Invalid email format";
	}
  }

  if (empty($_POST["website"])) {
    $website = "";
  } else {
    $website = test_input($_POST["website"]);
    //if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i",$website)) {
    if (!filter_var($website, FILTER_VALIDATE_URL)) {
  		$websiteErr = "Invalid URL";
	}
  }

  if (empty($_POST["comment"])) {
    $comment = "";
  } else {
    $comment = test_input($_POST["comment"]);
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  } else {
    $gender = test_input($_POST["gender"]);
  }
}

/* 
What is the htmlspecialchars() function?
The htmlspecialchars() function converts special characters to HTML entities. This means that it will replace HTML characters like < and > with &lt; and &gt;. This prevents attackers from exploiting the code by injecting HTML or Javascript code (Cross-site Scripting attacks) in forms.
*/
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

<h2>PHP Form Validation Example</h2>
<h4 class="error">Required fields: *</h4> 
<!-- $_SERVER["PHP_SELF"] returns your current file name --> 
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
Name: <input type="text" name="name" value="<?php echo $name;?>">
<!-- span below will only contain "*" (indicating required field) unless error exists -->
<span class="error">* <?php echo $nameErr;?></span>
<br><br>
<!-- value is set to $_____, which allows data to remain in boxes after submitting -->
E-mail: <input type="text" name="email" value="<?php echo $email;?>">
<span class="error">* <?php echo $emailErr;?></span>
<br><br>
Website:
<input type="text" name="website" value="<?php echo $website;?>">
<span class="error"><?php echo $websiteErr;?></span>
<br><br>
Comment: <textarea name="comment" rows="5" cols="40"><?php echo $comment;?></textarea>
<br><br>
<!-- If gender was previously chosen, set to user's choice (saving data from previous submit) -->
Gender:
<input type="radio" name="gender" 
<?php if (isset($gender) && $gender=="female") echo "checked";?> 
 value="female">Female
<input type="radio" name="gender" 
<?php if (isset($gender) && $gender=="male") echo "checked"; ?> 
value="male">Male
<input type="radio" name="gender" 
<?php if (isset($gender) && $gender=="other") echo "checked"; ?> 
value="other">Other
<span class="error">* <?php echo $genderErr;?></span>
<br><br>
<input type="submit" name="submit" value="Submit">

</form>

<?php
echo "<h2>Your Input:</h2>";
echo $name;
echo "<br>";
echo $email;
echo "<br>";
echo $website;
echo "<br>";
echo $comment;
echo "<br>";
echo $gender;
?>

</body>
</html>