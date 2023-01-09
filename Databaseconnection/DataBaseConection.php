<?php

    include('./env.php');
            try {
                $conn=new PDO(DataBase,'host' . DBHost .';dbname=' . DBName ,UserName,userPassword);
            }catch(PDOException $e ){
                echo 'connection error' . $e->getMessage();
            }
            
       



