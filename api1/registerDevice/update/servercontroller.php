<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("servermodel.php");

$req = $_REQUEST['REQUEST_TYPE'];

if ($req == 'UPDATETOKEN')
{
	echo update();
}

function update()
{
	$token_id = $_REQUEST['token_id'];
	$token = $_REQUEST['fcm_token'];
	return DataAccessHelper::updateUser($token_id, $token);
}
?>