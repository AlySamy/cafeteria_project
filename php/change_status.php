<?php
require("dbclasses.php");
$status=$_POST["status"];
$order_id=$_POST["order_id"];
$db->update_status($status ,$order_id);
$data=$db->select_status($order_id);
echo json_encode($data);
