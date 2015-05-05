<?php
class PicturesController extends BaseController {

    private $model;
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

    public function get_exif_data($imageName){
        $exifData = exif_read_data($imageName,0,true);
        return $exifData;
    }

    public function validate_image($image){
        // 1. Validate the image size
        if($image > (5000000)){

            return false;
        }

        return true;
    }

    public function upload_picture($image){
        if ($image['name']) {
            //Checks for errors during uploading of the image
            if (!$image['error']) {
                //now is the time to modify the future file name and validate the file
                $new_file_name = strtolower($image['name']);

                $this->isValid = $this->validate_image($image['tmp_name']);

                $imageName = IMAGES_DIR . $new_file_name;

                //if the file has passed the test
                if ($this->isValid) {
                    if (move_uploaded_file($image['tmp_name'], $imageName)) {

                        $this->dateUploaded = date('Y-m-d');
                        $this->imageUrl = $imageName;
                        $imageExif = $this->get_exif_data($imageName);

                        foreach ($imageExif as $key => $section) {
                            foreach ($section as $name => $val) {
                                if ($key == 'GPS' && $name == 'GPSLongitude') {
                                    $longitudeData = explode('/', $val[2]);
                                    $this->longitude = floatval($longitudeData[0]/(float)$longitudeData[1]);
                                }
                                if ($key == 'GPS' && $name == 'GPSLatitude') {
                                    $latitudeData = explode('/', $val[2]);
                                    $this->latitude = floatval($latitudeData[0]/(float)$latitudeData[1]);
                                }
                                if ($key == 'IFD0' && $name == 'Make') {
                                    $this->cameraModel=$val;
                                }
                                if ($key == 'IFD0' && $name == 'Model') {
                                    $this->cameraModel.=' '.$val;

                                }
                                if ($key == 'IFD0' && $name == 'DateTime') {
                                    $this->dateShooted = $val;
                                }

                            }
                        }

                    }
                }
                echo "uploading of picture is successfull";
            }
            else {
                echo "There is a problem with image uploading!!!";
            }
        }
    }

    public function upload(){
        if($this->isPost()) {
            $albumId = $_SESSION['albumId'];
            $imageCaption = $_POST['image_caption'];
            $this->upload_picture($_FILES['image_filename']);
            $isUploadedInDatabase = $this->model->upload($albumId,$imageCaption,$this->cameraModel,
                $this->dateShooted,$this->dateUploaded,$this->latitude,$this->longitude,$this->imageUrl);

            if($isUploadedInDatabase){
                echo "Everything is ok!";
                $this->redirect("pictures");
            }
            else{
                echo "Something goes wrong!";
                $this->redirect("pictures","upload");
            }
        }

    }
}