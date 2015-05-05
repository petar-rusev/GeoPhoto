<?php

class PicturesModel extends BaseModel {
    private $isUploaded = false;

    public function getPicture($pictureName){
        $statement = self::$db->prepare("SELECT Id FROM Pictures WHERE ImageUrl = ?");
        $statement->bind_param("s",$pictureName);
        $statement->execute();
        $result = $statement->get_result()->fetch_assoc();

        return $result;
    }

    public function upload($albumId,$imageName,$cameraModel,$dateShooted,$dateUploaded,$latitude,$longitude,$imageUrl){

        $insert_statement = self::$db->prepare(
            "INSERT INTO Pictures(Name,CameraModel,DateShooted,DateUploaded,Latitude,Longitude,ImageUrl) VALUES(?,?,?,?,?,?,?)");

        $insert_statement->bind_param('sssssss',$imageName,$cameraModel,$dateShooted,$dateUploaded,$latitude,$longitude,$imageUrl);

        $insert_statement->execute();

        if($insert_statement->affected_rows>0 && $albumId!=null){
            $pictureId = $this->getPicture($imageUrl);

            $albums_pictures_insert = self::$db->prepare("INSERT INTO Albums_has_Pictures(Albums_Id,Pictures_Id) VALUES(?,?)");
            $albums_pictures_insert->bind_param('ii',$albumId,$pictureId);
            $albums_pictures_insert->execute();
        }
        return $insert_statement->affected_rows>0;
    }

}