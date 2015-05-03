<?php

class AlbumsController extends BaseController {

    private $model;

    public function onInit(){
        $this->title = "Albums";
        $this->model = new AlbumsModel();
    }

    public function index(){
        $model = new AlbumsModel();
        $this->albums = $model->getAll();
    }
    public function create(){
        if($this->isPost){
            $name = $_POST['album_name'];
            $description = $_POST['album_description'];
            $userId = 1;//This is only test value to create an album. When the authorization is implemented it will be get from the database.
            $this->albums = $this->model->createAlbum($name,$description,$userId);
            $this->redirect('albums');
        }
    }

    public function delete($id){
        $this ->renderView("index");
    }
}
