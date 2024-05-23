<?php 
class DModel{
    
    protected $db= array();

    Public function __construct(){
       
       $connect = 'mysql:dbname=noithat; host=localhost:4306; charset=utf8';
        $user='root';
        $pass = "";
        $this ->db=new Database($connect,$user,$pass);


    }
}
?>