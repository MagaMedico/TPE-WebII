<?php

    require_once "./View/ProductsView.php";
    require_once "./Model/ProductsModel.php";
    require_once "./Model/MarksModel.php";

    class MarksController{

        private $view;
        private $productosModel;
        private $marksModel;

        function __construct(){
            $this->view = new ProductsView();
            //$this->productosModel = new ProductsModel();
            $this->marksModel = new MarksModel();
        }
        //LLAMA AL HOME DE MARCAS
        function HomeMarks(){
            $marks = $this->marksModel->GetMarks();
            $this->view->ShowMarks($marks);
        }
        
        //INSERTA UNA NUEVA MARCA
        function InsertMark(){
            $this->marksModel->InsertMark($_POST['input_mark'],$_POST['input_category']);
            $marks = $this->marksModel->GetMarks();
            $this->view->ShowHomeMarks();
        }
        //ELIMINA UNA MARCA POR ID
        function DeleteMark($params = null){
            $mark_id = $params[':ID'];
            $this->marksModel->DeleteMark($mark_id);
            $this->view->ShowHomeMarks();
        }


        //LLAMA LA VISTA PARA EDITAR UN PRODUCTO POR ID
        function EditMark($params = null){
            $product_id = $params[':ID'];
            $marks = $this->marksModel->GetMarks();
            $product = $this->productosModel->GetProduct($product_id);
        // var_dump($product);
        $this->view->ShowEditProduct($product, $marks); 
        }
        //LLAMA A ACTUALIZAR UN PRODUCTO
        function UpdateMark($params = null){
            $product_id = $params[':ID'];
            if ((isset($_GET['edit_product']) && isset($_GET['edit_price'])) && (isset($_GET['edit_stock']) && isset($_GET['edit_description'])) && isset($_GET['select_brand'])) {
                $product = $_GET['edit_product'];
                $price = $_GET['edit_price'];
                $stock = $_GET['edit_stock'];
                $description = $_GET['edit_description'];
                $brand = $_GET['select_brand'];

                $this->productosModel->UpdateProduct($product_id,$product,$price,$stock,$description,$brand);
                //$this->model->UpdateProduct($product_id,$_GET['edit_product'],$_GET['edit_price'],$_GET['edit_stock'],$_GET['edit_description'],$_GET['select_brand']);
                $this->view->ShowLoginUsername();
            }
        }
    }
?>