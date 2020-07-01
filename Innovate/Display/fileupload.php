<?php   
if(isset($_FILES['image']))
{
    $data = $_FILES['image'];
    unset($_FILES);
    saveImage($data);
}
if(isset($_POST["idDB"]) && isset($_POST["tokenDB"]) && isset($_POST["nameDB"]))
{
    $data = $_POST;
    unset($_POST);
    sendtodbo($data);
}
if(isset($_GET["id"]) && isset($_GET["token"]))
{
    $data = $_GET;
    $unset($_GET);
    getID($data);
}

function saveImage($data)
{
    $file = $data["tmp_name"];
    $location = '../img/message/';
   
    if(move_uploaded_file($data["tmp_name"], $location . $data["name"]))
    {
       echo("Message added!");
    }
    else 
    {
    	echo"Message NOT added, Try another .jpg, .jpeg or a .png file";
    }
}

function sendtodbo($data)
{
    require "../Include/DBConnect.php";
    require "DBFunction.php";
    session_start();
	$cipher = $_SESSION["cipher"];
	$iv = $_SESSION["iv"];
    $location = '../img/message/' . $data["nameDB"];
    $null = 0;

	$token = $data["tokenDB"] . $_SESSION["serverToken"];
	$id = openssl_decrypt($data["idDB"], $cipher, $token, $options=0, $iv);
    
    if(checkForDouble($id, $location))
    {
        $sql = "INSERT INTO bericht (userID, link, ShowBericht) VALUES (?, ?, ?)";

        if(!$stmt = mysqli_prepare($conn, $sql)) 
	    {
		    die("Gegeven statement niet kunnen preparen");
	    }

	    if(!mysqli_stmt_bind_param($stmt, "isi", $id, $location, $null))
	    {
		    die("Could not bind the parameters to the prepared statment");
	    }

	    if(!mysqli_stmt_execute($stmt))
	    {
		    die("could not execute the prepared statment");
	    }
	    mysqli_stmt_close($stmt);
        echo("Bericht toegevoegd");
        getMessage();
    }
    else 
    {
	    echo("Dit bericht staat al in de database");
    }
}

function checkForDouble($id, $location)
{
    require "../Include/DBConnect.php";

    $sql = "SELECT userID FROM bericht WHERE UserID = ? AND Link = ?";

    if(!$stmt = mysqli_prepare($conn, $sql))
    {
        die("Could not prepare the given statment");
    }
    else 
    {
        if(!mysqli_stmt_bind_param($stmt, "is", $id, $location))
	    {
		    die("Could not bind the parameters to the prepared statment");
	    }

        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);
        $rowcount = mysqli_num_rows($result);

	    if($rowcount == 0)
        {
            return true;
        }    
    }      
    mysqli_stmt_close($stmt);
}

function getMessage()
{
	require "../Include/DBConnect.php";

    $sql = "SELECT UserID, Link FROM bericht";

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

        $messages = json_encode($obj, JSON_FORCE_OBJECT);
        file_put_contents('message.json', $messages);
    }      
    mysqli_stmt_close($stmt);
}


function getID($data)
{
    require "DBFunction.php";
    session_start();
	$cipher = $_SESSION["cipher"];
	$iv = $_SESSION["iv"];
    $id = openssl_decrypt($data["id"], $cipher, $token, $options=0, $iv);
    echo $id;
}

?>