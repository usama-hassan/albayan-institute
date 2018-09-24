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
  public static function loginFunction($email, $password)
    {
      $auth_token = authenticator::newAuthToken();

      $conn2 = connection::connectDatabase();
      $sql2 = $conn2->prepare("UPDATE system_admins SET auth_token='".$auth_token."' WHERE email = ?");
      $sql2->bind_param("s", $email);
      $sql2->execute();

      $conn = connection::connectDatabase();
      $sql = $conn->prepare("SELECT id, name, email, password, auth_token FROM system_admins WHERE email = ?");
      $sql->bind_param("s", $email);
      $sql->execute();
      $sql->bind_result($a1, $a2, $a3, $a4, $a5);

      if($sql->fetch())
      {
          $decrypted_password = security::Decrypt($a4, ENCRYPTION_KEY);
          if((strcmp($a3, $email) == 0) && (strcmp($decrypted_password, $password) == 0))
          {
            $json["STATUS"] = "Success";
            $json["MESSEGE"] = "Login Successful";
            $json["ID"] = $a1;
            $json["NAME"] = $a2;
            $json["EMAIL"] = $a3;
            $json["AUTH_TOKEN"] = $a5;

          }
          else
          {
            $json["STATUS"] = "FAIL";
            $json["MESSEGE"] = "User not found.";
          }

          $sql->close();
          mysqli_close($conn);
          return json_encode($json);
      }
      else{
        $json["STATUS"] = "FAIL";
        $json["MESSEGE"] = "User not found.";
        return json_encode($json);
      } 
    }
}

?>