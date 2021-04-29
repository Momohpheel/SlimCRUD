<?php
require_once __DIR__. '/../config/Database.php';

class CrudService{

    function save($product_name, $user_id, $price){
        $query = "INSERT INTO `product` (`product_name`,`user_id`,`price`) VALUES ('$product_name','$user_id','$price')";
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
    

    function update($product_name, $user_id, $price){
        $query = "UPDATE `product` SET `product_name` = '$product_name' , `price` = '$price' WHERE `id` = '$id'";
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


    function delete($id){
        $query = "DELETE FROM `product` WHERE `id` = '$id'";
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



    function read($product_name, $user_id, $price){
        $query = "INSERT INTO `product` (`product_name`,`user_id`,`price`) VALUES ('$product_name','$user_id','$price')";
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