<?php
class CommentsController extends BaseController {

    private $model;

    public function onInit(){
        $this->model = new CommentsModel();
    }

    public function add($albumId,$userId){
        $comment = $_POST['Text'];
        $this->model->addAlbumComment($albumId,$userId,$comment);
        $this->redirectToUrl("/albums/view/".$_SESSION['currentAlbum']);

    }
    public function delete($id){
        $this->model->delete($id);
        $this->redirectToUrl("/albums/view/".$_SESSION['currentAlbum']);
    }

}