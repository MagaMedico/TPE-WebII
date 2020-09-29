<?php

require_once "./View/ProductsView.php";
require_once "./Model/ProductsModel.php";

class ProductsController{

    private $view;
    private $model;

    function __construct(){
        $this->view = new ProductsView();
        $this->model = new ProductsModel();
    }
    //LLAMA AL HOME
    function Home(){
        $marks = $this->model->GetMarks();
        $products = $this->model->GetProducts();
        //var_dump($products);
        $this->view->ShowHome($products, $marks, $mark_id = null);
    }
    //LLAMA AL HOME DE MARCAS
    function HomeMarks(){
        $marks = $this->model->GetMarks();
        $this->view->ShowMarks($marks);
    }
    //LLAMA AL LOGIN
    function Login(){
        $this->view->ShowLogin();
    }
    //MUESTRA LA PAGINA PARA EL ADMIN
    function LoginUsername(){
        $marks = $this->model->GetMarks();
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
        $marks = $this->model->GetMarks();
        $product = $this->model->GetProduct($product_id);
       // var_dump($product);
       $this->view->ShowEditProduct($product, $marks); 
    }
    //LLAMA A ACTUALIZAR UN PRODUCTO
    function UpdateProduct($params = null){
        $product_id = $params[':ID'];
        $this->model->UpdateProduct($product_id,$_POST['edit_product'],$_POST['edit_price'],$_POST['edit_stock'],$_POST['edit_description'],$_POST['select_brand']);
        $this->view->ShowLoginUsername();
    }
    //LLAMA AL FILTRO DE LOS PRODUCTOS POR MARCA
    function FilterMark(){
        if (isset($_GET['select_brand'])) {
            $mark_id = $_GET['select_brand'];
            $products = $this->model->GetProductsByMark($mark_id);
            $marks = $this->model->GetMarks();
            $this->view->ShowHome($products, $marks, $mark_id);
        }
    }
}


?>