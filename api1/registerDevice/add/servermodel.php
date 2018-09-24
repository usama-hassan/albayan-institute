<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("../../security.php");
include("../../connection.php");
include("../../authClass.php");

class DataAccessHelper
{
  public static function addUser($token)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("INSERT INTO devices(fcm_token) VALUES(?)");
      $sql->bind_param("s", $token);
      if($sql->execute()){
        $json["STATUS"] = "Success";
        return json_encode($json);
      }
      else{
        $json["STATUS"] = "Fail";
        return json_encode($json);
      }
    }
}

?>