<?php
/*
    Execute Functions    
*/
//Checked of username en password gezet zijn
if(isset($_POST["username"]) && isset($_POST["password"]))
{
    $data = $_POST;
	unset($_POST);
	getData($data);
}
//Checked of logout, lougoutid en logouttoken gezet zijn
if(isset($_POST["logout"]) && isset($_POST["logoutid"]) && isset($_POST["logouttoken"]))
{
	$data = $_POST;
	unset($_POST);
	logout($data);
}
//Checked of id en token gezet zijn
if(isset($_POST["id"]) && isset($_POST["token"]))
{
	$data = $_POST;
	unset($_POST);
	sessioncheck($data);
}
//Checked of docentID, docentTokenID en status gezet zijn
if(isset($_POST["docentID"]) && isset($_POST["docentToken"]) && isset($_POST["status"]))
{
	$data = $_POST;
	unset($_POST);
	setStatus($data);
}
//Krijgt data waarmee het mogelijk is om de status aan te passen in de database en doet dat
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
//vraagt de data van de docenten op uit de database en schrijft deze weg in de teacher.json
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
//Checked de login tegen de database 
//krijgt een token uit clienttoken en servertoken
//encrypt de ID en stuurt deze mee met de clientToken
//De clienttoken + de servertoken maken samen een volledige token die vergeleken word met de token + id in de database
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
//Maakt de volledige token
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
//pakt het stuk van de token wat de clienttoken word
function clientToken($token)
{
	$newToken = substr($token, 0, (strlen($token) * 0.5));
	return $newToken;
}
//Pakt het stuk van de token wat de servertoken word
function serverToken($token)
{
	$newToken = substr($token, (strlen($token) * 0.5), strlen($token));
	return $newToken;
}
//Checked de volledige token + id tegen de database als een sessie vertificatie
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
//Als de sessie geen resultaat oplevered tijdens het vergelijken met de database word deze token verwijdered en de sessie unset
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
//Schrijft de token + iD weg in de database
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
//Hier staan de encryptie informatie van het ID 
function getEncrypt()
{
	session_start();

	$cipher='AES-128-CBC';
	$ivlen = openssl_cipher_iv_length($cipher);
	$iv = openssl_random_pseudo_bytes($ivlen);

	$_SESSION["cipher"] = $cipher;
	$_SESSION["iv"] = $iv;
}
//Checked of de sessie nog volledig is in vergelijking tot de database
function sessioncheck($data)
{
	require "../Include/DBConnect.php";
	
	session_start();

	$cipher = $_SESSION["cipher"];
	$iv = $_SESSION["iv"];

	$token = $data["token"] .  $_SESSION["serverToken"];
	$id = openssl_decrypt($data["id"], $cipher, $token, $options=0, $iv);

	$sql = "SELECT token FROM login WHERE ID = ? AND token = ?";
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
	
	if(mysqli_num_rows($result) == 0)
	{
		unset($_SESSION["serverToken"]);
	}
	mysqli_stmt_close($stmt);
}
//Logt de user uit door middle van de id + token uit de database te verwijderen en de sessie te stoppen
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