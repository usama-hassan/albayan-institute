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
  public static function deleteClass($classid)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("DELETE FROM classes WHERE id = ?");
      $sql->bind_param("i", $classid);
      if($sql->execute()){
        if($sql->affected_rows>0){
          $json["STATUS"] = "Success";
          $json["MESSEGE"] = "Class deleted";
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