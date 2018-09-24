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
  public static function updateUser($token_id, $token)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("UPDATE devices SET fcm_token = ? WHERE id = ?");
      $sql->bind_param("si", $token, $token_id);
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