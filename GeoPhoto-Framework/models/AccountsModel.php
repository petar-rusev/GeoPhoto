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

    public function getAlbums($id){
        $statement = self::$db->prepare(
            "SELECT * FROM albums WHERE Users_Id=?");
        $statement->bind_param('i',$id);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

    public function hasImages($id){

        $statement=self::$db->prepare("SELECT COUNT(Pictures_Id) FROM Albums_has_Pictures WHERE Albums_Id = ?");

        $statement->bind_param('i',$id);

        $statement->execute();

        $result = $statement->get_result()->fetch_assoc();

        return $result['COUNT(Pictures_Id)'];
    }

    public function set_wall($id){
        $statement = self::$db->prepare("SELECT COUNT(Pictures_Id) FROM Albums_has_Pictures WHERE Albums_Id = ?");

        $statement->bind_param('i',$id);

        $statement->execute();

        $result = $statement->get_result()->fetch_assoc();

        if($result['COUNT(Pictures_Id)']){
            $get_wall_image = self::$db->prepare("SELECT ImageUrl FROM Pictures LEFT OUTER JOIN Albums_has_Pictures
            ON (?=Albums_Id)");

            $get_wall_image->bind_param('i',$id);

            $get_wall_image->execute();

            $wall_image = $get_wall_image->get_result()->fetch_assoc();

            return $wall_image['ImageUrl'];
        }
    }
}