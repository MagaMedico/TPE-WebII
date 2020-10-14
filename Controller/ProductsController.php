<?php

    require_once "./View/ProductsView.php";
    require_once "./View/LoginView.php";
    require_once "./Model/ProductsModel.php";
    require_once "./Model/MarksModel.php";
    require_once "./Controller/LoginController.php";

    class ProductsController{

        private $view;
        private $model;
        private $marksModel;
        private $loginView;
        private $loginControl;

        function __construct(){
            $this->view = new ProductsView();
            $this->model = new ProductsModel();
            $this->marksModel = new MarksModel();
            $this->loginView = new LoginView();
            $this->loginControl = new LoginController();
        }
        //LLAMA AL HOME
        function Home(){
            $marks = $this->marksModel->GetMarks();
            $products = $this->model->GetProducts();
            $this->view->ShowHome($products, $marks);
        }
        //INSERTA UN NUEVO PRODUCTO
        function InsertProduct(){
            $logeado = $this->loginControl->checkLoggedIn();
            if($logeado){
                if ((isset($_POST['input_product']) && isset($_POST['input_price'])) && (isset($_POST['input_stock']) && isset($_POST['input_description'])) && isset($_POST['select_brand'])) {
                    $product = $_POST['input_product'];
                    $price = $_POST['input_price'];
                    $stock = $_POST['input_stock'];
                    $description = $_POST['input_description'];
                    $brand =  $_POST['select_brand'];
                $this->model->InsertProduct($product,$price,$stock,$description,$brand);
                }
                $this->view->ShowLocation('admin');
            }else{
                $this->loginView->Login();
            }
        }
        //ELIMINA UN PRODUCTO POR ID
        function DeleteProduct($params = null){
            $logeado = $this->loginControl->checkLoggedIn();
            if($logeado){
                $product_id = $params[':ID'];
                $this->model->DeleteProduct($product_id);
                $this->view->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA LA VISTA PARA EDITAR UN PRODUCTO POR ID
        function EditProduct($params = null){
            $logeado = $this->loginControl->checkLoggedIn();
            if($logeado){
                $product_id = $params[':ID'];
                $marks = $this->marksModel->GetMarks();
                $product = $this->model->GetProductById($product_id);
                $this->view->ShowEditProduct($product, $marks); 
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA A ACTUALIZAR UN PRODUCTO
        function UpdateProduct($params = null){
            $logeado = $this->loginControl->checkLoggedIn();
            if($logeado){
                $product_id = $params[':ID'];
                if ((isset($_POST['edit_product']) && isset($_POST['edit_price'])) && (isset($_POST['edit_stock']) && isset($_POST['edit_description'])) && isset($_POST['select_brand'])) {
                    $product = $_POST['edit_product'];
                    $price = $_POST['edit_price'];
                    $stock = $_POST['edit_stock'];
                    $description = $_POST['edit_description'];
                    $brand = $_POST['select_brand'];
                    $this->model->UpdateProduct($product,$price,$stock,$description,$brand,$product_id);
                }
                $this->view->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }
        }
        //LLAMA AL FILTRO DE LOS PRODUCTOS POR MARCA
        function FilterProductsByMark(){
            if (isset($_POST['select_brand'])) {
                $mark_id = $_POST['select_brand'];
                $products = $this->model->GetProductsByMark($mark_id);
                $marks = $this->marksModel->GetMarks();
                $this->view->ShowHome($products, $marks);
            }
        }
        //LLAMA A LA VISTA EN DETALLE DE UN PRODUCTO
        function ItemDetail($params = null){
            $product_id = $params[':ID'];
            $product = $this->model->GetProductById($product_id);
            $mark_id = $product->id_marca;
            $mark = $this->marksModel->GetMarkById($mark_id);
            $this->view->ShowItemDetail($product, $mark); 
        }
    }
?>