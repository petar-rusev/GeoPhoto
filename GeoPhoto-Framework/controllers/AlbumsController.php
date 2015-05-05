<?php

class AlbumsController extends BaseController {

    private $model;

    public function onInit(){
        $this->authorize();
        $this->title = "Albums";
        $this->model = new AlbumsModel();
    }

    public function index(){
        $model = new AlbumsModel();
        $this->albums = $model->getAll();
    }
    public function set_album_wall(){

    }
    public function create(){
        if($this->isPost()){
            $name = $_POST['album_name'];
            $description = $_POST['album_description'];
            $userId = $_SESSION['userId'];
            $isPublic = $_POST['album_isPublic'];
            if(!isset($isPublic)){
                $isPublic = 0;
            }
            $this->albums = $this->model->create($name,$description,$userId,$isPublic);
            if(!$this->albums){
                $this->redirect('albums/create');
            }
            else{
                $this->redirect('albums');
            }

        }
    }

    public function edit($id){
        if($this->isPost()){
            $name = $_POST['album_name'];
            $description = $_POST['album_description'];
            $isPublic = $_POST['is_public'];

            if($this->model->edit($id,$name,$description,$isPublic)){
                echo "The album successfully edited.";
                $this->redirect("albums");
            }
            else{
                echo "Can not edit the album.";
            }
        }

        $this->album = $this->model->find($id);
        if(!$this->album){
            echo "Invalid album.";
            $this->redirect("albums");
        }
    }

    public function delete($id){
        if($this->model->delete($id)){
            echo "The album successfully deleted";
        }
        else{
            echo "Can not delete the album.";
        }
    }

}
