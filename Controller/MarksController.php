<?php

    require_once "./View/ProductsView.php";
    require_once "./View/MarksView.php";
    require_once "./Model/ProductsModel.php";
    require_once "./Model/MarksModel.php";

    class MarksController{

        private $Productsview;
        private $MarksView;
        private $productosModel;
        private $marksModel;

        function __construct(){
            $this->Productsview = new ProductsView();
            $this->MarksView = new MarksView();
            $this->productosModel = new ProductsModel();
            $this->marksModel = new MarksModel();
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
            $this->Productsview->ShowLoginUsername($products, $marks);
        }
        //ELIMINA UNA MARCA POR ID
        function DeleteMark($params = null){
            $mark_id = $params[':ID'];
            $this->marksModel->DeleteMark($mark_id);
            $marks = $this->marksModel->GetMarks();
            $products = $this->productosModel->GetProducts();
            $this->Productsview->ShowLoginUsername($products, $marks);
        }
        //LLAMA LA VISTA PARA EDITAR UNA MARCA POR ID
        function EditMark($params = null){
            $mark_id = $params[':ID'];
            $marks = $this->marksModel->GetMarks($mark_id);
            // var_dump($product);
            $this->Productsview->ShowEditProduct($product, $marks); 
        }
        //LLAMA A ACTUALIZAR UNA MARCA
        function UpdateMark($params = null){
            $product_id = $params[':ID'];
            if ((isset($_GET['edit_product']) && isset($_GET['edit_price'])) && (isset($_GET['edit_stock']) && isset($_GET['edit_description'])) && isset($_GET['select_brand'])) {
                $product = $_GET['edit_product'];
                $price = $_GET['edit_price'];
                $stock = $_GET['edit_stock'];
                $description = $_GET['edit_description'];
                $brand = $_GET['select_brand'];
                $this->model->UpdateProduct($product,$price,$stock,$description,$brand,$product_id);
            }
            $marks = $this->marksModel->GetMarks();
            $products = $this->model->GetProducts();
            $this->Productsview->ShowLoginUsername($products, $marks);
        }

    }
?>