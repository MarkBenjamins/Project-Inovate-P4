<?php

class systemController
{
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
        $sql = $this->db->prepare("SELECT * FROM Settings");
        $status = $sql->execute(array());
        if (!$status) {
            echo "Something went wrong. Please try again later";
            die();
        }
        $set = $sql->fetchAll(PDO::FETCH_ASSOC);
        $settings = [];
        foreach ($set as $key => $setting){
            $settings[$setting["Name"]] = $setting["Value"];
        }

        if(!isset($_GET["uri2"])) {
            require_once './views/system.php';
        }
    }

    public function update(){
        if($_SESSION["UserData"]["Admin"] == "1") {

            $sql = $this->db->prepare("UPDATE Settings SET Settings.Value=?  WHERE Settings.Name=?");
            $status = $sql->execute(array($_GET["Enabled"],"DashboardEnabled" ));

            $sql = $this->db->prepare("UPDATE Settings SET Settings.Value=?  WHERE Settings.Name=?");
            $status = $sql->execute(array($_GET["Seconds"],"DashboardSeconds" ));

            header('Content-Type: application/json');

            if (!$status) {
                echo "Something went wrong. Please try again later";
                die();
            }

            echo json_encode(true);
        }
    }

}

?>