<?php

class AlbumsModel extends BaseModel {

    public function getAll(){
        $statement = self::$db->query("SELECT * FROM albums");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}