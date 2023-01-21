<?php
require './dbclasses.php';
$db = new DB($con);
$data = $db->index('users');
echo json_encode($data);


