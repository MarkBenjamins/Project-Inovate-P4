<?php

class editController
{
    private $db;

    public function __construct() {
        if(isset($_GET["uri2"])) {

            if($_GET["uri2"] == "update"){
                $tags = "<br><b><i><u><table><tr><th><td><img><hr><blockquote><code><mark><pre><center>";
                $this->db = (new Database())->connect();
                $sql = $this->db->prepare("UPDATE Submissions SET Title=?, Body=? WHERE SubmissionID=?");
                $status = $sql->execute(array(strip_tags($_GET["Title"]),strip_tags($_GET["Body"],$tags),$_GET["SubmissionID"]));
                if (!$status) {
                    echo "Something went wrong. Please try again later";
                    die();
                }
                header('Content-Type: application/json');
                echo json_encode(true);
            }else {

                $this->db = (new Database())->connect();
                $sql = $this->db->prepare("SELECT * FROM Submissions WHERE SubmissionID=?");
                $status = $sql->execute(array(strip_tags($_GET["uri2"])));
                if (!$status) {
                    echo "Something went wrong. Please try again later";
                    die();
                }
                $data = $sql->fetchAll(PDO::FETCH_ASSOC)[0];

                $sql = $this->db->prepare("SELECT * FROM Attachments WHERE SubmissionID=?");
                $status = $sql->execute(array(strip_tags($_GET["uri2"])));
                if (!$status) {
                    echo "Something went wrong. Please try again later";
                    die();
                }
                $attach = $sql->fetchAll(PDO::FETCH_ASSOC);

                if($data["UserID"] != $_SESSION["UserData"]["UserID"] && $_SESSION["UserData"]["Admin"] != "1"){
                    return;
                }

                require_once './views/submissionedit.php';
            }
        }
    }
}

?>