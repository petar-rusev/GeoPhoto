<?php
class HomeController extends  BaseController {

    private $model;

    public function onInit(){
        $this->title = "Home";
        $this->model = new HomeModel();
    }

    public function index(){
        $this->publicAllbums = $this->model->getPublicAllbums();
    }
}