<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, 
    X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control, AUTH-TOKEN");
class authenticator
{ 
    public static function newAuthToken() {
        $characters = '0123456789@.,;[]{}!@#$%^&abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 100; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public static function authenticateToken($token, $id){
    	$conn = connection::connectDatabase();
	    $sql = $conn->prepare("SELECT * FROM system_admins WHERE id = ? AND auth_token = ?");
	    $sql->bind_param("is", $id,$token);
	    $sql->execute();
	    if($sql->fetch()){
	    	return true;
	    }
	    return false;
    }
}

?>