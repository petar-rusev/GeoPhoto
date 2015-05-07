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

    public function create($name,$description,$userId,$isPublic){
        if($name == ''){
          return false;
       }

        $statement = self::$db->prepare(
            "INSERT INTO albums(Name,Description,Users_Id,isPublic) VALUES(?,?,?,?)");
        $statement->bind_param("ssii",$name,$description,$userId,$isPublic);
        $statement->execute();

        return $statement->affected_rows>0;;

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

    public function upload($id,$imageName,$cameraModel,$dateShooted, $dateUploaded,$latitude,$longitude, $imageUrl,$imageType,$imageName){

        $insert_statement = self::$db->prepare(
            "INSERT INTO Pictures(Name,CameraModel,DateShooted,DateUploaded,Latitude,Longitude,ImageUrl)
              VALUES(?,?,?,?,?,?,?)");

        $insert_statement->bind_param('sssssss',$imageName,$cameraModel,$dateShooted, $dateUploaded,$latitude,$longitude, $imageUrl);

        $insert_statement->execute();


        $create_unique_url = self::$db->prepare("UPDATE Pictures SET ImageUrl = ?");
        $result = $insert_statement->affected_rows;

        if($result>0 && $id!=null){
            //Sets the new unique image url
            $newUrl = IMAGES_DIR.$imageName.'_'.$insert_statement->insert_id.$imageType;
            $create_unique_url->bind_param('s',$newUrl);
            $create_unique_url->execute();

            $pictureId = $insert_statement->insert_id;
            $albums_pictures_insert = self::$db->prepare("INSERT INTO Albums_has_Pictures(Albums_Id,Pictures_Id) VALUES(?,?)");
            $albums_pictures_insert->bind_param('ii',$albumId,$pictureId);
            $albums_pictures_insert->execute();
            $_SESSION['imgLast']=$insert_statement->insert_id;
        }
        return $result;
    }

    public function view($id){

        $statement = self::$db->prepare("SELECT * FROM Pictures LEFT OUTER JOIN Albums_has_Pictures
            ON (Id=Albums_Id)WHERE Albums_Id = ?");

        $statement->bind_param("i",$id);
        $statement->execute();

        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }

}