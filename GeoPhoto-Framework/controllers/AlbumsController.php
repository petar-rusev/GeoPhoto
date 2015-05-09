<?php

class AlbumsController extends BaseController {

    private $dbImage;
    private $dbImagesArray=[];

    public function onInit(){
        $this->title = "Albums";
        $this->model = new AlbumsModel();
    }

    public function index(){
        $this->authorize();
        $this->albums = $this->model->getAll();
        $this->renderView();
    }

    public function set_album_wall(){

    }

    public function create(){
        $this->authorize();
        if($this->isPost()){
            $name = $_POST['album_name'];
            $description = $_POST['album_description'];
            $userId = $_SESSION['userId']['Id'];
            $isPublic = $_POST['album_isPublic'];
            if(!isset($isPublic)){
                $isPublic = 0;
            }

            if($this->model->create($name,$description,$userId,$isPublic)){
                $this->redirect('albums');
            }
            else{
                echo 'Album is not created';
            }

        }
    }

    public function edit($id){
        $this->authorize();
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
        $this->authorize();
        if($this->model->delete($id)){
            echo "The album successfully deleted";
        }
        else{
            echo "Can not delete the album.";
        }
    }

    public function get_exif_data($imageName){
        $exifData = exif_read_data($imageName,0,true);
        return $exifData;
    }

    public function upload_pictures($images){

        $max_size = 100000000;
        $extensions = array('jpeg', 'jpg', 'png');
        $count = 0;
        $dir = IMAGES_DIR;

        // loop all files
        foreach ($images['name'] as $i => $name) {


            // if file not uploaded then skip it
            if (!is_uploaded_file($images['tmp_name'][$i]))
                continue;

            // skip large files
            if ($images['size'][$i] > $max_size)
                continue;

            // skip unprotected files
            if (!in_array(pathinfo($name, PATHINFO_EXTENSION), $extensions))
                continue;

            // now we can move uploaded files
            if (move_uploaded_file($images["tmp_name"][$i], $dir.$name)){
                $this->dbImage->dateUploaded = date('Y-m-d h:i:s');

                $this->dbImage->imageName = preg_replace('/\\.[^.\\s]{3,4}$/', '',$name);
                $temp = explode('.',$name);

                foreach($temp as $part){
                    if(in_array($part,$extensions)){
                        $this->dbImage->imageType='.'.$part;
                    }

                }

                $this->dbImage->imageUrl = $dir.$name;
                $imageExif = $this->get_exif_data($this->dbImage->imageUrl);

                foreach ($imageExif as $key => $section) {
                    foreach ($section as $nameInSection => $val) {
                        if ($key == 'GPS' && $nameInSection == 'GPSLongitude') {
                            $longitudeData = explode('/', $val[2]);
                            $this->dbImage->longitude = floatval($longitudeData[0]/(float)$longitudeData[1]);
                        }
                        if ($key == 'GPS' && $nameInSection == 'GPSLatitude') {
                            $latitudeData = explode('/', $val[2]);
                            $this->dbImage->latitude = floatval($latitudeData[0]/(float)$latitudeData[1]);
                        }
                        if ($key == 'IFD0' && $nameInSection == 'Make') {
                            $this->dbImage->cameraModel = $val;
                        }
                        if ($key == 'IFD0' && $nameInSection == 'Model') {
                            $this->dbImage->cameraModel.=' '.$val;

                        }
                        if ($key == 'IFD0' && $nameInSection == 'DateTime') {
                            $this->dbImage->dateShooted = $val;
                        }

                    }

                }

            }
            array_push($this->dbImagesArray,$this->dbImage);
            $this->dbImage=null;
            $count++;

        }

        //echo json_encode(array('count' => $count));

    }

    public function upload($id){
        $this->authorize();
        if($this->isPost()) {

            $files = $_FILES["files"];
            $this->upload_pictures($files);
            $images = $this->dbImagesArray;

            for($i=0;$i<count($images);++$i){

                $isUploaded = $this->model->upload($id,$images[$i]->dbImageName,$images[$i]->cameraModel,$images[$i]->dateShooted,
                    $images[$i]->dateUploaded,$images[$i]->latitude,$images[$i]->longitude,$images[$i]->imageUrl,
                    $images[$i]->imageType,$images[$i]->imageName);

                $lastPicId = $_SESSION['imgLast'];

                if(!$isUploaded){
                    die;
                    echo 'Oops! A problem occured during uploading of your images.';
                }
                else{
                    $newFileName = IMAGES_DIR.$images[$i]->imageName.'_'.$lastPicId.$images[$i]->imageType;
                    $oldFileName = IMAGES_DIR.$images[$i]->imageName.$images[$i]->imageType;
                    rename($oldFileName,$newFileName);
                }
            }
            $this->redirect('home');
        }

    }

    public function hasImages(){
        $hasImages = null;
        $albumId = $_SESSION['albumId'];
        $hasImages = $this->model->hasImages($albumId);
        return $hasImages;
    }

    public function setWallImage(){
        $wallImage = null;
        $albumId = $_SESSION['albumId'];
        $wallImage = $this->model->set_wall($albumId);
        return $wallImage;
    }

    public function view($id,$page=0,$pageSize=5)
    {

        $this->authorize();
        $from = $page * $pageSize;
        $this->page=$page;
        $this->pageSize=$pageSize;
        $this->pictures = $this->model->view($id, $from, $pageSize);
    }

    public function getGps(){
        header('Content-Type: application/json');
        $albumId = $_SESSION['selectedAlbum'];

        $this->gpsData = $this->model->getGpsData($albumId);
    }
}
