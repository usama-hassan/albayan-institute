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
  public static function deleteNamazTime($namaz_time_id)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("DELETE FROM namaz_times WHERE id = ?");
      $sql->bind_param("i", $namaz_time_id);
      if($sql->execute()){
        if($sql->affected_rows>0){
          $json["STATUS"] = "Success";
          $json["MESSEGE"] = "Namaz time deleted";
          return json_encode($json);
        }
        else{
          $json["STATUS"] = "Fail";
          $json["MESSEGE"] = "Namaz time does not exist";
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