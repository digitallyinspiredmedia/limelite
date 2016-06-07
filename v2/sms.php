<?php
$request =""; //initialise the request variable
$param[method]= "sendMessage";
$param[send_to] = "917811811767";
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
echo $curl_scraped_page;
?>