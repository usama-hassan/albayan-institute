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
  public static function addUser($name,$email,$phone)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("INSERT INTO users(name, email, phone) VALUES(?,?,?)");
      $sql->bind_param("sss", $name,$email,$phone);
      if($sql->execute()){
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "User Added";
        return json_encode($json);
      }
      else{
        $json["STATUS"] = "Fail";
        $json["MESSEGE"] = "Unable to add user";
        return json_encode($json);
      }
    }
}

?>