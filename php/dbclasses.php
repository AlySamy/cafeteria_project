<?php
require './DataBaseConection.php';

class DB
{
    protected $con;
    public function __construct($con){
        $this->con = $con;
    }
    // get all users
    public function index($tableName)
    {
        $query = "SELECT * FROM $tableName";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        // var_dump($data);
        return $data;
    }
    // get single user by id
    public function show($tableName,$id)
    {
        $query = "SELECT * FROM $tableName where id = $id";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }
   

   

    // edit user
    public function update($tableName,$id,$data)
    {
        $columns='';
        foreach($data as $key=> $value)
        {
            $columns=$columns.$key."="."'".$value."'".",";
        }
        $columns=rtrim($columns,",");
        $query="UPDATE $tableName SET $columns WHERE id=$id";
        $sql=$this->con->prepare($query);
        $sql->execute();
    }
    // create user
    public function store($tableName,$data)
    {
        try{
            $query = "INSERT INTO ".$tableName." (";            
            $query .= implode(",", array_keys($data)) . ') VALUES (';            
            $query .= "'" . implode("','", array_values($data)) . "')";  
            var_dump($query);
            $sql = $this->con->prepare($query);
            $sql->execute();
        }catch (PDOException $e) {
            echo "Error: ".$e->getMessage();
        }
    }
    // delete user
    public function delete($tableName,$id)
    {
        $query = "DELETE FROM $tableName where id = $id";
        $sql = $this->con->prepare($query);
        $sql->execute();
    }

    //get all products
    public function lisProducts($tableName){
        $query = "SELECT * FROM $tableName ";
        $sql=$this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        
    }

    public function allProducts($index){
        $query = "SELECT * FROM product limit $index,3";
        $sql=$this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetchAll(PDO::FETCH_ASSOC);
        return $data;
        
    }

    public function getOneProduct($tableName,$productName)
    {
        $query = "SELECT * FROM $tableName where name = '$productName'";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function validatproductName($productName){

        $result=$this->getOneProduct('product',$productName);
        if (gettype($result)=='array'){
            return false;
        }
        
        return true;
    }

    public function deleteProduct($id){
         
         $query="UPDATE product set status ='Not available' where id ='$id'" ;
            $sql = $this->con->prepare($query);
            $result=$sql->execute();
            return $result;
    }
        //to do
    public function udateproductData($id,$name,$price,$pic,$status,$categoryId){

        $query="UPDATE product SET name='$name',price=$price,product_pic='$pic',status='$status',category_id=$categoryId
         WHERE id=$id";
        $sql=$this->con->prepare($query);
        $sql->execute();
        
    }

    public function addProduct($name,$price,$pic,$cat_id){
        $query="INSERT INTO product (name ,price,product_pic,category_id) VALUES('$name',$price,'$pic',$cat_id)"; 
        $sql=$this->con->prepare($query);
        $sql->execute();
        
    }    

    public function getproductId($productName){
        $query = "SELECT id FROM product where name = '$productName'";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;       
    }

// catagory validate

    public function getOneCatagory($catagoryName)
    {
        $query = "SELECT * FROM category where name = '$catagoryName'";
        $sql = $this->con->prepare($query);
        $sql->execute();
        $data = $sql->fetch(PDO::FETCH_ASSOC);
        return $data;
    }

    public function validatecatagoryName($catagoryName){

        $result=$this->getOneCatagory($catagoryName);
        if (gettype($result)=='array'){
            return false;
        }
        
        return true;
    }


    public function addCategory($catagoryName){
        $query="INSERT INTO category(name)VALUES('$catagoryName')";
        $sql=$this->con->prepare($query);
        $sql->execute(); 
        return true;       

    
    }
   
}





//
// $db = new DB($con);
// $oldName=$db->getOneProduct('product','t');
// var_dump($oldName);
// $db->addProduct('tea',33,'',3);
// $db->udateproductDAta('t',2,'',2);
//$db->lisProducts('product');
// $db->index('users');
// $db->show('users',1);
// $db->store('users' , ['name'=>'ahmed','email'=>'ahmed@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'ali','email'=>'ali@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'alaa','email'=>'alaa@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'toka','email'=>'toka@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->update('users',1,['name'=>'kareem','email' => 'karem234@gmail.com']);
// $db->delete('users',3);
// $db->store('product' , ['name'=>'tea','category_id'=>'1', 'price'=>'5', 'product_pic'=>'./images/0.12204800 1672674506.jpeg','status'=>'Available']);
