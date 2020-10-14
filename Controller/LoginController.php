<?php
require_once "./View/LoginView.php";
require_once "./View/ProductsView.php";
require_once "./Model/LoginModel.php";
require_once "./Model/MarksModel.php";
require_once "./Model/ProductsModel.php";

class LoginController{

    private $view;
    private $productView;
    private $model;
    private $modelProducts;
    private $marksModel;

    function __construct(){
        $this->view= new LoginView();
        $this->productView = new ProductsView();
        $this->model= new LoginModel();
        $this->modelProducts = new ProductsModel();
        $this->marksModel = new MarksModel();;
    }
    //LLAMA AL LOGIN
    function Login(){
        $logeado = $this->checkLoggedIn();
        if($logeado){
            $this->productView->ShowLocation('admin');
        } else {
            $this->view->ShowLogin();
        }
    }
    //LLAMO AL LOGOUT
    function Logout(){
        session_start();
        session_destroy();
        header("Location: ".LOGIN);

    }
    //VEO SI ESTA LOGGEADO
    function checkLoggedIn(){
        session_start();
        if(!isset($_SESSION['EMAIL'])){
            return false;
        }else return true;
    }  
    //VERIFICO MI USUARIO
    function VerifyUser(){
        $user = $_POST["input_username"];
        $pass = $_POST["input_password"];

        if(isset($user)){
            $userFromDB = $this->model->GetUser($user);
            if(isset($userFromDB) && $userFromDB){
                // Existe el usuario
                if (password_verify($pass, $userFromDB->password)){
                    session_start();
                    if(isset($_SESSION['LAST_ACTIVITY']) && (time()-$_SESSION['LAST_ACTIVITY']>1000)){
                        header("Location: ".LOGOUT);
                    }
                    $_SESSION["EMAIL"] = $userFromDB->email;
                    $_SESSION['LAST_ACTIVITY'] = time();
                    $this->productView->ShowLocation('admin');
                }else{
                    $this->view->ShowLogin("Contraseña incorrecta");
                }

            }else{
                // No existe el user en la DB
                $this->view->ShowLogin("El usuario no existe");
            }
        }
    }
    //MUESTRA LA PAGUINA DONDE SE PUEDE MODIFICAR LOS PRODUCTOS Y MARCAS(esta función es llamada action 'admin';)
    function ShowAdmin(){
        $logeado = $this->checkLoggedIn();
        if($logeado){
            $marks = $this->marksModel->GetMarks();
            $products = $this->modelProducts->GetProducts();
            $this->view->ShowVerify($products, $marks);
        }else{
            $this->view->ShowLogin();
        }
    }
}
?>