<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("servermodel.php");

$req = $_REQUEST['REQUEST_TYPE'];

if ($req == 'GETSERVICE')
{
	echo get();
}

function get()
{
		return DataAccessHelper::getService();
}
?>