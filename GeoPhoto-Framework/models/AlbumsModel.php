<?php

class AlbumsModel extends BaseModel {

    public function find($id){
        $statement = self::$db->prepare(
            "SELECT * FROM albums WHERE Id = ?");
        $statement->bind_param("i",$id);
        $statement->execute();
        return $statement->get_result()->fetch_assoc();
    }

    public function getAll(){
        $statement = self::$db->query(
            "SELECT * FROM albums");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function create($name,$description,$userId){
        if($name == ''){
          return false;
       }
        $statement = self::$db->prepare(
            "INSERT INTO albums(Name,Description,Users_Id) VALUES(?,?,?)");
        $statement->bind_param("ssi",$name,$description,$userId);
        $statement->execute();

        return $statement->affected_rows>0;

    }

    public function edit($id,$name,$description,$isPublic){
        if($name == ''){
            return false;
        }
        $statement = self::$db->prepare(
            "UPDATE albums SET Name = ?,Description = ?,isPublic = ? WHERE Id = ?");
        $statement->bind_param("ssi",$name,$description,$isPublic,$id);
        $statement->execute();
        return $statement->errno == 0;
    }

    public function delete($id){
        $statement = self::$db->prepare("DELETE FROM albums WHERE Id = ?");
        $statement->bind_param("i",$id);
        $statement->execute();
        return $statement->affected_rows>0;
    }
}