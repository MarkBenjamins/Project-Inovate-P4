<?php 
// stuur naar db
var_dump($_FILES["Image"]["name"]);
var_dump($_FILES["Image"]["tmp_name"]);
var_dump($_FILES);
var_dump($_POST);
// $_POST["FileUpload"]

    // if ( 0 < $_FILES['Image']['error'] ) {
    //     echo 'Error: ' . $_FILES['Image']['error'] . '<br>';
    // }
    // else {
    //     move_uploaded_file($_FILES['Image']['tmp_name'], 'uploads/' . $_FILES['Image']['name']);
    // }


?>