<?php
header('Access-Control-Allow-Origin: *');
include("../../security.php");
include("../../connection.php");
include("../../authClass.php");

class DataAccessHelper
{
  public static function addService($heading, $message)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("INSERT INTO services(heading, message) VALUES(?, ?)");
      $sql->bind_param("ss", $heading, $message);
      if($sql->execute()){
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "Service Added";
        return json_encode($json);
      }
      else{
        $json["STATUS"] = "Fail";
        $json["MESSEGE"] = "Unable to add service";
        return json_encode($json);
      }
    }
}

?>