<?php
//   require './dbclasses.php';
//   $data = file_get_contents('php://input');
//   $data = json_decode($data, true);


//   if(isset($data["productToDelete"])){
   
//     $productName ="$data[productToDelete]";
//     $db = new DB($con);
//     $result=$db->udateproductDAta($name,$price,$pic,$categoryId);

   
//     // header('Location: list_product.php');
   
//     if(!$result){
//       echo json_encode(['status' => 'product is invalid']);
//       exit();
//     } 
//     echo json_encode(['status' => 'deleted successfully']);
//     exit();
    

// }
// to do
$data = file_get_contents('php://input');
$data = json_decode($data, true);
echo $data;

