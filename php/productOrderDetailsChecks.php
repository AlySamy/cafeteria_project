<?php 
require './dbclasses.php';

$product_id=json_decode(file_get_contents("php://input"),true)['product_id'];
$data = $db->showOrderProduct('product', $product_id);
echo json_encode($data);