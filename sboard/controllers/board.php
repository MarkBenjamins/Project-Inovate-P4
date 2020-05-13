<?php

class boardController
{
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();
        if(!isset($_GET["uri2"])) {
            require_once './views/board.php';
        }


    }

    public function submissions(){
        $sql = $this->db->prepare("SELECT Submissions.Title, Submissions.Body, Submissions.Date  FROM Submissions WHERE Submissions.Visible=1 ORDER BY Submissions.Date DESC");
        $status = $sql->execute(array());
        if (!$status) {
            echo "Something went wrong. Please try again later";
            die();
        }
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function settings(){
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
        header('Content-Type: application/json');
        echo json_encode($settings);
    }

    public function users(){
        $sql = $this->db->prepare("SELECT Firstname, Lastname, UserID, AMode, Visible, Image FROM Users WHERE Visible=1 ORDER BY Firstname");
        $status = $sql->execute(array());
        if (!$status) {
            echo "Something went wrong. Please try again later";
            die();
        }
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        foreach ($data as $key => $item){
            if(isset($item["Lastname"][0])){
                $data[$key]["NameCode"] = strtoupper($item["Firstname"][0].$item["Lastname"][0]);
            }else{
                $data[$key]["NameCode"] = strtoupper($item["Firstname"][0]);
            }

            $sql = $this->db->prepare("SELECT * FROM Availability WHERE UserID=? AND DayOfWeek=? AND Enabled=1");
            $sql->execute(array($data[$key]["UserID"],date("N", strtotime("now"))));
            $avdata = $sql->fetchAll(PDO::FETCH_ASSOC);

            if(isset($avdata[0])) {
                $avdata = $avdata[0];

                $now = DateTime::createFromFormat('H:i:s', date("H:i:s", strtotime("now")));
                $start = DateTime::createFromFormat('H:i:s', $avdata["StartTime"]);
                $end = DateTime::createFromFormat('H:i:s', $avdata["EndTime"]);

                if ($now > $start && $now < $end) {
                    $data[$key]["Available"] = 1;
                }else{
                    $data[$key]["Available"] = 0;
                }
            }else{
                $data[$key]["Available"] = 0;
            }


        }
        header('Content-Type: application/json');
        echo json_encode($data);
    }

}

?>