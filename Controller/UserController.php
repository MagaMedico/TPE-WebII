<?php
require_once "./View/UserView.php";
require_once "./Model/UserModel.php";

class UserController{

    private $view;
    private $model;
    private $loginView;
    private $loginControl;

    function __construct(){
        $this->view= new UserView();
        $this->model= new UserModel();
        $this->loginView = new LoginView();
        $this->loginControl = new LoginController();
    }

    function ShowUsers(){
        $logeado = $this->loginControl->checkLoggedIn();
        if($logeado){
            $users = $this->model->GetUsers();
            $this->view->ShowUsers($users);
        }else{
            $this->loginView->ShowLogin();
        }
    }
    
    function EditUser($params = null){
        $logeado = $this->loginControl->checkLoggedIn();
        if($logeado){
            $id = $params[':ID'];
            $user = $this->model->GetUserById($id);
            $this->view->ShowEdit($user);
        }else{
            $this->loginView->ShowLogin();
        }
    }

    function UpdateUser($params = null){
        $logeado = $this->loginControl->checkLoggedIn();
        if($logeado){
            $id = $params[':ID'];
            if(isset($_POST['selectAdmin'])){
                $admin = $_POST['selectAdmin'];
                $this->model->UpdateUser($admin, $id);
                header("Location: ".BASE_URL.adminUsers);
            }
        }else{
            $this->loginView->ShowLogin();
        }
    }

    function DeleteUser($params = null){
        $logeado = $this->loginControl->CheckLoggedIn();
        if($logeado){
            $id = $params[':ID'];
            $this->model->DeleteUser($id);
            header("Location: ".BASE_URL.adminUsers);
        }else{
            $this->loginView->ShowLogin();
        }
    }
}
?>