<?php
class PicturesController extends BaseController {

    private $model;
    private $isValid;

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

    public function rename_image($image){

    }

    public function upload(){
        if($this->isPost()) {
            if ($_FILES['image_filename']['name']) {
                //Checks for errors during uploading of the image
                if (!$_FILES['image_filename']['error']) {
                    //now is the time to modify the future file name and validate the file
                    $new_file_name = strtolower($_FILES['image_filename']['name']);

                    $this->isValid = $this->validate_image($_FILES['image_filename']['tmp_name']);

                    $imageName = IMAGES_DIR . $new_file_name;

                    //if the file has passed the test
                    if ($this->isValid) {
                        if (move_uploaded_file($_FILES['image_filename']['tmp_name'], $imageName)) {

                            $name = $_POST['image_caption'];
                            $cameraModel = '';
                            $dateShooted = '';
                            $dateUploaded = date('Y-m-d');
                            $latitude = '';
                            $longitude = '';
                            $imageUrl = $imageName;

                            $imageExif = $this->get_exif_data($imageName);

                            foreach ($imageExif as $key => $section) {
                                foreach ($section as $name => $val) {
                                    if ($key == 'GPS' && $name == 'GPSLongitude') {
                                        $longitudeData = explode('/', $val[2]);
                                        $longitude = $longitudeData[0] / $longitudeData[1];
                                    }
                                    if ($key == 'GPS' && $name == 'GPSLatitude') {
                                        $latitudeData = explode('/', $val[2]);
                                        $latitude = $latitudeData[0] / $latitudeData[1];
                                    }
                                    if ($key == 'IFD0' && $name == 'Make') {
                                        $cameraModel + $val;
                                    }
                                    if ($key == 'IFD0' && $name == 'Model') {
                                        $cameraModel + $val;

                                    }
                                    if ($key == 'IFD0' && $name == 'DateTime') {
                                        $dateShooted = $val;
                                    }

                                }
                            }
                            $albumId=1;
                            $this->model->upload($albumId,$name, $cameraModel, $dateShooted, $dateUploaded, $latitude, $longitude, $imageUrl);
                        }


                        // $this->redirect('/pictures/index');
                    }
                } else {
                    $this->redirect('/pictures/upload');
                }
            }
        }

    }
}