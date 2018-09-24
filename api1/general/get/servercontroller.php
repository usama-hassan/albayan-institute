<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("servermodel.php");

$req = $_REQUEST['REQUEST_TYPE'];

if ($req == 'GETACTIVITIES')
{
	echo get1();
}
if ($req == 'GETCLASSES')
{
	echo get2();
}
if ($req == 'GETEVENTS')
{
	echo get3();
}
if ($req == 'GETSERVICES')
{
	echo get4();
}

function get1()
{
		return DataAccessHelper::getMessages1();
}
function get2()
{
		return DataAccessHelper::getMessages2();
}
function get3()
{
		return DataAccessHelper::getMessages3();
}
function get4()
{
		return DataAccessHelper::getMessages4();
}
?>