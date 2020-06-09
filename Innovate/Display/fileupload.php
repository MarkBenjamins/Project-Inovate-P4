<?php
// stuur naar db
// var_dump($_FILES["Image"]["name"]);
// var_dump($_FILES["Image"]["tmp_name"]);
// var_dump($_FILES);
// echo "<pre>";
// var_dump($_POST);
// echo "</pre>";
// $_POST["FileUpload"]

// if ( 0 < $_FILES['Image']['error'] ) {
//     echo 'Error: ' . $_FILES['Image']['error'] . '<br>';
// }
// else {
//     move_uploaded_file($_FILES['Image']['tmp_name'], 'uploads/' . $_FILES['Image']['name']);
// }


//Get the base64 data from the array. Get index 1 that contains the needed base64 encoded data. Index 0 contains the type.
$data = (explode(',', $_POST['value']))[1];

$mysqli = new mysqli("localhost", "root", "", "innovate");

/* check connection */
if (mysqli_connect_errno()) 
{
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}


// It is in OOP but made sure i made it as readable as possible for you guys.
/* create a prepared statement */
if ($stmt = $mysqli->prepare("INSERT INTO `bericht`(`UserID`, `Link`, `ShowBericht`, `Foto`) VALUES (?, ?, ?, ?)")) 
{
    /* bind parameters for markers */
    $stmt->bind_param("isis", $userId, $link, $showBericht, $foto);
    $userId = 1;
    $link = "I am a link";
    $showBericht = 1;
    $foto = $data;

    /* execute query */
    $stmt->execute();

    /* close statement */
    $stmt->close();
}

/* close connection */
$mysqli->close();

?>