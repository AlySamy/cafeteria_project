<?php
require "dbclasses.php";

$id=4;
$obj=new DB($con);
$ob=$obj->getLatestOrder($id);
echo json_encode($ob);