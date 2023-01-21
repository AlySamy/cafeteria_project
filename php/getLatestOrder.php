<?php
//session_start();
require "dbclasses.php";

// $id=$_SESSION['user_id'];
$id=75;
$obj=new DB($con);
$ob=$obj->getLatestOrder($id);
echo json_encode($ob);