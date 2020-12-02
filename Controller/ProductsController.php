<?php

    require_once "./View/ProductsView.php";
    require_once "./Model/ProductsModel.php";
    require_once "./Model/MarksModel.php";
    require_once "./Model/UserModel.php";
    require_once "./Model/ImageModel.php";
    require_once "./Model/CommentModel.php";
    require_once "Helper.php";

    class ProductsController extends Helper{

        private $view;
        private $model;
        private $marksModel;
        private $userModel;
        private $commentModel;
        private $imageModel;

        function __construct(){
            $this->view = new ProductsView();
            $this->model = new ProductsModel();
            $this->marksModel = new MarksModel();
            $this->userModel = new UserModel();
            $this->commentModel = new CommentModel();
            $this->imageModel = new ImageModel();
        }
        //LLAMA AL HOME
        function Home($params = null){
            $logeado = $this->CheckLoggedIn();
            $marks = $this->marksModel->GetMarks();

            $data_pagination = $this->Pagination($params);

            $productLimit = $data_pagination[0];
            $pagination = $data_pagination[1];
            $page = $data_pagination[2];
            if($logeado){
                $user = $_SESSION['EMAIL'];
                $this->view->ShowHome($productLimit, $marks, $pagination, $page, $user);
            }else{
                $this->view->ShowHome($productLimit, $marks, $pagination, $page);
            }

        }
        //PAGINACIÓN
        function Pagination($params){
            $products = $this->model->GetProducts();
            $data_pagination = [];
            $productByPage = 3;
            if(isset($params[':PAGE'])){
                $page = $params[':PAGE'];
            }else{
                $page = 1;
            }
            $rows = count($products);
            $totalPage = ceil($rows/$productByPage);
            $since = ($page-1)*$productByPage;
            $productLimit= $this->model->GetProductsByLimit($since, $productByPage);
            $pagination = [];
            for ($i = 1; $i <= $totalPage; $i++){
                array_push($pagination, $i);
            }
            array_push($data_pagination, $productLimit, $pagination, $page);
            return $data_pagination;
        }
        //INSERTA UN NUEVO PRODUCTO
        function InsertProduct(){
            $logeado = $this->CheckLoggedIn();
            if($logeado && $_SESSION['ADMIN'] == 1){
                if (isset($_POST['input_product']) && isset($_POST['input_price']) &&
                    isset($_POST['input_stock']) && isset($_POST['input_description']) && isset($_POST['select_brand'])) {
                    $product = $_POST['input_product'];
                    $price = $_POST['input_price'];
                    $stock = $_POST['input_stock'];
                    $description = $_POST['input_description'];
                    $brand =  $_POST['select_brand'];
                    $id_product = $this->model->InsertProduct($product,$price,$stock,$description,$brand);
                    $fileTemp = $_FILES['input_file']['tmp_name'];
                    for($i=0; $i<count($_FILES['input_file']['tmp_name']); $i++){
                        $name = basename($_FILES["input_file"]["name"][$i]);
                        if($name){
                            $filepath = "img/". $name;
                            move_uploaded_file($fileTemp[$i], $filepath);
                            $this->imageModel->InsertImg($filepath, $id_product);
                        }
                    }
                }
                $this->view->ShowLocation('admin');
            }else{
                $this->view->ShowLocation('login');
            }
        }
        //ELIMINA UN PRODUCTO POR ID
        function DeleteProduct($params = null){
            $logeado = $this->CheckLoggedIn();
            if($logeado && $_SESSION['ADMIN'] == 1){
                $product_id = $params[':ID'];
                $images = $this->imageModel->GetImagenByProduct($product_id);
                $this->model->DeleteProduct($product_id);
                for($i=0; $i<count($images); $i++){
                    $imageInUse = $this->imageModel->SearchImageInUse($images[$i]->imagen);
                    if(!$imageInUse){
                        unlink($images[$i]->imagen);
                    }
                }
                $this->view->ShowLocation('admin');
            }else{
                $this->view->ShowLocation('login');
            }
        }
        //LLAMA LA VISTA PARA EDITAR UN PRODUCTO POR ID
        function EditProduct($params = null){
            $logeado = $this->checkLoggedIn();
            if($logeado && $_SESSION['ADMIN'] == 1){
                $product_id = $params[':ID'];
                $marks = $this->marksModel->GetMarks();
                $product = $this->model->GetProductById($product_id);
                $images = $this->imageModel->GetImagenByProduct($product_id);
                $this->view->ShowEditProduct($product, $marks, $images);
            }else{
                $this->view->ShowLocation('login');
            }
        }
        //LLAMA A ACTUALIZAR UN PRODUCTO
        function UpdateProduct($params = null){
            $logeado = $this->CheckLoggedIn();
            if($logeado && $_SESSION['ADMIN'] == 1){
                $product_id = $params[':ID'];
                if (isset($_POST['edit_product']) && isset($_POST['edit_price']) && isset($_POST['edit_stock'])
                 && isset($_POST['edit_description']) && isset($_POST['select_brand'])){
                    $product = $_POST['edit_product'];
                    $price = $_POST['edit_price'];
                    $stock = $_POST['edit_stock'];
                    $description = $_POST['edit_description'];
                    $brand = $_POST['select_brand'];
                    $this->model->UpdateProduct($product,$price,$stock,$description,$brand,$product_id);
                    $fileTemp = $_FILES['input_file']['tmp_name'];
                    for($i=0; $i<count($_FILES['input_file']['tmp_name']); $i++){
                        $name = basename($_FILES["input_file"]["name"][$i]);
                        if($name){
                        $filepath = "img/". $name;
                            move_uploaded_file($fileTemp[$i], $filepath);
                            $this->imageModel->InsertImg($filepath, $product_id);
                        }
                    }
                }
                $this->view->ShowLocation('admin');
            }else{
                $this->view->ShowLocation('login');
            }
        }
        //LLAMA AL FILTRO DE LOS PRODUCTOS POR MARCA
        function FilterProductsByMark($params = null){
            if (isset($_POST['select_brand'])) {
                $mark_id = $_POST['select_brand'];
                $products = $this->model->GetProductsByMark($mark_id);
                $marks = $this->marksModel->GetMarks();
                $this->view->ShowSearch($products, $marks, $user = null, $mark_id);
            }
        }
        //LLAMA A LA VISTA EN DETALLE DE UN PRODUCTO
        function ItemDetail($params = null){
            $logeado = $this->CheckLoggedIn();
            $product_id = $params[':ID'];
            $product = $this->model->GetProductById($product_id);
            $images = $this->imageModel->GetImagenByProduct($product_id);
            $mark_id = $product->id_marca;
            $mark = $this->marksModel->GetMarkById($mark_id);
            //prepara rango de valoracion de productos.
            $starRank = 5;
            $stars = [];
            for ($i = $starRank; $i >= 1; $i--){
                array_push($stars, $i);
            }
            if($logeado){
                $user = $_SESSION['EMAIL'];
                $usuario = $this->userModel->GetUser($user);
                $Iduser = $usuario->id;
                $admin = $_SESSION['ADMIN'];
                $this->view->ShowItemDetail($product, $mark, $images, $stars, $user, $Iduser, $admin);
            }else{
                $this->view->ShowItemDetail($product, $mark, $images);
            }
        }
        //BORRA UNA IMAGEN
        function DeleteImg($params = null){
            $logeado = $this->CheckLoggedIn();
            if($logeado && $_SESSION['ADMIN'] == 1){
                $image_id = $params[':ID'];
                $filepath = $this->imageModel->SearchFilepath($image_id);
                $this->imageModel->DeleteImg($image_id);
                //busco si esta imagen está relacionada a otro producto
                $imageInUse = $this->imageModel->SearchImageInUse($filepath->imagen);
                if(!$imageInUse){
                    unlink($filepath->imagen);
                }
                $product_id = $params[':PRODUCT'];
                $this->view->ShowLocation('edit/'. $product_id);
            } else {
                $this->view->ShowLocation('login');
            }
        }
        //BUSCA ITEMS
        function SearchItem(){
            $products=null;
            if(!empty($_POST["input_name"])&&!empty($_POST["select_price"])){
                $name = $_POST["input_name"];
                $rangoPrecio = $_POST["select_price"];
                $precioSeparado = explode("-", $rangoPrecio);
                $precioMinimo = $precioSeparado[0];
                $precioMaximo = $precioSeparado[1];
                $products= $this->model->SearchItem($name, $precioMinimo, $precioMaximo);
            } else if(!empty($_POST["select_price"])){
                $rangoPrecio = $_POST["select_price"];
                $precioSeparado = explode("-", $rangoPrecio);
                $precioMinimo = $precioSeparado[0];
                $precioMaximo = $precioSeparado[1];
                $products= $this->model->SearchItemByPrice($precioMinimo, $precioMaximo);
            } else if(!empty($_POST["input_name"])){
                $search = $_POST["input_name"];
                $products= $this->model->SearchItemByName($search);
            }
            $logeado = $this->CheckLoggedIn();
            $marks = $this->marksModel->GetMarks();
            if($logeado){
                $user = $_SESSION['EMAIL'];
                $this->view->ShowSearch($products, $marks, $user);
            } else{
                $this->view->ShowSearch($products, $marks);
            }
        }
    }
?>