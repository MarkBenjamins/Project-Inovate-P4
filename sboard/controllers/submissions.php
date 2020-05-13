<?php

class submissionsController
{
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();

        if(!isset($_GET["uri2"])) 
        {
            $sql = $this->db->prepare("SELECT SubmissionID, s.Date, s.Visible, Title, u.UserID, u.Firstname, u.Lastname, u.Image, s.Sequence
                FROM Submissions s 
                    LEFT OUTER JOIN Users u ON s.UserID = u.UserID 
                ORDER BY s.Sequence DESC, s.Date DESC");

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
            }

            $sql = $this->db->prepare("SELECT SubmissionID, s.Date, s.Visible, Title, u.UserID, u.Firstname, u.Lastname, u.Image, s.Sequence 
                FROM Submissions s 
                    LEFT OUTER JOIN Users u ON s.UserID = u.UserID 
                WHERE u.UserID=? 
                ORDER BY s.Sequence DESC, s.Date DESC");                                   

            $status = $sql->execute(array($_SESSION["UserData"]["UserID"]));
            if (!$status) {
                echo "Something went wrong. Please try again later";
                die();
            }
            $dataUser = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($dataUser as $key => $item){
                if(isset($item["Lastname"][0])){
                    $dataUser[$key]["NameCode"] = strtoupper($item["Firstname"][0].$item["Lastname"][0]);
                }else{
                    $dataUser[$key]["NameCode"] = strtoupper($item["Firstname"][0]);
                }
            }

            require_once './views/submissions.php';
        }

    }

    public function add()
    {
        $id = substr(str_shuffle(md5(time())),0,32);
        $sql = $this->db->prepare("INSERT INTO Submissions (SubmissionID,UserID,Title,Body) VALUES (?,?,?,?)");
        $status = $sql->execute(array($id,$_SESSION["UserData"]["UserID"],"Nieuw Item",""));
        if (!$status) 
        {
            echo "Something went wrong. Please try again later";
            var_dump($sql->errorInfo());
            die();
        }

        // Look for the highest sequence number and add 1.
        $sql = $this->db->prepare("SELECT MAX(Sequence) + 1 AS maximum FROM Submissions");
        $status = $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];
        $maximum = $data["maximum"];

        // now save the sequencenumber
        $sql = $this->db->prepare("UPDATE Submissions SET Sequence = :maximum WHERE SubmissionID = :id");
        $sql->bindParam(":maximum", $maximum);
        $sql->bindParam(":id", $id);
        $sql->execute();
        

        header('Content-Type: application/json');
        echo json_encode($id);
    }

    public function delete(){
        $id = stripslashes($_GET["id"]);

        $this->db = (new Database())->connect();
        $sql = $this->db->prepare("SELECT * FROM Submissions WHERE SubmissionID=?");
        $status = $sql->execute(array($id));
        if (!$status) {
            echo "Something went wrong. Please try again later";
            die();
        }
        $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

        if($data["UserID"] == $_SESSION["UserData"]["UserID"] || $_SESSION["UserData"]["Admin"] == "1"){
            $sql = $this->db->prepare("DELETE FROM Submissions WHERE SubmissionID = ?");
            $sql->execute(array($id));
            header("Location: /submissions");
        }

    }

    public function visible(){
        $id = stripslashes($_GET["id"]);

        if($_SESSION["UserData"]["Admin"] == "1" || $_SESSION["UserData"]["Publish"] == "1"){
            $sql = $this->db->prepare("UPDATE Submissions SET Visible=? WHERE SubmissionID=?");
            $sql->execute(array($_GET["visible"],$id));
            header('Content-Type: application/json');
            echo json_encode(true);
        }

    }

    public function upload(){
        header('Content-Type: application/json');
        $this->db = (new Database())->connect();
        $sql = $this->db->prepare("SELECT * FROM Submissions WHERE SubmissionID=?");
        $status = $sql->execute(array($_GET["SubmissionID"]));
        if (!$status) {
            var_dump($sql->errorInfo());
            echo "Something went wrong. Please try again later";
            die();
        }
        $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

        if(isset($_FILES["photo"]) && $data["UserID"] == $_SESSION["UserData"]["UserID"] || $_SESSION["UserData"]["Admin"] == "1"){
            $file_type = $_FILES['photo']['type'];
            $allowed = array("image/jpeg", "image/gif", "image/png", "image/jpg");
            if(in_array($file_type, $allowed)) {
                move_uploaded_file($_FILES["photo"]["tmp_name"], $_SERVER['DOCUMENT_ROOT']."/images/".$_GET["SubmissionID"]."-".basename($_FILES["photo"]["name"]));
                $sql = $this->db->prepare("INSERT INTO Attachments (SubmissionID,Filename) VALUES (?,?)");
                $status = $sql->execute(array($_GET["SubmissionID"],$_FILES["photo"]["name"]));
                if (!$status) {
                    var_dump($sql->errorInfo());
                    echo "Something went wrong. Please try again later";
                    die();
                }

                $sql = $this->db->prepare("SELECT * FROM Attachments WHERE SubmissionID=? AND Filename=?");
                $status = $sql->execute(array($_GET["SubmissionID"],$_FILES["photo"]["name"]));
                if (!$status) {
                    var_dump($sql->errorInfo());

                    die();
                }
                $data = $sql->fetchAll(PDO::FETCH_ASSOC);
                header('Content-Type: application/json');
                echo json_encode($data);

            }
        }
    }

    public function deleteAttachment(){
        if(isset($_GET["filename"]) && isset($_GET["id"])) {
            $id = stripslashes($_GET["id"]);

            $this->db = (new Database())->connect();
            $sql = $this->db->prepare("SELECT * FROM Submissions WHERE SubmissionID=?");
            $status = $sql->execute(array($id));
            if (!$status) {
                echo "Something went wrong. Please try again later";
                die();
            }
            $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

            if($data["UserID"] == $_SESSION["UserData"]["UserID"] || $_SESSION["UserData"]["Admin"] == "1") {
                $filename = stripslashes($_GET["filename"]);
                $sql = $this->db->prepare("DELETE FROM Attachments WHERE SubmissionID = ? AND Filename=?");
                $sql->execute(array($id, $filename));
                unlink($_SERVER['DOCUMENT_ROOT'] . "/images/" . $id . "-" . $filename);
                header('Content-Type: application/json');
                echo json_encode(true);
            }
        }
    }

    // Add 1 to sequence
    public function countUp()
    {
        $id = stripslashes($_GET["id"]);

        $this->db = (new Database())->connect();
        $sql = $this->db->prepare("SELECT (sequence + 1) as sequence FROM Submissions WHERE SubmissionID=?");
        $status = $sql->execute(array($id));
        if (!$status) 
        {
            echo "Something went wrong. Please try again later";
            die();
        }
        $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

        $sequence = $data["sequence"];  // allready added 1, so update imediately
        $sql = $this->db->prepare("UPDATE Submissions SET sequence = :sequence WHERE SubmissionID= :id");
        $sql->bindParam(":sequence", $sequence);
        $sql->bindParam(":id", $id);
        $sql->execute();

        header("Location: /submissions");
    }

    // Substract 1 from sequence
    public function countDown()
    {
        $id = stripslashes($_GET["id"]);

        $this->db = (new Database())->connect();
        $sql = $this->db->prepare("SELECT (sequence - 1) as sequence FROM Submissions WHERE SubmissionID=?");
        $status = $sql->execute(array($id));
        if (!$status) 
        {
            echo "Something went wrong. Please try again later";
            die();
        }
        $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

        $sequence = $data["sequence"];  // allready substracted 1, so update imediately
        $sql = $this->db->prepare("UPDATE Submissions SET sequence = :sequence WHERE SubmissionID= :id");
        $sql->bindParam(":sequence", $sequence);
        $sql->bindParam(":id", $id);
        $sql->execute();

        header("Location: /submissions");
    }
}

?>