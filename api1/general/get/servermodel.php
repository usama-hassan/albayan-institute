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
  public static function getMessages1()
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("SELECT * FROM activities ORDER BY created_at DESC");
      if($sql->execute()){
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "Messages Fetched";
        $sql->bind_result($a, $b, $c, $d);
        $counter = 0;

        while($sql->fetch())
        {
          $temp["id"] = $a;
          $temp["heading"] = $b;
          $temp["message"] = $c;
          $temp["created_at"] = $d;
          $json["DATA"][] = $temp;
          $counter++;
        }
        $json["count"] = $counter;
      }
      else{
        $json["error"] = "500";
        $json["message"] = "Internal server error";
      }
      return json_encode($json);
    }

    public static function getMessages2()
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("SELECT * FROM classes ORDER BY created_at DESC");
      if($sql->execute()){
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "Messages Fetched";
        $sql->bind_result($a, $b, $c, $d);
        $counter = 0;

        while($sql->fetch())
        {
          $temp["id"] = $a;
          $temp["heading"] = $b;
          $temp["message"] = $c;
          $temp["created_at"] = $d;
          $json["DATA"][] = $temp;
          $counter++;
        }
        $json["count"] = $counter;
      }
      else{
        $json["error"] = "500";
        $json["message"] = "Internal server error";
      }
      return json_encode($json);
    }

    public static function getMessages3()
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("SELECT * FROM events ORDER BY created_at DESC");
      if($sql->execute()){
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "Messages Fetched";
        $sql->bind_result($a, $b, $c, $d);
        $counter = 0;

        while($sql->fetch())
        {
          $temp["id"] = $a;
          $temp["heading"] = $b;
          $temp["message"] = $c;
          $temp["created_at"] = $d;
          $json["DATA"][] = $temp;
          $counter++;
        }
        $json["count"] = $counter;
      }
      else{
        $json["error"] = "500";
        $json["message"] = "Internal server error";
      }
      return json_encode($json);
    }

    public static function getMessages4()
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("SELECT * FROM services ORDER BY created_at DESC");
      if($sql->execute()){
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "Messages Fetched";
        $sql->bind_result($a, $b, $c, $d);
        $counter = 0;

        while($sql->fetch())
        {
          $temp["id"] = $a;
          $temp["heading"] = $b;
          $temp["message"] = $c;
          $temp["created_at"] = $d;
          $json["DATA"][] = $temp;
          $counter++;
        }
        $json["count"] = $counter;
      }
      else{
        $json["error"] = "500";
        $json["message"] = "Internal server error";
      }
      return json_encode($json);
    }
}

?>