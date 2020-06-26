<?php
/*
    Execute Functions    
*/
GetDocent();
GetData();

function GetData()
{
    require "../Include/DBConnect.php";
    
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
    }
    else
    {
        echo("<br>Komt geen get/post binnen <br>");
	}
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
