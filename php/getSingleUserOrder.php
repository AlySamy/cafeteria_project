<?php
require './dbclasses.php';

$user_id=json_decode(file_get_contents("php://input"),true)['user_id'];
$data = $db->showUserOrder('total_order', $user_id);
// var_dump($data);
echo json_encode($data);