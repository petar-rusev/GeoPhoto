<?php
class PicturesController extends BaseController {

    private $model;
    private $currentAlbumId;
    private $isValid;
    public $cameraModel;
    private $dateShooted;
    private $dateUploaded;
    public $latitude;
    public $longitude;
    private $imageUrl;

    public function onInit(){
        $this->authorize();
        $this->title = 'Pictures';
        $this->model = new PicturesModel();
    }

}