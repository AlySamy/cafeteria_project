<?php
require("./dbclasses.php");
$db=new DB($con);
$id=$_REQUEST["id"];
$email=$_REQUEST["email"];
$name=$_REQUEST["name"];
$room=$_REQUEST["room"];
$img=$_REQUEST["imageName"];

$data=$db->validateUser($id,$email,$room);
if($data){
echo "
  <script>
  alert('Email or Room number is Not Valid');
  window.location.href='../all_users.html';
  </script>";
 

    // setcookie('errors', json_encode(['Email' => 'Not valid']),0,'/');
}else{
    
     $data = $db->updateUser('users','user_room',$id,$name,$email,$room,$img);
    header("Location: ../all_users.html");
    // setcookie('errors','', -1, '/');

}
// echo json_encode($data);

