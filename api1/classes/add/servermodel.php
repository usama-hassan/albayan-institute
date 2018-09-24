<?php
header('Access-Control-Allow-Origin: *');
include("../../security.php");
include("../../connection.php");
include("../../authClass.php");

class DataAccessHelper
{
  public static function addClass($heading, $message)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("INSERT INTO classes(heading, message) VALUES(?, ?)");
      $sql->bind_param("ss", $heading, $message);
      if($sql->execute()){
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "Class Added";
        return json_encode($json);
      }
      else{
        $json["STATUS"] = "Fail";
        $json["MESSEGE"] = "Unable to add class";
        return json_encode($json);
      }
    }
}

?>