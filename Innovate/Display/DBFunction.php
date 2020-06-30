<?php
/*
    Execute Functions    
*/
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

if(isset($_POST["docentID"]) && isset($_POST["docentToken"]) && isset($_POST["status"]))
{
	$data = $_POST;
	unset($_POST);
	setStatus($data);
}

function setStatus($data)
{
	require "../Include/DBConnect.php";

	session_start();

	$cipher = $_SESSION["cipher"];
	$iv = $_SESSION["iv"];

	$token = $data["docentToken"] . $_SESSION["serverToken"];
	$id = openssl_decrypt($data["docentID"], $cipher, $token, $options=0, $iv);
    $status = $data["status"];
    $sql = "UPDATE `docent` SET Status=? WHERE id = ?";
    
    if(!$stmt = mysqli_prepare($conn, $sql))
    {
        die("Could not prepare the given statment");
    }
    else 
    {
        mysqli_stmt_bind_param($stmt, 'is', $status , $id);
        mysqli_stmt_execute($stmt);
    }

    echo ('<div style="text-align:center;margin:0 auto"><p>Status is aangepast naar ');
    switch ($status)
    {
        case 1:
            echo "beschikbaar.";
            break;
        case 2:
            echo "aanwezig.";
            break;
        case 3:
            echo "afwezig.";
            break;
    }
    echo ('</p></div>');
    GetDocent();
}

function GetDocent()
{
	require "../Include/DBConnect.php";

    $sql = "SELECT d.id, voornaam, achternaam, status, foto FROM docent d
        JOIN user u ON u.id = d.id WHERE Statusdisplay = 0";

    if(!$stmt = mysqli_prepare($conn, $sql))
    {
        die("Could not prepare the given statment");
    }
    else 
    {
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        foreach($result as $row)
        {
            $obj[] = $row;        
		}	

        $myJSON = json_encode($obj, JSON_FORCE_OBJECT);
        file_put_contents('teacher.json',$myJSON);
    }      
    mysqli_stmt_close($stmt);
}

function getData($data)
{
	require "../Include/DBConnect.php";

	getEncrypt();

	$cipher = $_SESSION["cipher"];
	$iv = $_SESSION["iv"];

	$token = createToken();		

	$sql = "SELECT ID, Username, Password FROM user WHERE Username = ? AND Password = ?";

	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "ss", $data["username"], $data["password"]))
	{
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt))
	{
		die("could not execute the prepared statment");
	}

	$result = mysqli_stmt_get_result($stmt);

	mysqli_stmt_close($stmt);

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
				else 
				{
					tokenToDB($arrayrow["ID"], $token);
				}
			}
			else
			{
				echo"False :( Please login again";
			}
		}
	}  
	else
	{
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
	require "../Include/DBConnect.php";

	$sql = "SELECT * FROM login WHERE ID = ?";

	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "s", $id))
	{
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt))
	{
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
	mysqli_stmt_close($stmt);
}

function deleteTokenFromDB($id)
{
	require "../Include/DBConnect.php";

	$sql = "DELETE FROM login WHERE ID = ?";

	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "s", $id))
	{
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt))
	{
		die("could not execute the prepared statment");
	}
	mysqli_stmt_close($stmt);
}

function tokenToDB($id, $token)
{
	require "../Include/DBConnect.php";

	$sql = "INSERT INTO `login`(ID, Token) VALUES (?, ?)";

	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "ss", $id, $token))
	{
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt))
	{
		die("could not execute the prepared statment");
	}
	mysqli_stmt_close($stmt);
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
	require "../Include/DBConnect.php";
	
	session_start();

	$cipher = $_SESSION["cipher"];
	$iv = $_SESSION["iv"];

	$token = $data["token"] .  $_SESSION["serverToken"];
	$id = openssl_decrypt($data["id"], $cipher, $token, $options=0, $iv);

	$sql = "SELECT token FROM login WHERE ID = ? AND token = ?";
	echo  $data["id"] ."  " .$id. "  ". $token;
	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "ss", $id, $token))
	{
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt))
	{
		die("could not execute the prepared statment");
	}

	$result = mysqli_stmt_get_result($stmt);
	
	if($result == false)
	{
		unset($_SESSION["serverToken"]);
		echo false;
	}
	mysqli_stmt_close($stmt);
}

function logout($data)
{
	require "../Include/DBConnect.php";

	session_start();

	$cipher = $_SESSION["cipher"];
	$iv = $_SESSION["iv"];

	$token = $data["logouttoken"] . $_SESSION["serverToken"];
	$id = openssl_decrypt($data["logoutid"], $cipher, $token, $options=0, $iv);

	$sql = "DELETE FROM login WHERE ID = ?";

	if(!$stmt = mysqli_prepare($conn, $sql)) 
	{
		die("Gegeven statement niet kunnen preparen");
	}

	if(!mysqli_stmt_bind_param($stmt, "s", $id))
	{
		die("Could not bind the parameters to the prepared statment");
	}

	if(!mysqli_stmt_execute($stmt))
	{
		die("could not execute the prepared statment");
	}
	mysqli_stmt_close($stmt);
}