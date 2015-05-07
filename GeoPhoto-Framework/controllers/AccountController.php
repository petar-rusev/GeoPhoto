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
                echo "User name is invalid";
                $this->redirect("account","register");
            }

            if($this->model->register($username,$password,$email,$phone)){
                $_SESSION['username'] = $username;
                $_SESSION[userId]=$this->model->getUser($username);
                $this->redirect("albums",'index');
            }
            else{
                echo "Register failed";
            }
        }

    }

    public function login(){
        if($this->isPost()){
            $username = $_POST['username'];
            $password = $_POST['password'];
            if($this->model->login($username,$password)){
                $_SESSION['username'] = $username;
                $_SESSION['userId'] = $this->model->getUser($username);
                $this->redirect('albums','index');
            }
            else{
                echo "Login Error!";
            }
        }
    }

    public function logout(){
        session_destroy();
        $this->redirectToUrl('/home/index');
    }

}