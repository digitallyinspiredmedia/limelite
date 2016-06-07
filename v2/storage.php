<?php
//db config
define('DB_SERVER', 'limelite.db.9731563.hostedresource.com');
define('DB_USERNAME', 'limelite');    // DB username
define('DB_PASSWORD', 'Lime@123');    // DB password
define('DB_DATABASE', 'limelite');      // DB name
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");
//db connect 
/*CREATE TABLE IF NOT EXISTS `sms` (
  `ID` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(60) DEFAULT NULL,
  `number` varchar(60) NOT NULL,
  `set_value` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
);
*/
//get content from form
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$set_value = $_POST['set_value'];
//sms

$param[send_to] = $number;

if ($set_value == "m0") {
    $param[msg] = "Dear Patron, We are Celebrating our 1st anniversary at LIMELITE-Race course! Avail flat 30% off on services. Hurry, Ltd period offer. Call 0422- 4202006 for appt."; }
 elseif ($answer1 == "m1"){
    $param[msg] = "Dear Patron, Limelite Salon- LB road is closed for renovation from today. To enjoy your continued services at Limelite, Call our nearest salon in Chamiers road: 044-24353751 or ECR-Neelankarai: 044-42868080"; }
 elseif ($answer1 == "m2"){
   $param[msg] = "Dear Patron, Get dreamy makeovers with the LIMELITE MONTH END OFFER ! Avail FLAT 30% OFF on all services at our Racecourse salon . Call 4202006 for appt. Offer valid till May 31 , 2016.T&C."; }
 elseif ($answer1 == "m3"){
    $param[msg] = "Dear Patron, Get dreamy makeovers with the LIMELITE MONTH END OFFER ! Avail FLAT 30% OFF on all services at our Forum mall salon . Call 66528417 for appt. Offer valid till May 31 , 2016.T&C."; }
 elseif ($answer1 == "m4"){
     $param[msg] = "Dear Patron, Get dreamy makeovers with the LIMELITE MONTH END OFFER ! Avail FLAT 30% OFF on all services at our Jayanagar salon . Call 40993255 for appt. Offer valid till May 31 , 2016.T&C."; }
 elseif ($set_value == "f0") {
     $param[msg] = "Dear Patron, Limelite Salon- LB road is currently closed for renovation. To enjoy your continued services at Limelite, Call our nearest salon in ECR-Neelankarai: 044-42868080 or Chamiers road: 044-24353751."; }
 elseif ($answer1 == "f1"){
     $param[msg] = "Dear Patron, Visit Limelite Salon for your new look! Get your Free consultation and Makeover from our Experts today. For details call123"; }
 elseif ($answer1 == "f2"){
     $param[msg] = "Dear Patron, Celebrate this Raksha Bandhan with Limelite Salon! Avail flat 15% off on services. Hurry Ltd period offer. Call 123 for appt. TC"; }
 elseif ($answer1 == "f3"){
     $param[msg] = "Dear Patron, We regret for the inconvenience caused. Limelite -Kilpauk is under renovation. Kindly reach our nearest salon in Nungambakkam for an appt. Call 044-28295270"; }
 elseif ($answer1 == "f4"){
     $param[msg] = "Dear Patron, Enjoy the biggest perks of style only at LIMELITE Salon! Get great discounts from our special combos. Call 123 for details and appt.";
}


$request =""; //initialise the request variable
$param[method]= "sendMessage";

// $param[send_to] = "917811811767";

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




//email 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $set_value = trim($_POST["set_value"]);
        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($set_value) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }
        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = $email;
        // Set the email subject.
        $subject = "New contact from $name";
        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Phone No:\n$number\n";
        $email_content .= "set_value:\n$set_value\n";
        // Build the email headers.
        $email_headers = "From: $name <$email>";
        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {

//function checkuser($ID,$name,$email,$number,$message){
 $check = mysql_query("select * from sms where email='$email'");
    $check = mysql_num_rows($check);
    if (empty($check)) { // if new user . Insert a new record
        $query = "INSERT INTO sms (name,email,number,set_value) VALUES ('$name','$email','$number','$set_value')";
        echo "Thank You! Your message has been sent. :) ";
        http_response_code(200);
        echo $curl_scraped_page;
    } else {   // If Returned user . update the user record
        //$query = "UPDATE sms SET name='$name', email='$email', number='$number',set_value='$set_value' where email='$email' ";
        echo "Thank You! Your message has been sent. but not stored :( ";
        http_response_code(200);
            echo "Thank You! Your message has been sent.";
    }
    mysql_query($query);


        } else {
            // Set a 500 (internal server error) response code.
            http_response_code(500);
            echo "Oops! Something went wrong and we couldn't send your message.";
        }
    } else {
        // Not a POST request, set a 403 (forbidden) response code.
        http_response_code(403);
        echo "There was a problem with your submission, please try again.";
    }
//}

      
?>