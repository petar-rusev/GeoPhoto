<?php

class AlbumsController extends BaseController {

    public function onInit(){
        $this->title = "Albums";

    }

    public function index(){
        $model = new AlbumsModel();
        $this->albums = $model->getAll();
    }
    public function create(){
        $this ->renderView("create");
    }

    public function delete(){
        $this ->renderView("index");
    }
}
?>