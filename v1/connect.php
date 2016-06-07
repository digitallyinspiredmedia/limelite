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
$message = $_POST['message'];




//function checkuser($ID,$name,$email,$number,$message){

 $check = mysql_query("select * from users where email='$email'");
	$check = mysql_num_rows($check);
	if (empty($check)) { // if new user . Insert a new record
	$query = "INSERT INTO users (name,email,number,message) VALUES ('$name','$email','$number','$message')";
	mysql_query($query);
	echo ' :) ' ;
	} else {   // If Returned user . update the user record
	$query = "UPDATE users SET name='$name', email='$email', number='$number',mesage='$message' where email='$email' ";
	echo ' :( ' ;
	}
//}





?>