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
        function Home($params = null){
            $logeado = $this->loginControl->CheckLoggedInUser();
            $marks = $this->marksModel->GetMarks();
            $products = $this->model->GetProducts();

            $datos_paginacion = $this->Paginacion($products, $params);
            
            $productLimit = $datos_paginacion[0];
            $paginacion = $datos_paginacion[1];
            $pagina = $datos_paginacion[2];
            if($logeado){
                $user = $_SESSION['EMAIL'];
                $this->view->ShowHome($productLimit, $marks, $paginacion, $pagina, $user);
            }else{
                $this->view->ShowHome($productLimit, $marks, $paginacion, $pagina);
            }
            
        }
        //PAGINACIÓN
        function Paginacion($products, $params){
            $datos_paginacion = [];
            $productoPorPagina = 3;
            if(isset($params[':ID'])){
                $pagina = $params[':ID'];
            }else{
                $pagina = 1;
            }
            $filas = count($products);
            $totalPaginas = ceil($filas/$productoPorPagina);
            $desde = ($pagina-1)*$productoPorPagina;
            $productLimit= $this->model->GetProductsByLimit($desde, $productoPorPagina);
            $paginacion = [];
            for ($i = 1; $i <= $totalPaginas; $i++){
                array_push($paginacion, $i);
            }
            array_push($datos_paginacion, $productLimit, $paginacion, $pagina);
            return $datos_paginacion;
        }
        //INSERTA UN NUEVO PRODUCTO
        function InsertProduct(){
            $logeado = $this->loginControl->CheckLoggedIn();
            if($logeado){
                if (isset($_POST['input_product']) && isset($_POST['input_price']) && 
                    isset($_POST['input_stock']) && isset($_POST['input_description']) && isset($_POST['select_brand']) && 
                    ($_FILES['input_file']['type'] == "image/jpg" || $_FILES['input_file']['type'] == "image/jpeg" || $_FILES['input_file']['type'] == "image/png")) {
                    $product = $_POST['input_product'];
                    $price = $_POST['input_price'];
                    $stock = $_POST['input_stock'];
                    $description = $_POST['input_description'];
                    $brand =  $_POST['select_brand'];
                    $fileTemp = $_FILES['input_file']['tmp_name'];
                    $this->model->InsertProduct($product,$price,$stock,$description,$fileTemp,$brand);
                }
                else{
                    $this->model->InsertProduct($product,$price,$stock,$description,$brand);
                }
                $this->view->ShowLocation('admin'); 

            }else{
                $this->loginView->Login();
            }
        }
        //ELIMINA UN PRODUCTO POR ID
        function DeleteProduct($params = null){
            $logeado = $this->loginControl->CheckLoggedIn();
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
            $logeado = $this->loginControl->CheckLoggedIn();
            if($logeado){
                $product_id = $params[':ID'];
                if (isset($_POST['edit_product']) && isset($_POST['edit_price']) && isset($_POST['edit_stock']) && isset($_POST['edit_description']) && isset($_POST['select_brand']) && 
                ($_FILES['edit_file']['type'] == "image/jpg" || $_FILES['edit_file']['type'] == "image/jpeg" || $_FILES['edit_file']['type'] == "image/png")) {
                    $product = $_POST['edit_product'];
                    $price = $_POST['edit_price'];
                    $stock = $_POST['edit_stock'];
                    $description = $_POST['edit_description'];
                    $brand = $_POST['select_brand'];
                    $fileTemp = $_FILES['edit_file']['tmp_name'];
                    $this->model->UpdateProductImg($product,$price,$stock,$description,$fileTemp,$brand,$product_id);
                }
                else if(isset($_POST['edit_product']) && isset($_POST['edit_price']) && isset($_POST['edit_stock']) && isset($_POST['edit_description']) && isset($_POST['select_brand'])){
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
                $this->view->ShowSearch($products, $marks);
            }
        }
        //LLAMA A LA VISTA EN DETALLE DE UN PRODUCTO
        function ItemDetail($params = null){
            $logeado = $this->loginControl->CheckLoggedInUser();
            $product_id = $params[':ID'];
            $product = $this->model->GetProductById($product_id);
            $mark_id = $product->id_marca;
            $mark = $this->marksModel->GetMarkById($mark_id);
            if($logeado){
                $user = $_SESSION['EMAIL'];
                $Iduser = $_SESSION['ID'];
                $this->view->ShowItemDetail($product, $mark, $user, $Iduser);
            }else{
                $this->view->ShowItemDetail($product, $mark);
            }
        }
        //BORRA UNA IMAGEN
        function DeleteImg($params = null){
            $logeado = $this->loginControl->CheckLoggedIn();
            if($logeado){
                $product_id = $params[':ID'];
                $filepath ="";
                $this->model->DeleteImg($filepath, $product_id);
                $this->view->ShowLocation('admin');
            }else{
                $this->loginView->ShowLogin();
            }

        }
        //BUSCA ITEMS
        function SearchItem(){
            if(!empty($_POST["input_name"])){
                $search = $_POST["input_name"];
                $products= $this->model->SearchItemByName($search);
            } else if(!empty($_POST["input_price"])){
                $search = $_POST["input_price"];
                $products= $this->model->SearchItemByPrice($search);
            } else if(!empty($_POST["input_name"])&&!empty($_POST["input_price"])){
                $name = $_POST["input_name"];
                $price = $_POST["input_price"];
                $products= $this->model->SearchItem($name, $price);
            }
            $marks = $this->marksModel->GetMarks();
            $this->view->ShowSearch($products, $marks);
        }
    }
?>