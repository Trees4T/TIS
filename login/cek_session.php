<?php
error_reporting(0);
session_start();
include "../koneksi/koneksi.php";

if(empty($_SESSION["username"]) )
	{
	header('Location:login/');
	die();
	}

?>