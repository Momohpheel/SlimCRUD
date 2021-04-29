<?php
require __DIR__. '/../config/Database.php';

class AuthService{

    public $response = true;

    function verifyParam($data){
        $contents = json_decode(file_get_contents('php://input'), true);
  
        foreach ($data as $datum){
            if ((!isset($contents[$datum])) || strlen(trim($contents[$datum])) <= 0) {
               $this->response = false;
            }
        }

        return $this->response;

        
    }

    function register($fullname, $username, $password){
       $query = "INSERT INTO `user` (`fullname`,`username`,`password`) VALUES ('$fullname','$username','$password')";
        $db = new Database;
        $dba = $db->connect();

        $stmt = $dba->prepare($query);
        if ($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
        
        
    }


    function login($username, $password){
        $query = "SELECT * FROM `user` WHERE `username` = '$username' AND `password` = '$password'";
        $db = new Database;
        $dba = $db->connect();

        $stmt = $dba->prepare($query);
        if ($stmt->execute()){
            return true;
        }
        else{
            return false;
        }
    }
}