<?php
require 'DataBaseConection.php';

class DB
{
    protected $con;
    public function __construct($con)
    {
        $this->con = $con;

    }
   
     // get all users
     public function index($tableName)
     {
         try{
             $query = "SELECT * FROM $tableName";
             $sql = $this->con->prepare($query);
             $sql->execute();
             $data = $sql->fetchAll(PDO::FETCH_ASSOC);
             return $data;
         }catch (PDOException $e) {
             echo "Error: ".$e->getMessage();
         }
         
     }
     public function index1($tableName)
     {
         try{
             $query = "SELECT * FROM $tableName where is_admin = 0";
             $sql = $this->con->prepare($query);
             $sql->execute();
             $data = $sql->fetchAll(PDO::FETCH_ASSOC);
             return $data;
         }catch (PDOException $e) {
             echo "Error: ".$e->getMessage();
         }
         
     }
    // get users room 
    public function usersroom($tableName1,$tableName2,$index)
    {
        try{
            // $query = "SELECT * FROM $tableName1 INNER JOIN $tableName2 on $tableName1.id =$tableName2.user_id LIMIT $index,4";
            $query = "SELECT $tableName2.*, $tableName1.*   FROM $tableName1, $tableName2 where $tableName1.id = $tableName2.user_id LIMIT $index,4";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }
    
      
    // get single user by id
    public function show($tableName, $id)
    {
        try{
            $query = "SELECT * FROM $tableName where id = $id";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetch(PDO::FETCH_ASSOC);
            return $data;
        }catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }

    }
    public function update($tableName, $id, $data)
    {
        $columns = '';
        foreach ($data as $key => $value) {
            $columns = $columns . $key . "=" . "'" . $value . "'" . ",";
        }
        $columns = rtrim($columns, ",");
        $query = "UPDATE $tableName SET $columns WHERE id=$id";
        $sql = $this->con->prepare($query);
        $sql->execute();
    }
    // update user
    public function updateUser($tableName,$tableRoom,$id,$name,$email,$room,$img)
    {
        try{
            $query="UPDATE $tableName SET name='$name', email='$email',profile_pic='$img' WHERE id=$id";
            $queryRoom="UPDATE $tableRoom SET Room_number = $room WHERE user_id=$id";
            $sql=$this->con->prepare($query);
            $sql->execute();
            $sql2=$this->con->prepare($queryRoom);
            $sql2->execute();   
        }catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }

    
    // create user
    public function store($tableName, $data)
    {
        try {
            $query = "INSERT INTO " . $tableName . " (";
            $query .= implode(",", array_keys($data)) . ') VALUES (';
            $query .= "'" . implode("','", array_values($data)) . "')";
            $query=rtrim($query,"'");
            $sql = $this->con->prepare($query);
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // delete user
    public function delete($tableName, $id)
    {
        $query = "DELETE FROM $tableName where id = $id";
        $sql = $this->con->prepare($query);
        $sql->execute();
    }
    // get user id
    public function getUserId($tableName, $email)
    {
        $query = "SELECT id from $tableName where email='$email'";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $data;
    }
    //get user admin or user 
    public function checkUser($tableName, $email)
    {
        $query = "SELECT is_admin from $tableName where email='$email'";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        
        return $data;
    }

   
    // get user password
    public function getUserpw($tableName, $email)
    {
        $query = "SELECT password from $tableName where email='$email'";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    //get users from total_orders
    public function users_name($tableName1,$tableName2){
        $query="SELECT name FROM $tableName1,$tableName2 WHERE $tableName1.id=$tableName2.user_id";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
    public function room_number($tableName1,$tableName2)
    {
        
        $query = "SELECT Room_number FROM $tableName1,$tableName2 WHERE $tableName1.user_id=$tableName2.user_id";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }


    // get products for home page
    public function getProducts($tableName)
    {
        try{
            $query = "SELECT product.name,price,product_pic,product.id FROM `product` , `category` WHERE product.category_id=category.id ORDER BY category_id;";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
            $sql2=$this->con->prepare($queryRoom);
            $sql2->execute();   
        }catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }
    // validate form
    public function validateUser($id,$email,$room)
    {
        try{
            // SELECT * FROM $tableName1 INNER JOIN $tableName2 on $tableName1.id =$tableName2.user_id
            $query = "SELECT email,Room_number FROM users INNER JOIN user_room on  email='$email' and Room_number =$room ";
            // $query="SELECT email, Room_number from users , user_room where users.id = user_room.user_id and   email = '$email' and Room_number = $room";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            // var_dump($data);
            // if($data){
            //     return false;

            // }else{
            //    return true;
            // }
            
            return $data;   
        }catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }


    //search in home page
    public function paginationSearch($tableName,$word)
    {
        try{
            $query = "SELECT name,price,product_pic FROM `product` where name like '%$word%';";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }

    //get latest order
     public function getLatestOrder($id)
     {
        try{
            $query = "SELECT * FROM product where id=any(
                SELECT product_id FROM order_product where order_id=(
                SELECT id FROM total_order where user_id=$id ORDER BY created_at DESC LIMIT 1));;";
            $sql = $this->con->prepare($query);
            $sql->execute();
            $data = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
     }

    
    
    
     public function submitOrder($orderArr, $user_id, $room_number, $notes, $orderArrlength)
    {

        try {
            $q = json_encode($orderArr);
            
            $query = "call test('$q',$user_id,$room_number,'$notes',$orderArrlength)";
            $sql = $this->con->query($query);
            $result = $sql->fetch(PDO::FETCH_ASSOC);
            

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



    
}

// $db = new DB($con);
//$id=// $x=$db->validateUser(6,"alaa1234@gmail.com",200);
// var_dump($x);
// $db->validateUser(6,"alaa@gmail.com",200);
// $db->usersroom("users","user_room",8);
// $db->index('users');
// $db->show('users',1);
// $db->store('users' , ['name'=>'ahmed','email'=>'ahmed@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'ali','email'=>'ali@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'alaa','email'=>'alaa@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'toka','email'=>'toka@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->update('users',1,['name'=>'kareem','email' => 'karem234@gmail.com']);
// $db->delete('users',3);

// $db->store('product' , ['name'=>'tea','category_id'=>'1', 'price'=>'5', 'product_pic'=>'./images/0.12204800 1672674506.jpeg','status'=>'Available']);
//$id = $db->getUserId('users', 'ali@gmail.com');
//print_r($id);
//$is_admin=$db->checkUser("users","ahmed@gmail.com");
//print_r($is_admin);
// $user_name='ffff';
// $user_email='fff@gmail.com';
// $user_password ='123456';
 
// $res=$db->store('users',['name' => "$user_name", 'email' => "$user_email", 'password' => "$user_password"]);
// $data=$db->users_name('users','total_order');
// print_r($data);
// $data=$db->room_number('total_order','user_room');
// print_r($data);


