<?php
require './DataBaseConection.php';

class DB
{
    protected $con;
    public function __construct($con){
        $this->con = $con;
        var_dump($this->con);
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
        var_dump($data);
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
}

$db = new DB($con);
// $db->index('users');
// $db->show('users',1);
// $db->store('users' , ['name'=>'ahmed','email'=>'ahmed@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'ali','email'=>'ali@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'alaa','email'=>'alaa@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->store('users' , ['name'=>'toka','email'=>'toka@gmail.com', 'password'=>'12345678', 'profile_pic'=>'./images/0.12204800 1672674506.jpeg']);
// $db->update('users',1,['name'=>'kareem','email' => 'karem234@gmail.com']);
// $db->delete('users',3);

// $db->store('product' , ['name'=>'tea','category_id'=>'1', 'price'=>'5', 'product_pic'=>'./images/0.12204800 1672674506.jpeg','status'=>'Available']);
