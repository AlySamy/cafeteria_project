<?php

require './dbclasses.php';
if (!isset($_SESSION['user_id'])) {
    header('Log in page');
    exit();
}
$user_id=$_SESSION['user_id'];

$db = new DB($con);
$data=$db->show('users',$user_id)
echo json_encode($data);