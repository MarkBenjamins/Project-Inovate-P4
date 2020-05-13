<?php

class availabilityController
{
    private $db;

    public function __construct() {

        $this->db = (new Database())->connect();
        if(!isset($_GET["uri2"])) {

            $sql = $this->db->prepare("SELECT * FROM Users,Availability WHERE Users.UserID=? AND Users.UserID=Availability.UserID ORDER BY DayOfWeek");
            $status = $sql->execute(array($_SESSION["UserData"]["UserID"]));
            if (!$status) {
                echo "Something went wrong. Please try again later";
                die();
            }
            $days = ["Geen", "Maandag","Dinsdag","Woensdag","Donderdag","Vrijdag"];
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);

            require_once './views/availability.php';
        }
    }

    public function update(){
        if(isset($_GET["AVMode"])){
            $newmode = stripslashes($_GET["AVMode"]);
            $sql = $this->db->prepare("UPDATE Users SET AMode=? WHERE UserID=?");
            $sql->execute(array($newmode,$_SESSION["UserData"]["UserID"]));
        }

        if(isset($_GET["DayOfWeek"])){
            $dayofweek = stripslashes($_GET["DayOfWeek"]);

            if(isset($_GET["StartTime"]) && isset($_GET["EndTime"])) {
                $sql = $this->db->prepare("UPDATE Availability SET StartTime=?, EndTime=? WHERE UserID=? AND DayOfWeek=?");
                $sql->execute(array($_GET["StartTime"], $_GET["EndTime"], $_SESSION["UserData"]["UserID"], $dayofweek));
            }

            if(isset($_GET["Enabled"])){
                $sql = $this->db->prepare("UPDATE Availability SET Enabled=? WHERE UserID=? AND DayOfWeek=?");
                $sql->execute(array($_GET["Enabled"], $_SESSION["UserData"]["UserID"], $dayofweek));
            }
        }
    }
}

?>