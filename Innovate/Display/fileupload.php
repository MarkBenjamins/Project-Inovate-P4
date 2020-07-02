<?php
//Kijkt of $_FILES["image"] gezet is
if(isset($_FILES['image']))
{
    $data = $_FILES['image'];
    unset($_FILES);
    saveImage($data);
}
//Kijkt of $_POST["idDB"] en isset($_POST["tokenDB"] en isset($_POST["nameDB"] gezet is
if(isset($_POST["idDB"]) && isset($_POST["tokenDB"]) && isset($_POST["nameDB"]))
{
    $data = $_POST;
    unset($_POST);
    sendtodbo($data);
}
//Kijkt of isset($_GET["id"]) en isset($_GET["token"]) gezet is
if(isset($_GET["id"]) && isset($_GET["token"]))
{
    $data = $_GET;
    unset($_GET);
    getID($data);
}
//Kijkt of isset($_POST["deleteID"]) en isset($_POST["deleteLink"])) gezet is
if(isset($_POST["deleteID"]) && isset($_POST["deleteLink"]))
{
    $data = $_POST;
    unset($_POST);
    deleteImg($data);
}
//Kijkt of isset($_POST["showID"]) en isset($_POST["showLink"]) en isset($_POST["showMessage"]) gezet is
if(isset($_POST["showID"]) && isset($_POST["showLink"]) && isset($_POST["showMessage"]))
{
    $data = $_POST;
    unset($_POST);
    setShowMesssage($data);
}
//Slaat het bericht op, op de server
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
//verzend de locatie van het bericht + de ID van de gebruiker naar de database
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
//Controlleerd op in de database of de locatie en de UserID combinatie al bestaat in de database
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
//Vraagt alle berichten uit de database op en zet deze in message.json
function getMessage()
{
	require "../Include/DBConnect.php";

    $sql = "SELECT UserID, Link, ShowBericht FROM bericht";

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
//decrypt het ID van de gebruiker naar een leesbaar ID
function getID($data)
{
    getMessage();
    require "DBFunction.php";
    session_start();
	$cipher = $_SESSION["cipher"];
    $iv = $_SESSION["iv"];
    $token = $data["token"] . $_SESSION["serverToken"];
    $id = openssl_decrypt($data["id"], $cipher, $token, $options=0, $iv);
    echo $id;
}
//Verwijdered de link en het bestand uit de database en de server
function deleteImg($data)
{
    require "../Include/DBConnect.php";
    $deleteid = $data["deleteID"];
    $deletelink = $data["deleteLink"];

    $sql = "DELETE FROM bericht WHERE UserID = ? AND Link = ?";

    if(!$stmt = mysqli_prepare($conn, $sql))
    {
        die("Could not prepare the given statment");
    }
    else 
    {
        if(!mysqli_stmt_bind_param($stmt, "is", $deleteid, $deletelink))
        {
            die("Could not bind the parameters to the given statment");
        }
        mysqli_stmt_execute($stmt);
        unlink($deletelink);
    }      
    mysqli_stmt_close($stmt);
    getMessage();
    return true;
}
//Update de showMessage van 0 naar 1 of van 1 naar 0
function setShowMesssage($data)
{
    require "../Include/DBConnect.php";
    $showid = $data["showID"];
    $showlink = $data["showLink"];
    $showmessage = $data["showMessage"];

    $sql = "UPDATE bericht SET ShowBericht = ? WHERE UserID = ? AND Link = ?";

    if(!$stmt = mysqli_prepare($conn, $sql))
    {
        die("Could not prepare the given statment");
    }
    else 
    {
        if(!mysqli_stmt_bind_param($stmt, "iis", $showmessage, $showid, $showlink))
        {
            die("Could not bind the parameters to the given statment");
        }
        mysqli_stmt_execute($stmt);
    }      
    mysqli_stmt_close($stmt);
    getMessage();
    return true;
}
?>