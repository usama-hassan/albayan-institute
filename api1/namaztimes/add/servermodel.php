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
  public static function addNamazTime($name, $time, $iqama_time, $sort_number)
  {
    $conn = connection::connectDatabase();
    $sql = $conn->prepare("INSERT INTO namaz_times(name, time, iqama_time, sort_number) VALUES(?, ?, ?, ?)");
    $sql->bind_param("sssi", $name, $time, $iqama_time, $sort_number);
    if($sql->execute()){
      $json["STATUS"] = "Success";
      $json["MESSEGE"] = "Namaz Times Added";
      return json_encode($json);
    }
    else{
      $json["STATUS"] = "Fail";
      $json["MESSEGE"] = "Unable to add namaz time";
      return json_encode($json);
    }
  }  
}

?>