<?php   
if(isset($_POST))
{
    $data = $_FILES['image'];
    saveImage($data);
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
    $sql = "INSERT INTO bericht (userID, link, ShowBericht) VALUES (?, ?, ?)";



}
?>