<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
include("../../security.php");
include("../../connection.php");

class DataAccessHelper
{
	public static function signupFunction($name, $email, $password)
  	{
  		$conn = connection::connectDatabase();
      
      $encrypted_password = security::Encrypt($password, ENCRYPTION_KEY);
  		$sql = $conn->prepare("INSERT INTO system_admins(name, email, password) VALUES(?, ?, ?)");

  		$sql->bind_param("sss", $name, $email, $encrypted_password);

  		if ($sql->execute())
      {
    		$json["STATUS"] = "Success";
        $json["MESSAGE"] = "Sign Up Successfull";
      }
  		else
  		{
    		$json["STATUS"] = "Fail";
        $json["MESSAGE"] = "Sign Up Failed";
 	 	  }
      
  		$sql->close();
  		mysqli_close($conn); 
  		return json_encode($json);
  	}
}

?>