<?php
require './dbclasses.php';

$totalPrice = $db->getUserTotalPrice('users','total_order');
echo json_encode($totalPrice);