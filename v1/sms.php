<?php
//db config
define('DB_SERVER', 'limelite.db.9731563.hostedresource.com');
define('DB_USERNAME', 'limelite');    // DB username
define('DB_PASSWORD', 'Lime@123');    // DB password
define('DB_DATABASE', 'limelite');      // DB name
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");

/*
CREATE TABLE IF NOT EXISTS `users` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(60) NOT NULL,
  `message` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
);
 header("Location: ".$loginUrl);

*/

//$ID = $_POST['ID'];
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];


//sms
$request =""; //initialise the request variable
$param[method]= "sendMessage";
$param[send_to] = $number;
$param[msg] = "Dear Patron, We are Celebrating our 1st anniversary at LIMELITE-Race course! Avail flat 30% off on services. Hurry, Ltd period offer. Call 0422- 4202006 for appt.";
$param[msg_type] = "TEXT"; //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
$param[userid] = "2000142572";
//$param[userid] = "2000158751";
$param[password] = "q1ocL2FL4";
//$param[password] = "1OiIi4iYU";
$param[v] = "1.1";
$param[auth_scheme] = "PLAIN";
$param[override_dnd] = "true";
$param[format] = "text";
//Have to URL encode the values
foreach($param as $key=>$val) {
$request.= $key."=".urlencode($val);
//we have to urlencode the values
$request.= "&";
//append the ampersand (&) sign after each parameter/value pair
}
$request = substr($request, 0, strlen($request)-1);
//remove final (&) sign from the request
$url =
"http://enterprise.smsgupshup.com/GatewayAPI/rest?".$request;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
//echo $curl_scraped_page;
//function checkuser($ID,$name,$email,$number,$message){

 $check = mysql_query("select * from users where email='$email'");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record
	$query = "INSERT INTO users (name,email,number) VALUES ('$name','$email','$number')";
	mysql_query($query);

	header("Location: thankyou.php");
	} else {   // If Returned user . update the user record
	$query = "INSERT INTO users (name,email,number) VALUES ('$name','$email','$number')";
	mysql_query($query);
	header("Location: thankyou.php");
	}
	
//}



?>