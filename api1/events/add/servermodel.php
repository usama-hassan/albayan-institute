<?php
header('Access-Control-Allow-Origin: *');
include("../../security.php");
include("../../connection.php");
include("../../authClass.php");

class DataAccessHelper
{
  public static function addEvent($heading, $message)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("INSERT INTO events(heading, message) VALUES(?, ?)");
      $sql->bind_param("ss", $heading, $message);
      if($sql->execute()){
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "Event Added";
        return json_encode($json);
      }
      else{
        $json["STATUS"] = "Fail";
        $json["MESSEGE"] = "Unable to add event";
        return json_encode($json);
      }
    }
}

?>