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
            $isRegistered = $this->model->register($username,$password,$email,$phone);
            $userId = $this->model->getUser($username);

            if($isRegistered){
                $_SESSION['username'] = $username;
                $_SESSION[userId]=$userId;
                $this->redirect("albums");
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
            $isLogged = $this->model->login($username,$password);
            if($isLogged){
                $_SESSION['username'] = $username;
                $this->redirect('albums');
            }
            else{
                echo "Login Error!";
            }
        }
    }

    public function logout(){
        session_destroy();
        $this->redirectToUrl('/');
    }

}