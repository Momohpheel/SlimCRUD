<?php
require __DIR__. '/../config/Database.php';

class AuthService{

    private $response = true;

    function verifyParam($data){
        $contents = json_decode(file_get_contents('php://input'), true);
        return $contents;
        foreach ($data as $datum){
            if ((!isset($contents[$data]))|| strlen(trim($contents[$data])) <= 0) {
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
}