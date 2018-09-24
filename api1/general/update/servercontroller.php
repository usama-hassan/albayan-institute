<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("servermodel.php");

$req = $_REQUEST['REQUEST_TYPE'];

if ($req == 'UPDATEMESSAGE')
{
	echo update();
}

function update()
{
	$userid = $_REQUEST['id'];
	$message_id = $_REQUEST['message_id'];
	$heading = $_REQUEST['heading'];
	$message = $_REQUEST['message'];
	if(authenticator::authenticateToken($_SERVER['HTTP_AUTH_TOKEN'], $userid)){
		return DataAccessHelper::updateMessage($message_id, $heading, $message);
	}
	else{
		$json["error"] = "500";
        $json["message"] = "Internal server error";
        return json_encode($json);
	}
}
?>