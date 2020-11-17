<?php

    require_once "./View/MarksView.php";
    require_once "./Model/MarksModel.php";
    require_once "./View/LoginView.php";
    require_once "./Controller/LoginController.php";
    require_once "./View/ProductsView.php";

    class MarksController{

      
        private $marksView;
        private $marksModel;
        private $loginView;
        private $loginController;  
        private $productsView;

        function __construct(){
            $this->marksView = new MarksView();
            $this->marksModel = new MarksModel();
            $this->loginView = new LoginView();
            $this->loginController = new LoginController();
            $this->productsView = new ProductsView();
        }
        //LLAMA AL HOME DE MARCAS
        function HomeMarks(){
            $marks = $this->marksModel->GetMarks();
            $this->marksView->ShowMarks($marks);
        }
        //INSERTA UNA NUEVA MARCA
        function InsertMark(){
            $logeado = $this->loginController->CheckLoggedIn();
            if($logeado){
                if (isset($_POST['input_mark']) && isset($_POST['input_category'])) {
                    $mark = $_POST['input_mark'];
                    $category = $_POST['input_category'];
                    $this->marksModel->InsertMark($mark, $category);
                }
                $this->productsView->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //ELIMINA UNA MARCA POR ID
        function DeleteMark($params = null){
            $logeado = $this->loginController->CheckLoggedIn();
            if($logeado){
                $mark_id = $params[':ID'];
                $this->marksModel->DeleteMark($mark_id);
                $this->productsView->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA LA VISTA PARA EDITAR UNA MARCA POR ID
        function EditMark($params = null){
            $logeado = $this->loginController->CheckLoggedIn();
            if($logeado){
                $mark_id = $params[':ID'];
                $mark = $this->marksModel->GetMarkById($mark_id);
                $this->marksView->ShowEditMark($mark);
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA A ACTUALIZAR UNA MARCA
        function UpdateMark($params = null){
            $logeado = $this->loginController->CheckLoggedIn();
            if($logeado){
                $mark_id = $params[':ID'];
                if (isset($_POST['edit_mark']) && isset($_POST['edit_category'])) {
                    $mark = $_POST['edit_mark'];
                    $category = $_POST['edit_category'];
                    $this->marksModel->UpdateMark($mark,$category,$mark_id);
                }
                $this->productsView->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
        }
    }
?>