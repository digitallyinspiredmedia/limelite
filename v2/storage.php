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
  `combo` varchar(60) NOT NULL,
  PRIMARY KEY (`ID`)
);
*/

//get content from form
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$combo = $_POST['set_value'];

 //sms
$request =""; //initialise the request variable
$param[send_to] = $number;
if ($combo == "Men-Combo-One") {
    $param[msg] = "Dear Patron, We are Celebrating our 1st anniversary at LIMELITE-Race course! Avail flat 30% off on services. Hurry, Ltd period offer. Call 0422- 4202006 for appt."; }
 elseif ($combo == "Men-Combo-Two"){
    $param[msg] = "Dear Patron, Limelite Salon- LB road is closed for renovation from today. To enjoy your continued services at Limelite, Call our nearest salon in Chamiers road: 044-24353751 or ECR-Neelankarai: 044-42868080"; }
 elseif ($combo == "Men-Combo-Three"){
   $param[msg] = "Dear Patron, Get dreamy makeovers with the LIMELITE MONTH END OFFER ! Avail FLAT 30% OFF on all services at our Racecourse salon . Call 4202006 for appt. Offer valid till May 31 , 2016.T&C."; }
 elseif ($combo == "Men-Combo-Four"){
    $param[msg] = "Dear Patron, Get dreamy makeovers with the LIMELITE MONTH END OFFER ! Avail FLAT 30% OFF on all services at our Forum mall salon . Call 66528417 for appt. Offer valid till May 31 , 2016.T&C."; }
 elseif ($combo == "Men-Combo-Five"){
     $param[msg] = "Dear Patron, Get dreamy makeovers with the LIMELITE MONTH END OFFER ! Avail FLAT 30% OFF on all services at our Jayanagar salon . Call 40993255 for appt. Offer valid till May 31 , 2016.T&C."; }
 elseif ($combo == "Female-Combo-One") {
     $param[msg] = "Dear Patron, Limelite Salon- LB road is currently closed for renovation. To enjoy your continued services at Limelite, Call our nearest salon in ECR-Neelankarai: 044-42868080 or Chamiers road: 044-24353751."; }
 elseif ($combo == "Female-Combo-Two"){
     $param[msg] = "Dear Patron, Visit Limelite Salon for your new look! Get your Free consultation and Makeover from our Experts today. For details call123"; }
 elseif ($combo == "Female-Combo-Three"){
     $param[msg] = "Dear Patron, Celebrate this Raksha Bandhan with Limelite Salon! Avail flat 15% off on services. Hurry Ltd period offer. Call 123 for appt. TC"; }
 elseif ($combo == "Female-Combo-Four"){
     $param[msg] = "Dear Patron, We regret for the inconvenience caused. Limelite -Kilpauk is under renovation. Kindly reach our nearest salon in Nungambakkam for an appt. Call 044-28295270"; }
 elseif ($combo == "Female-Combo-Five"){
     $param[msg] = "Dear Patron, Enjoy the biggest perks of style only at LIMELITE Salon! Get great discounts from our special combos. Call 123 for details and appt.";
}

$param[method]= "sendMessage";
// $param[send_to] = "917811811767";
$param[msg_type] = "TEXT"; //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
$param[userid] = "2000142572";
$param[password] = "q1ocL2FL4";
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
        $combo = trim($_POST["set_value"]);
        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($combo) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }
        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = $email;
        // Set the email subject.
        $subject = "Thankyou Dear Patron : $name";
        // Build the email content.
        $email_content .= "Coupon Code:\n$combo\n";
        $email_content .= "Mesage Templete:\n$param[msg] \n";
        $email_content .= "Terms and Condition :\n Bla bal bla bla \n";
        // Build the email headers.
        $email_headers = "From: $name <$email>";
        // Send the email.
        if (mail($recipient, $subject, $email_content, $email_headers)) {
           // function checkuser($name,$email,$number,$combo){
             $check = mysql_query("select * from sms where email='$email'");
                $check = mysql_num_rows($check);
                if (empty($check)) { // if new user . Insert a new record
                $query = "INSERT INTO sms (name,email,number,combo) VALUES ('$name','$email','$number','$combo')";
                mysql_query($query);
                //status of email 
                //http_response_code(200);
                //status of store
                //echo "Thank You! Your message has been sent. :) :) :) , please check your email id ";
                //status of sms ok 
                //echo $curl_scraped_page;

                    header("Location: thankyou.php");
                } else {   // If Returned user . update the user record
                //$query = "UPDATE sms SET name='$name', email='$email', number='$number',combo='$combo' where email='$email' ";
                $query = "INSERT INTO sms (name,email,number,combo) VALUES ('$name','$email','$number','$combo')";
                mysql_query($query);
            //status of email 
                //http_response_code(200);
            //status of store
                //echo "Thank You! Your message has been sent. :) :) :) , please check your email id ";
            //status of sms
                //echo $curl_scraped_page;
                 header("Location: thankyou.php");
                }
            }

        //}
        
 }
      
?>