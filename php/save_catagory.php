<?php
require './dbclasses.php';
$db = new DB($con);
$result=$db->validatecatagoryName($catagoryName);
if($result==false){
    setcookie('errors', json_encode(['catagory' => 'catagory is arredy exist']));
    header("location:../add_product.html");
    exit();
} else {
    setcookie('errors', "", time() - 60);
    
    $results= $db->addCategory($catagoryName);

 if(!$results){
      echo json_encode(['status' => 'catagory alerday exists']);
      header("location:../add_product.html");
      exit();
    } 
    echo json_encode(['status' => 'added successfully']);
    exit();

}
