<?php
if(isset($_POST["username"]) && isset($_POST["password"]))
{
    $data = $_POST;
	unset($_POST);
	getData($data);
}

if(isset($_POST["logout"]) && isset($_POST["logoutid"]) && isset($_POST["logouttoken"]))
{
	$data = $_POST;
	unset($_POST);
	logout($data);
}

if(isset($_POST["id"]) && isset($_POST["token"]))
{
	$data = $_POST;
	unset($_POST);
	sessioncheck($data);
}

function getData($data)
{
	require "DBConnect.php";

	getEncrypt();

	$cipher = $_SESSION["cipher"];
	$iv = $_SESSION["iv"];

	$token = createToken();		

	$sql = "SELECT ID, Username, Password FROM user WHERE Username = ? AND Password = ?";
        
	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "ss", $data["username"], $data["password"])){
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt)){
		die("could not execute the prepared statment");
	}

	$result = mysqli_stmt_get_result($stmt);

	$rowcount = mysqli_num_rows($result);

	if($rowcount !== 0)
	{

		foreach($result as $arrayrow)
		{
			$clientToken = clienttoken($token);
			$serverToken = serverToken($token);
		
			$idhash = openssl_encrypt($arrayrow["ID"], $cipher, $token, $options=0, $iv);
			$_SESSION["serverToken"]= $serverToken;

			if($clientToken . $serverToken == $token)
			{
				echo $idhash . "&" . $clientToken;	

				if(checkDBForToken($arrayrow["ID"]))
				{
					deleteTokenFromDB($arrayrow["ID"]);
					tokenToDB($arrayrow["ID"], $token);
				}
				else {
					tokenToDB($arrayrow["ID"], $token);
				}
			}
			else
			{
				echo"False :( Please login again";
			}
		}
	}  
	else{
		echo "Wrong Username or Password";
	}
}

function createToken()
{
	$token = 0;	
	$rand1 = rand(2, 7);
	for($i=0;$i <= $rand1;$i++)
	{
		$token = (string) $token . random_int(1, 999);
	}
	return $token;
}

function clientToken($token)
{
	$newToken = substr($token, 0, (strlen($token) * 0.5));

	return $newToken;
}

function serverToken($token)
{
	$newToken = substr($token, (strlen($token) * 0.5), strlen($token));

	return $newToken;
}

function checkDBForToken($id)
{
	require "DBConnect.php";

	$sql = "SELECT * FROM login WHERE ID = ?";
        
	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "s", $id)){
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt)){
		die("could not execute the prepared statment");
	}

	$result = mysqli_stmt_get_result($stmt);

	foreach($result as $arrayrow)
	{
		if(isset($arrayrow["Token"]))
		{
			return true;
		}
	}
}

function deleteTokenFromDB($id)
{
	require "DBConnect.php";

	$sql = "DELETE FROM login WHERE ID = ?";
        
	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "s", $id)){
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt)){
		die("could not execute the prepared statment");
	}
}

function tokenToDB($id, $token)
{
	require "DBConnect.php";

	$sql = "INSERT INTO `login`(ID, Token) VALUES (?, ?)";
        
	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "ss", $id, $token)){
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt)){
		die("could not execute the prepared statment");
	}
}

function getEncrypt()
{
	session_start();

	$cipher='AES-128-CBC';
	$ivlen = openssl_cipher_iv_length($cipher);
	$iv = openssl_random_pseudo_bytes($ivlen);

	$_SESSION["cipher"] = $cipher;
	$_SESSION["iv"] = $iv;
}

function sessioncheck($data)
{
	session_start();

	$cipher = $_SESSION["cipher"];
	$vi = $_SESSION["iv"];

	$token = $data["token"] .  $_SESSION["serverToken"];
	$id = openssl_decrypt($data["id"], $cipher, $token, $options=0, $vi);

	$sql = "SELECT token FROM login WHERE ID = ? AND token = ?";
        
	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "ss", $id, $token)){
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt)){
		die("could not execute the prepared statment");
	}

	$result = mysqli_stmt_get_result($stmt);
	
	if($result == False)
	{
		unset($_SESSION["serverToken"]);
		echo false;
	}
}

function logout($data)
{
	require "DBConnect.php";

	$sql = "DELETE FROM login WHERE ID = ?";
        
	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "s", $data[1])){
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt)){
		die("could not execute the prepared statment");
	}
}