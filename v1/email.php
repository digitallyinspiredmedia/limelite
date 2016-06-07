<?php
//db config
define('DB_SERVER', 'limelite.db.9731563.hostedresource.com');
define('DB_USERNAME', 'limelite');    // DB username
define('DB_PASSWORD', 'Lime@123');    // DB password
define('DB_DATABASE', 'limelite');      // DB name
$connection = mysql_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD) or die( "Unable to connect");
$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");

//get content from form
$name = $_POST['name'];
$email = $_POST['email'];
$number = $_POST['number'];
$message = $_POST['message'];

//test
$accountSid = $_POST['accountSid'];
$password = $_POST['password'];
$tonumber = $_POST['to'];
$bodycontent = $_POST['body'];

 if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form fields and remove whitespace.
        $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
        $message = trim($_POST["message"]);
        // Check that data was sent to the mailer.
        if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Set a 400 (bad request) response code and exit.
            http_response_code(400);
            echo "Oops! There was a problem with your submission. Please complete the form and try again.";
            exit;
        }
        // Set the recipient email address.
        // FIXME: Update this to your desired email address.
        $recipient = "$email";
       // $cc = "$email";

        // Set the email subject.
        $subject = "New contact from $name";
        // Build the email content.
        $email_content = "Name: $name\n";
        $email_content .= "Email: $email\n\n";
        $email_content .= "Phone No:\n$number\n";
        $email_content .= "Message:\n$message\n";
        //test
        $email_content .= "accountSid:\n$accountSid\n";
        $email_content .= "password:\n$password\n";
        $email_content .= "tonumber:\n$tonumber\n";
        $email_content .= "bodycontent:\n$bodycontent\n";
        // Build the email headers.
        $email_headers = "From: $name <$email>";
        // Send the email.
        if (mail($recipient,$subject, $email_content, $email_headers)) {
        //if (mail($recipient,$cc, $subject, $email_content, $email_headers)) {
           
            //function checkuser($ID,$name,$email,$number,$message){

 $check = mysql_query("select * from users where email='$email'");
    $check = mysql_num_rows($check);
    if (empty($check)) { // if new user . Insert a new record
    $query = "INSERT INTO users (name,email,number,message) VALUES ('$name','$email','$number','$message')";
    mysql_query($query);
     // Set a 200 (okay) response code.
            http_response_code(200);
            echo "Thank You! Your message has been sent.";
    echo ' :) ' ;
    } else {   // If Returned user . update the user record
    $query = "UPDATE users SET name='$name', email='$email', number='$number',mesage='$message' where email='$email' ";
     http_response_code(200);
            echo "Thank You! Your message has been sent. but not stored";
    echo ' :( ' ;
    }
//}

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
?>