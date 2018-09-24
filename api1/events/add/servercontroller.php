<?php

header('Access-Control-Allow-Headers: Authorization');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: Authorization');

include("servermodel.php");

$req = $_REQUEST['REQUEST_TYPE'];

if ($req == 'ADDEVENT')
{
	echo add();
}

function add()
{
	$userid = $_REQUEST['id'];
	$heading = $_REQUEST['heading'];
	$message = $_REQUEST['message'];
	if(authenticator::authenticateToken($_SERVER['HTTP_AUTH_TOKEN'], $userid)){
		return DataAccessHelper::addEvent($heading, $message);
	}
	else{
		$json["error"] = "500";
        $json["message"] = "Internal server error";
        return json_encode($json);
	}
}
?>