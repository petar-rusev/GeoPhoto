<?php

class AccountsModel extends BaseModel {

    public function register($username,$password,$email,$phone){
        $statement = self::$db->prepare("SELECT COUNT(Id) FROM Users WHERE Username = ?");
        $statement->bind_param("s",$username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if($result['COUNT(Id)']){
            return false;
        }

        $hash_pass = password_hash($password,PASSWORD_BCRYPT);


        $registerStatement = self::$db->prepare(
            "INSERT INTO Users(Username,Password,Email,Phone) VALUES(?,?,?,?)");

        $registerStatement->bind_param("ssss",$username,$hash_pass,$email,$phone);
        $registerStatement->execute();
        return true;

    }

    public function login($username,$password){
        $statement = self::$db->prepare("SELECT Id,Password FROM Users WHERE Username = ?");
        $statement->bind_param("s",$username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        if(password_verify($password,$result['Password'])){
            return true;
        }

        return false;
    }

    public function getUser($username){
        $statement = self::$db->prepare("SELECT Id FROM Users WHERE Username = ?");
        $statement->bind_param("s",$username);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        return $result;
    }
}