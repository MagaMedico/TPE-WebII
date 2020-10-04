<?php

    require_once "./View/ProductsView.php";
    require_once "./View/MarksView.php";
    require_once "./Model/ProductsModel.php";
    require_once "./Model/MarksModel.php";
    require_once "./View/LoginView.php";

    class MarksController{

        private $Productsview;
        private $MarksView;
        private $productosModel;
        private $marksModel;
        private $loginView;

        function __construct(){
            $this->Productsview = new ProductsView();
            $this->MarksView = new MarksView();
            $this->productosModel = new ProductsModel();
            $this->marksModel = new MarksModel();
            $this->loginView = new LoginView();
        }
        //LLAMA AL HOME DE MARCAS
        function HomeMarks(){
            $marks = $this->marksModel->GetMarks();
            $this->MarksView->ShowMarks($marks);
        }
        //INSERTA UNA NUEVA MARCA
        function InsertMark(){
            $this->marksModel->InsertMark($_POST['input_mark'],$_POST['input_category']);
            $marks = $this->marksModel->GetMarks();
            $products = $this->productosModel->GetProducts();
            $this->loginView->ShowVerify($products, $marks);
        }
        //ELIMINA UNA MARCA POR ID
        function DeleteMark($params = null){
            $mark_id = $params[':ID'];
            $this->marksModel->DeleteMark($mark_id);
            $marks = $this->marksModel->GetMarks();
            $products = $this->productosModel->GetProducts();
            $this->loginView->ShowVerify($products, $marks);
        }
        //LLAMA LA VISTA PARA EDITAR UNA MARCA POR ID
        function EditMark($params = null){
            $mark_id = $params[':ID'];
            $mark = $this->marksModel->GetMarkById($mark_id);
            $this->MarksView->ShowEditMark($mark); 
        }
        //LLAMA A ACTUALIZAR UNA MARCA
        function UpdateMark($params = null){
            $mark_id = $params[':ID'];
            if (isset($_POST['edit_mark']) && isset($_POST['edit_category'])) {
                $mark = $_POST['edit_mark'];
                $category = $_POST['edit_category'];
                $this->marksModel->UpdateMark($mark,$category,$mark_id);
            }
            $marks = $this->marksModel->GetMarks();
            $products = $this->productosModel->GetProducts();
            $this->loginView->ShowVerify($products, $marks);
        }
    }
?>