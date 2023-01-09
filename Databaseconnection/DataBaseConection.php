<?php
   class DB{

    public $con;

  
   
    function __construct() {
        
        include('./env.php');
                try {
                   $this->con=new PDO(DataBase . ":" . 'host='  . DBHost .';dbname=' . DBName ,UserName,userPassword);
                }catch(PDOException $e ){
                    echo 'connection error' . $e->getMessage();
                }
      }

  }




            
       



