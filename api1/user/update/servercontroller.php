<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("servermodel.php");

$req = $_REQUEST['REQUEST_TYPE'];

if ($req == 'UPDATEUSER')
{
	echo update();
}

function update()
{
	$userid = $_REQUEST['id'];
	$u_id = $_REQUEST['u_id'];
	$name = $_REQUEST['name'];
	$email = $_REQUEST['email'];
	$phone = $_REQUEST['phone'];
	if(authenticator::authenticateToken($_SERVER['HTTP_AUTH_TOKEN'], $userid)){
		return DataAccessHelper::updateUser($u_id, $name, $email, $phone);
	}
	else{
		$json["error"] = "500";
        $json["message"] = "Internal server error";
        return json_encode($json);
	}
}
?>