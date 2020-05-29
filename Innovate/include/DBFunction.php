<?php
/*
   vv  Space to call Functions  vv  
*/

GetDocent();

/*
**************************************************************************************************************
**************************************************************************************************************
*/
function GetDocent()
{
    require "DBConnect.php";
    $sql = "SELECT voornaam, achternaam, status, foto FROM docent d
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
    }      
    mysqli_stmt_close($stmt);
}

function UpdateStatus()
{
    require "DBConnect.php";
    $sql = "update `docent` SET `status` = ? WHERE `ID` = ?";

    //HIER VERDER

}