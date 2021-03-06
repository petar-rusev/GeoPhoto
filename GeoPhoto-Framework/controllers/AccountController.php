<?php
class AccountController extends BaseController {

    private $model;

    public function onInit(){
        $this->title = "Account";
        $this->model = new AccountsModel();
    }

    public function register(){
        if($this->isPost()){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            if($username == null || strlen($username) < 3){
                $this->redirect("account","register");
            }

            if($this->model->register($username,$password,$email,$phone)){
                $_SESSION['username'] = $username;
                $_SESSION[userId]=$this->model->getUser($username);
                $this->redirect('albums');
            }

        }

    }

    public function login(){

        if($this->isPost()){
            $username = $_POST['username'];
            $password = $_POST['password'];
            $isLogged = $this->model->login($username,$password);
            if($isLogged){
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $this->model->getUser($username);

            }
            $this->redirect('albums');
        }
    }

    public function logout(){
        session_destroy();
        $this->redirect('home','index');
    }

    public function view($id){
        $this->userAlbums=$this->model->getAlbums($id);
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
}