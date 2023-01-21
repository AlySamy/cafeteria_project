<?php 
require './dbclasses.php';

$user_id=json_decode(file_get_contents("php://input"),true)['user_id'];
$data = $db->getSingleUserTotalPrice('users','total_order',$user_id);
echo json_encode($data);