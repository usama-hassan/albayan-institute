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
  public static function getNamazTime()
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("SELECT * FROM namaz_times ORDER BY sort_number, created_on");
      if($sql->execute()){
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "Namaz Times Fetched";
        $sql->bind_result($a, $b, $c, $d, $e, $f, $g);
        $counter = 0;

        while($sql->fetch())
        {
          $temp["id"] = $a;
          $temp["name"] = $b;
          $temp["time"] = $c;
          $temp["iqama"] = $d;
          $temp["sort_number"] = $e;
          $temp["created_on"] = $f;
          $temp["updated_on"] = $g;
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