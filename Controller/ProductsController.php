<?php

    require_once "./View/ProductsView.php";
    require_once "./Model/ProductsModel.php";
    require_once "./Model/MarksModel.php";

    class ProductsController{

        private $view;
        private $model;
        private $marksModel;

        function __construct(){
            $this->view = new ProductsView();
            $this->model = new ProductsModel();
            $this->marksModel = new MarksModel();
        }
        //LLAMA AL HOME
        function Home(){
            $marks = $this->marksModel->GetMarks();
            $products = $this->model->GetProducts();
            //var_dump($products);
            $this->view->ShowHome($products, $marks, $mark_id = null);
        }
        //LLAMA AL LOGIN
        function Login(){
            $this->view->ShowLogin();
        }
        //MUESTRA LA PAGINA PARA EL ADMIN
        function LoginUsername(){
            $marks = $this->marksModel->GetMarks();
            $products = $this->model->GetProducts();
            $this->view->ShowLoginUsername($products, $marks);
        }
        //INSERTA UN NUEVO PRODUCTO
        function InsertProduct(){
            $this->model->InsertProduct($_POST['input_product'],$_POST['input_price'],$_POST['input_stock'],$_POST['input_description'],$_POST['select_brand']);
            $this->view->ShowHomeLocation();
        }
        //ELIMINA UN PRODUCTO POR ID
        function DeleteProduct($params = null){
            $product_id = $params[':ID'];
            $this->model->DeleteProduct($product_id);
            $this->view->ShowHomeLocation();
        }
        //LLAMA LA VISTA PARA EDITAR UN PRODUCTO POR ID
        function EditProduct($params = null){
            $product_id = $params[':ID'];
            $marks = $this->marksModel->GetMarks();
            $product = $this->model->GetProduct($product_id);
        // var_dump($product);
        $this->view->ShowEditProduct($product, $marks); 
        }
        //LLAMA A ACTUALIZAR UN PRODUCTO
        function UpdateProduct($params = null){
            $product_id = $params[':ID'];
            if ((isset($_GET['edit_product']) && isset($_GET['edit_price'])) && (isset($_GET['edit_stock']) && isset($_GET['edit_description'])) && isset($_GET['select_brand'])) {
                $product = $_GET['edit_product'];
                $price = $_GET['edit_price'];
                $stock = $_GET['edit_stock'];
                $description = $_GET['edit_description'];
                $brand = $_GET['select_brand'];

                $this->model->UpdateProduct($product_id,$product,$price,$stock,$description,$brand);
                //$this->model->UpdateProduct($product_id,$_GET['edit_product'],$_GET['edit_price'],$_GET['edit_stock'],$_GET['edit_description'],$_GET['select_brand']);
                $this->view->ShowLoginUsername();
            }
        }
        //LLAMA AL FILTRO DE LOS PRODUCTOS POR MARCA
        function FilterMark(){
            if (isset($_GET['select_brand'])) {
                $mark_id = $_GET['select_brand'];
                $products = $this->model->GetProductsByMark($mark_id);
                $marks = $this->marksModel->GetMarks();
                $this->view->ShowHome($products, $marks, $mark_id);
            }
        }
    }
?>