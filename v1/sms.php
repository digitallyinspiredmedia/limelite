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

//get content from form
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];

 //sms
$request =""; //initialise the request variable
$param[method]= "sendMessage";
$param[send_to] = $number;
$param[msg_type] = "TEXT"; //Can be "FLASH”/"UNICODE_TEXT"/”BINARY”
$param[msg] = "Dear Customer, Thank you for registering with Limelite. Kindly fix an appointment with us and show this SMS when you walk in! Thank You!";
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
$to = $email;
$subject = 'Dear '.$name.' - Welcome to Limelite';
$from = 'sikavinraj@email.com';
 
// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
 
// Create email headers
$headers .= 'From: '.$from."\r\n".
    'Reply-To: '.$from."\r\n" .
    'X-Mailer: PHP/' . phpversion();
 
// Compose a simple HTML email message
$message = '<html><body>';
$message .= '<img src="http://limelitesalonandspa.com/images/logo.gif">';
$message .= '<p style="color:#000;font-size:14px; padding-bottom: 10px;border-bottom:1px solid #eee;">Dear Customer, Thank you for registering with Limelite. Kindly fix an appointment with us and show this SMS when you walk in! Thank You!</p>';
$message .= '<p style="color:#000;">Terms and Conditions</p>';
$message .= '<ul>
				<li>This offer cannot be clubbed with any other offer / promotion at the salon.</li>
				<li>This can be redeemed only upon presenting the confirmation Sms / Mail the before availing the services at the salon.</li>
				<li>This offer can be redeemed against services only.</li>
				<li>This offer is valid only on prior appointment.</li>
				<li>Limelite holds the right to make changes or withdraw the promotion as and when required.</li>
				<li>Service tax applicable.</li>
			</ul>';
$message .= '</body></html>';
 
// Sending email
if(mail($to, $subject, $message, $headers)){
    //echo 'Your mail has been sent successfully.';
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
    } else{
    echo 'Unable to send email. Please try again.';
}

    
?>