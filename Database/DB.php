<?php 
class DB{

     public static function connect(){
        try {
            $conn= new PDO("mysql: host=localhost; dbname=brief-6", 'root', '');
            $conn->exec("set names utf8");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

            $_SESSION['is_db_connected']=true;
            return $conn;
        } catch (PDOException $e) {
            $_SESSION['is_db_connected']=false;
            return $e->getMessage();
        }
        
    }
}
?>

