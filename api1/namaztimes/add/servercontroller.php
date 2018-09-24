<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("servermodel.php");

$req = $_REQUEST['REQUEST_TYPE'];

if ($req == 'ADDNAMAZTIME')
{
	echo add_namaz_time();
}

function add_namaz_time()
{
	$userid = $_REQUEST['id'];
	$name = $_REQUEST['name'];
	$time = $_REQUEST['time'];
	$iqama_time = $_REQUEST['iqama_time'];
	$sort_number = $_REQUEST['sort_number'];

	if(authenticator::authenticateToken($_SERVER['HTTP_AUTH_TOKEN'], $userid)){
		return DataAccessHelper::addNamazTime($name, $time, $iqama_time, $sort_number);
	}
	else{
		$json["error"] = "500";
        $json["message"] = "Internal server error";
        return json_encode($json);
	}
}
?>