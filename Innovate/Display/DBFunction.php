<?php
/*
    Space to call Functions    
*/
if($_POST["username"] && $_POST["password"])
{
	$data = $_POST;
	unset($_POST);
	getData($data);
}
GetDocent();
setStatus();

/*
******************************
*/

function setStatus()
{
    require "DBConnect.php";
    
    if($_POST)
    {
        $data = $_POST;
        $teacher= array_keys($data)[0];
        $status = $data[$teacher];
        $sql = "UPDATE `docent` SET Status=? WHERE id = ?";
    
        if(!$stmt = mysqli_prepare($conn, $sql))
        {
            die("Could not prepare the given statment");
        }
        else 
        {
            mysqli_stmt_bind_param($stmt, 'is', $status , $teacher);
            mysqli_stmt_execute($stmt);
        }
    }
    else
    {
        echo("<br>Komt geen get/post binnen <br>");
	}
}

function GetDocent()
{
    require "DBConnect.php";
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

function getData()
{
	require "DBConnect.php";

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
			//writeToDB($id, $token);																			Nice to have Later
		}
		else
		{
			echo"False :( Please login again";
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

