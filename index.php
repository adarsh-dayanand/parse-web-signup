<?php
require 'autoload.php';

use Parse\ParseClient;
ParseClient::initialize( "<APP_ID>", "<REST_API>", "<MASTER-KEY>" );
ParseClient::setServerURL('https://parseapi.back4app.com', '/');
header('X-Parse-Application-Id: <APP-ID>');
header('X-Parse-REST-API-Key: <REST_API>');
header('X-Parse-Revocable-Session: 1');
header('Content-Type: application/json');
	
use Parse\ParseException;
use Parse\ParseObject;
use Parse\ParseUser;
$user = new ParseUser();

$curl = curl_init();
if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['email'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];
}
else{
    header(signup.html);
}
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, [
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://parseapi.back4app.com/users',
    CURLOPT_USERAGENT => 'Codular Sample cURL Request',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => [
        
        $user->set("username", $username),
        $user->set("password", $password),
        $user->set("email", $email)

    ]
]);
// Send the request & save response to $resp
$resp = curl_exec($curl);
// Close request to clear up some resources
curl_close($curl);




try {
  $user->signUp();
  // Hooray! Let them use the app now.
} catch (ParseException $ex) {
  // Show the error message somewhere and let the user try again.
  echo "Error: " . $ex->getCode() . " " . $ex->getMessage();
}


?>