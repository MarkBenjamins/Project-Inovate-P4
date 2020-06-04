<?php
/*
   vv  Space to call Functions  vv  
*/
GetDocent();
getdata();
getJson();

/*
**************************************************************************************************************
**************************************************************************************************************
*/
function getJson()
{
    //header("Content-Type: application/json");
    $json = file_get_contents('teacher.json');
    $data =  json_decode($json);
}

function getdata()
{
require "DBConnect.php";
    if($_POST){
    echo("<br><br>");
    var_dump($_POST);
        $data = $_POST;
        $teacher= array_keys($data)[0];
        $status = $data[$teacher];
        
        echo("<br><br>");
        print ($teacher ." heeft als status: ". $status);

    $sql = "UPDATE `docent` SET Status=? WHERE id = ?";
    if(!$stmt = mysqli_prepare($conn, $sql))
    {
       die("Could not prepare the given statment");
    }
    else {
	mysqli_stmt_bind_param($stmt, 'is', $status , $teacher);
    mysqli_stmt_execute($stmt);
}


    //$obj = json_decode($_POST, true);
    //print_r($obj);
    }
    else{
    print("<br>Komt geen get/post binnen <br>");
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
        echo $myJSON;
        file_put_contents('teacher.json',$myJSON);
    }      
    mysqli_stmt_close($stmt);
}

function UpdateStatus()
{
    require "DBConnect.php";
    $sql = "update `docent` SET `status` = ? WHERE `ID` = ?";

    //HIER VERDER

}