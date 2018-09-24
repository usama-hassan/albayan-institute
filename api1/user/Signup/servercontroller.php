<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("servermodel.php");

$req = $_REQUEST['REQUEST_TYPE'];

if ($req == 'SIGNUP') {
	echo signup();
}

function signup()
{
	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$password = $_REQUEST['password'];

	return DataAccessHelper::signupFunction($name, $email, $password);
}
?>