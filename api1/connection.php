<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
class connection
{ 
	   private static function getConnection() 
  	 {
  		  $conn = null;
    	  $conn = new mysqli('localhost','root','','albayanorg_mobiledb');
		    return $conn;
  	 }

  	 public static function connectDatabase() 
  	 {
		  return connection::getConnection();
  	 }
}

?>