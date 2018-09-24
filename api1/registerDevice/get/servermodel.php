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
  public static function getDevice($device_id)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("SELECT * FROM devices WHERE id = ?");
      $sql->bind_param("i", $device_id);
      $sql->execute();
      $sql->bind_result($a, $b, $c, $d);
      if ($sql->execute())
      {
        $json["STATUS"] = "SUCCESS";

        $sql->bind_result($a1, $a2, $a3, $a4);
        $counter = 0;

        while($sql->fetch())
        {
          $temp["id"] = $a1;
          $temp["fcm_token"] = $a2;
          $temp["created_at"] = $a3;
          $temp["updated-at"] = $a4;
          $json["DATA"][] = $temp;
          $counter++;
        }
        $json["count"] = $counter;
      }
      else
      {
        $json["STATUS"] = "FAIL";
      }
      $sql->close();
      mysqli_close($conn);
      return json_encode($json);
    }
}

?>