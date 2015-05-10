<?php
class CommentsModel extends BaseModel {

    public function getAlbumComments($albumId){
        if($albumId){
            $statement = self::$db->prepare("SELECT * FROM Comments Where AlbumsId = ?");
            $statement->bind_param('i',$albumId);
            $statement->execute();
            $result = $statement->get_result()->fetch_all(MYSQLI_ASSOC);

            if(!$result){
                return false;
            }
            return $result;
        }
    }
    public function delete($commentId){
        $statement=self::$db->prepare("DELETE FROM Comments WHERE Id=?");
        $statement->bind_param('i',$commentId);
        $statement->execute();
        return $statement->affected_rows>0;
    }

    public function addAlbumComment($albumId,$userId,$text){
        if($albumId){
            $statement = self::$db->prepare("INSERT INTO Comments(Text,Users_Id,Albums_Id) VALUES(?,?,?)");
            $statement->bind_param('sii',$text,$userId,$albumId);
            $statement->execute();

            return $statement->affected_rows>0;
        }

    }

}