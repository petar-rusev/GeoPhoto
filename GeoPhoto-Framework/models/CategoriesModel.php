<?php

class CategoriesModel extends BaseModel {

    public function getAll(){
        $statement = self::$db->query("SELECT * FROM Categories");

        return $statement->fetch_all(MYSQLI_ASSOC);
    }

    public function create($name){
        if($name == ''){
            return false;
        }
        $statement = self::$db->prepare("INSERT INTO Categories(Name) VALUES(?)");
        $statement->bind_param('s',$name);
        $statement->execute();

        return  $statement->affected_rows>0;
    }

    public function delete($id){
        $statement = self::$db->prepare("DELETE FROM Categories WHERE Id = ?");
        $statement->bind_param('i',$id);
        $statement->execute();
        return $statement->affected_rows>0;
    }
}