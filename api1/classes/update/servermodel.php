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
  public static function updateClass($class_id, $heading, $message)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("UPDATE classes SET heading = ?, message = ? WHERE id=?");
      $sql->bind_param("ssi", $heading, $message, $class_id);
      if($sql->execute()){
        if($sql->affected_rows>0){
          $json["STATUS"] = "Success";
          $json["MESSEGE"] = "Class updated";
          return json_encode($json);
        }
        else{
          $json["STATUS"] = "Fail";
          $json["MESSEGE"] = "Class does not exist";
          return json_encode($json);
        }
      }
      else{
        $json["error"] = "500";
        $json["message"] = "Internal server error";
        return json_encode($json);
      }
    }
}

?>