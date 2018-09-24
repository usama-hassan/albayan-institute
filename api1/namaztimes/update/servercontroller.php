<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("servermodel.php");

$req = $_REQUEST['REQUEST_TYPE'];

if ($req == 'UPDATENAMAZTIME')
{
	echo update();
}

function update()
{
	$userid = $_REQUEST['id'];
	$namaz_id = $_REQUEST['namaz_id'];
	$name = $_REQUEST['name'];
	$time = $_REQUEST['time'];
	$iqama_time = $_REQUEST['iqama_time'];
	$sort_num = $_REQUEST['sort_num'];
	if(authenticator::authenticateToken($_SERVER['HTTP_AUTH_TOKEN'], $userid)){
		return DataAccessHelper::updateNamazTime($namaz_id, $name, $time, $iqama_time, $sort_num);
	}
	else{
		$json["error"] = "500";
        $json["message"] = "Internal server error";
        return json_encode($json);
	}
}
?>