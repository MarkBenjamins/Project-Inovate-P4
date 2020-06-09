<?php

if($_POST)
{
	$data = $_POST;
	print_r($_POST);
}

if($_GET)
{
	$data = $_GET;
	print_r($data);
}