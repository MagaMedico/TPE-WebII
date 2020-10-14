<?php

    require_once "./View/ProductsView.php";
    require_once "./View/MarksView.php";
    require_once "./Model/ProductsModel.php";
    require_once "./Model/MarksModel.php";
    require_once "./View/LoginView.php";
    require_once "./Controller/LoginController.php";

    class MarksController{

        private $productsView;
        private $marksView;
        private $productosModel;
        private $marksModel;
        private $loginView;
        private $loginControl;

        function __construct(){
            $this->productsView = new ProductsView();
            $this->marksView = new MarksView();
            $this->productosModel = new ProductsModel();
            $this->marksModel = new MarksModel();
            $this->loginView = new LoginView();
            $this->loginControl = new LoginController();
        }
        //LLAMA AL HOME DE MARCAS
        function HomeMarks(){
            $marks = $this->marksModel->GetMarks();
            $this->marksView->ShowMarks($marks);
        }
        //INSERTA UNA NUEVA MARCA
        function InsertMark(){
            $logeado = $this->loginControl->checkLoggedIn();
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
            $logeado = $this->loginControl->checkLoggedIn();
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
            $logeado = $this->loginControl->checkLoggedIn();
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
            $logeado = $this->loginControl->checkLoggedIn();
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