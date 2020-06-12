<?php

getData();

function getData()
{
    if($_POST)
    {
        $data = $_POST;
        $teacher= array_keys($data)[0];
        $status = $data[$teacher];
    }
    else {
	    echo("<br>Komt geen get/post binnen <br>");
    }
}

if($_GET)
{
	$data = $_GET;
	print_r($data);
}