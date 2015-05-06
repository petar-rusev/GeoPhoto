<?php

class HomeModel extends BaseModel {

    public function getPublicAllbums(){
        $statement = self::$db->query("SELECT * FROM Albums WHERE IsPublic=1");
        return $statement->fetch_all(MYSQLI_ASSOC);
    }
}