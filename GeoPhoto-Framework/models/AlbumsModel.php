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
        $isPublic=1;
        $statement = self::$db->prepare(
            "SELECT * FROM albums WHERE IsPublic = ?");
        $statement->bind_param('i',$isPublic);
        $statement->execute();
        return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
    }



    public function create($name,$description,$userId,$isPublic,$category){
        if($name == ''){
          return false;
       }

        $statement = self::$db->prepare(
            "INSERT INTO albums(Name,Description,Users_Id,isPublic,Categories_Id) VALUES(?,?,?,?,?)");
        $statement->bind_param("ssiii",$name,$description,$userId,$isPublic,$category);
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



        $result = $insert_statement->affected_rows;

        if($result>0 && $id!=null){
            //Sets the new unique image url
            $pictureId = $insert_statement->insert_id;
            $create_unique_url = self::$db->prepare("UPDATE Pictures SET ImageUrl = ? WHERE Id = ?");
            $newUrl = IMAGES_DIR.$imageName.'_'.$insert_statement->insert_id.$imageType;
            $create_unique_url->bind_param('si',$newUrl,$pictureId);
            $create_unique_url->execute();


            $albums_pictures_insert = self::$db->prepare("INSERT INTO Albums_has_Pictures(Albums_Id,Pictures_Id) VALUES(?,?)");
            $albums_pictures_insert->bind_param('ii',$id,$pictureId);
            $albums_pictures_insert->execute();
            $_SESSION['imgLast']=$insert_statement->insert_id;
        }
        return $result;
    }

    public function view($id,$from,$to){
        $only_Public = 1;
        $statement = self::$db->prepare("SELECT * FROM(SELECT * FROM Pictures LEFT JOIN Albums_has_Pictures
            ON (Id=Pictures_Id)WHERE Albums_Id = ?)allPictures LIMIT ?,?");

        $statement->bind_param("iii",$id,$from,$to);
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        return $result;
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

    public function hasImages($id){

        $statement=self::$db->prepare("SELECT COUNT(Pictures_Id) FROM Albums_has_Pictures WHERE Albums_Id = ?");

        $statement->bind_param('i',$id);

        $statement->execute();

        $result = $statement->get_result()->fetch_assoc();

        return $result['COUNT(Pictures_Id)'];
    }

    public function getGpsData($id){

        $statement=self::$db->prepare("SELECT * FROM Pictures LEFT JOIN Albums_has_Pictures
            ON(Id = Pictures_Id) WHERE Albums_Id = ? AND Latitude IS NOT NULL");

        $statement->bind_param('i',$id);
        $statement->execute();

        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    public function rankAlbum($id){

    }

    public function setCategory($name){
        $statement=self::$db->prepare("SELECT Id FROM Categories WHERE Name = ?");
        $statement->bind_param('s',$name);
        $statement->execute();

        $result = $statement->affected_rows;

        if($result>0){
            return $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        }
    }

    public function checkPublic(){
        $statement=self::$db->prepare("SELECT * FROM Albums WHERE IsPublic=?");
        $checkIfExistsPublic = 1;
        $statement->bind_param('i',$checkIfExistsPublic);
        $statement->execute();

        $result = $statement->get_result()->fetch_all();

        if(!$result){
            return false;
        }

        return true;
    }

    public function downVote($id,$vote){


        $statement=self::$db->prepare("INSERT INTO Ranks(DownVote,Albums_Id) VALUES(?,?)");
        $statement->bind_param('ii',$id,$vote);
        $statement->execute();
        if($statement->affected_rows>0){
            $getOverallDownVote = self::$db->prepare("SELECT SUM(DownVote) as downVote FROM Ranks WHERE Albums_Id = ?");
            $getOverallDownVote->bind_param('i',$id);
            $getOverallDownVote->execute();
            $result = $getOverallDownVote->get_result()->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
        return false;
    }

    public function upVote($id,$vote){


        $statement=self::$db->prepare("INSERT INTO Ranks(UpVote,Albums_Id) VALUES(?,?)");
        $statement->bind_param('ii',$id,$vote);
        $statement->execute();
        if($statement->affected_rows>0){
            $getOverallDownVote = self::$db->prepare("SELECT SUM(UpVote) as upVote FROM Ranks WHERE Albums_Id = ?");
            $getOverallDownVote->bind_param('i',$id);
            $getOverallDownVote->execute();
            $result = $getOverallDownVote->get_result()->fetch_all(MYSQLI_ASSOC);
            return $result;
        }
        return false;

    }

    public function getHighlyRanked(){
        $statement_get_likes = self::$db->prepare("SELECT Albums_Id,SUM(UpVote)-SUM(DownVote) as realVote FROM Ranks GROUP By Albums_Id ORDER BY realVote desc");

        $statement_get_likes->execute();

        $votes = $statement_get_likes->get_result()->fetch_all();
        $get_albums = self::$db->prepare("SELECT * FROM Albums WHERE Id = ?");
        if(!$votes){
            return false;
        }
        $topRankedAlbums = [];
        if(count($votes)<5){
            foreach($votes as $vote){
                $get_albums->bind_param('i',$vote[0]);
                $get_albums->execute();
                $album = $get_albums->get_result()->fetch_assoc();
                array_push($topRankedAlbums,$album);
            }
            return $topRankedAlbums;

        }

        $slicedRankedAlbums = array_slice($votes, 0, 5, true);
        return $slicedRankedAlbums;


    }

    public function getVote($id){
        $statement=self::$db->prepare("SELECT SUM(UpVote) as up,SUM(DownVote) as down FROM Ranks WHERE Albums_Id = ?");
        $statement->bind_param('i',$id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

        return $result;
    }

    public function downloadImage($pictureId){
        $getImageUrl = self::$db->prepare("SELECT * FROM Pictures WHERE Id = ?");
        $getImageUrl->bind_param('i',$pictureId);
        $getImageUrl->execute();
        $imageUrl = $getImageUrl->get_result()->fetch_assoc();
        $fileName = $imageUrl['ImageUrl'];
        $file = explode("/",$imageUrl['ImageUrl']);
        $fileType = explode('.',$file[2]);
        $contentType = "image/".$fileType[3];
        if(!$imageUrl){ // file does not exist
            die('file not found');
        } else {
            header("Cache-Control: public");
            header("Content-Description: File Transfer");
            header("Content-Disposition: attachment; filename=$file[2]");
            header("Content-Type: ".$contentType);
            header("Content-Transfer-Encoding: binary");

            // read the file from disk
            readfile($fileName);
        }
    }

    public function getComments($id){
        $statement=self::$db->prepare("SELECT * FROM Comments WHERE Albums_Id = ?");
        $statement->bind_param('i',$id);
        $statement->execute();
        $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);
        if(!$result){
            return false;
        }
        return $result;
    }
}