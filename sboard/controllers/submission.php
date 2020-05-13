<?php

class submissionController
{
    private $db;

    public function __construct() {
        if(isset($_GET["uri2"])) {
                $this->db = (new Database())->connect();
                $sql = $this->db->prepare("SELECT * FROM Submissions, Users WHERE SubmissionID=? AND Submissions.UserID=Users.UserID");
                $status = $sql->execute(array(strip_tags($_GET["uri2"])));
                if (!$status) {
                    echo "Something went wrong. Please try again later";
                    die();
                }
                $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

                if(isset($data["Lastname"][0])){
                    $data["NameCode"] = strtoupper($data["Firstname"][0].$data["Lastname"][0]);
                }else{
                    $data["NameCode"] = strtoupper($data["Firstname"][0]);
                }
                require_once './views/submissionpreview.php';
            }
    }
}

?>