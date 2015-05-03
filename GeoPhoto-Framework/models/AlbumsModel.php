<?php

class AlbumsModel extends BaseModel {

    public function getAll(){
        $statement = self::$db->query("SELECT * FROM albums");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function createAlbum($name,$description,$userId){
        if($name == ''){
            return false;
        }
        $statement = self::$db->prepare("INSERT INTO albums(Name,Description,Users_Id) VALUES(?,?,?)");
        $statement->bind_param("ssi",$name,$description,$userId);
        $statement->execute();

        return $statement->affected_rows>0;

    }

    public function deleteAlbum($id){
        $statement = self::$db->prepare("DELETE FROM albums WHERE Id = ?");
        $statement->bind_param("i",$id);
        $statement->execute();
        return $statement->affected_rows>0;
    }
}