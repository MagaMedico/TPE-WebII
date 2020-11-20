<?php
    require_once "./View/UserView.php";
    require_once "./View/ProductsView.php";
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
        //VISTA PARA EL ADMINISTRADOR DE LOS USUARIOS
        function ShowUsers(){
            $logeado = $this->loginControl->checkLoggedIn();
            if($logeado && $_SESSION['ADMIN'] == 1){
                $users = $this->model->GetUsers();
                $this->view->ShowUsers($users);
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA A LA VISTA PARA EDITAR UN USUARIO (SOLO PARA ADMINISTRADORES)
        function EditUser($params = null){
            $logeado = $this->loginControl->checkLoggedIn();
            if($logeado && $_SESSION['ADMIN'] == 1){
                $id = $params[':ID'];
                $user = $this->model->GetUserById($id);
                $this->view->ShowEdit($user);
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //ACTUALIZA LOS DATOS DE UN USUARIO (SOLO PARA ADMINISTRADORES)
        function UpdateUser($params = null){
            $logeado = $this->loginControl->checkLoggedIn();
            if($logeado && $_SESSION['ADMIN'] == 1){
                $id = $params[':ID'];
                $typeOfUser = $this->model->GetUserById($id);
                if($typeOfUser->admin == 0){
                    if(isset($_POST['selectAdmin'])){
                        $admin = $_POST['selectAdmin'];
                        $this->model->UpdateUser($admin, $id);
                        header("Location: ".BASE_URL.adminUsers);
                    }
                }else{
                    $existsAdmin = $this->model->ExistsAdmin();
                    $numberOfAdmin = 0;
                    foreach($existsAdmin as $admin){
                        $numberOfAdmin++;
                    }
                    if($numberOfAdmin != 1 && $numberOfAdmin != 0){
                        if(isset($_POST['selectAdmin'])){
                            $admin = $_POST['selectAdmin'];
                            $this->model->UpdateUser($admin, $id);
                            header("Location: ".BASE_URL.adminUsers);
                        }
                    }else{
                        $user = $this->model->GetUserById($id);
                        $this->view->ShowEdit($user, "No se pueden quitar permisos ya que es el ultimo administrador del sistema.");
                    }
                }
                
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //ELIMINA UN USUARIO (SOLO PARA ADMINISTRADORES)
        function DeleteUser($params = null){
            $logeado = $this->loginControl->CheckLoggedIn();
            if($logeado && $_SESSION['ADMIN'] == 1){
                $id = $params[':ID'];
                $typeOfUser = $this->model->GetUserById($id);
                if($typeOfUser->admin == 0){
                    $this->model->DeleteUser($id);
                    header("Location: ".BASE_URL.adminUsers);
                }else{
                    $existsAdmin = $this->model->ExistsAdmin();
                    $numberOfAdmin = 0;
                    foreach($existsAdmin as $admin){
                        $numberOfAdmin++;
                    }
                    if($numberOfAdmin != 1 && $numberOfAdmin != 0){
                        $this->model->DeleteUser($id);
                        header("Location: ".BASE_URL.adminUsers);
                    }else{
                        $users = $this->model->GetUsers();
                        $this->view->ShowUsers($users, "No se puede eliminar este usuario ya que es el ultimo administrador del sistema.");
                    }
                }
            }else{
                $this->loginView->ShowLogin();
            }
        }
    }
?>