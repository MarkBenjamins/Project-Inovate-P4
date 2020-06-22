<?php

getData();

function getData()
{
	require "DBConnect.php";

    if($_POST["username"] && $_POST["password"])
    {
        $data = $_POST;
		unset($_POST);

		$token = createToken();
		$hashedPwd = password_hash($data["password"], PASSWORD_DEFAULT);
		$usernamehash = crypt($data["username"], $token);
		

		$sql = "SELECT ID, Username, Password FROM user WHERE Username = ? AND Password = ?";
        
		if(!$stmt = mysqli_prepare($conn, $sql)) 
		{
			die("Gegeven statement niet kunnen preparen");
		}

		if(!mysqli_stmt_bind_param($stmt, "ss", $data["username"], $data["password"])){
			die("Could not bind the parameters to the preapred statemeng");
		}

		if(!mysqli_stmt_execute($stmt)){
			die("could not execute the preapred statment");
		}

		$result = mysqli_stmt_get_result($stmt);

		foreach($result as $arrayrow)
		{
			echo $arrayrow["ID"];
				
			$clientToken = clienttoken($token);
			$serverToken = serverToken($token);
			$idhash = crypt($arrayrow["ID"], $token);
			if($clientToken . $serverToken == $token)
			{
				echo $idhash . "&" . $clientToken;				
			}
			else
			{
				echo"False :( Please login again";
			}
		}
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



			/*
				if(password_verify($data["password"], $hashedPwd))
				{
					//echo("<br> the password is verified <br>");
				}
				if(password_verify($data["username"], $usernamehash))
				{
					//echo("<br> the username is verified <br>");
				}
				*/
