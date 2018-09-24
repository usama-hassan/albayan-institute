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
  private static function sendNotification($heading,$message,$token){
    // $registrationIds = $_GET['id'];

     $msg = array
          (
          'body'  => $message,
          'title' => $heading,
          'icon'  => 'myicon',
          'sound' => 'default',
          'badge' => '1'
          );
      $fields = array
      (
        'to' => $token,
        'notification'  => $msg
      );
  
  
  $headers = array
      (
        'Authorization: key=' . "AAAAYFWtqdQ:APA91bG4Rmz96PBCnkYBnAIf-_Xf74n9E-PU0WJsIMv8nAGI6Ej2FohJva-fre2f4c87e3sSE5d4EHuYpHBbtKHdSPNisv5e54BWKuS_hXke57iC0AtL4uMhoPsNIRX-O3HAyekWBdik",
        'Content-Type: application/json'
      );
    $ch = curl_init();
    curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
    curl_setopt( $ch,CURLOPT_POST, true );
    curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
    curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
    curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
    curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
    $result = curl_exec($ch );
    curl_close( $ch );
    // echo $result;
  }
  public static function addMessage($heading,$message)
    {
      $conn = connection::connectDatabase();
      $sql = $conn->prepare("INSERT INTO messages(heading, message) VALUES(?,?)");
      $sql->bind_param("ss", $heading, $message);
      if($sql->execute()){
        $conn2 = connection::connectDatabase();
        $sql2 = $conn->prepare("SELECT * FROM devices");
        $sql2->execute();
        $sql2->bind_result($a, $b, $c, $d);
        while($sql2->fetch())
        {
          DataAccessHelper::sendNotification($heading,$message,$b);
        }
        $json["STATUS"] = "Success";
        $json["MESSEGE"] = "Message Added";
        return json_encode($json);
      }
      else{
        $json["STATUS"] = "Fail";
        $json["MESSEGE"] = "Unable to add message";
        return json_encode($json);
      }
    }
}

?>