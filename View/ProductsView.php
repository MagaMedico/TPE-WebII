<?php

    require_once "./libs/smarty/Smarty.class.php";

    class ProductsView{

        private $title;
        private $titleEdit;
        private $smarty;
        
        function __construct(){
            $this->title = "Tabla de productos";
            $this->titleEdit = "Editar producto";
            $this->titleMark = "Tabla de marcas";
            $this->smarty = new Smarty();
        }
        //REDIRECCIONA LAS CONSTANTES PARA RUTEO 
        function ShowLocation($action){
            header("Location: ".BASE_URL.$action);
        }
        //MUESTRA EL HOME
        function ShowHome($products, $marks, $pagination, $page, $user = null){
            $this->smarty->assign('title', $this->title);
            $this->smarty->assign('products', $products);
            $this->smarty->assign('marks', $marks);
            $this->smarty->assign('pagination', $pagination);
            $this->smarty->assign('page', $page);
            $this->smarty->assign('user', $user);
            // muestro el template 
            $this->smarty->display('templates/products.tpl'); 
        }
        //VISTA PARA EDITAR UN PRODUCTO
        function ShowEditProduct($product, $marks){
            $this->smarty->assign('product', $product);
            $this->smarty->assign('marks', $marks);
            // muestro el template 
            $this->smarty->display('templates/editProduct.tpl'); 
        }
        //VISTA DE UN PRODUCTO EN DETALLE - TABLA PRODUCTO Y TABLA DE LA MARCA
        function ShowItemDetail($product, $mark, $stars=null , $user = null, $Iduser = null, $admin = null){
            $this->smarty->assign('product', $product);
            $this->smarty->assign('mark', $mark);
            $this->smarty->assign('stars', $stars);
            $this->smarty->assign('user', $user);
            $this->smarty->assign('Iduser', $Iduser);
            $this->smarty->assign('admin', $admin);
            // muestro el template
            $this->smarty->display('templates/itemDetail.tpl'); 
        }
        //VEO LO BUSCADO
        function ShowSearch($products, $marks, $user=null){
            $this->smarty->assign('title', $this->title);
            $this->smarty->assign('products', $products);
            $this->smarty->assign('marks', $marks);
            $this->smarty->assign('user', $user);
            $this->smarty->display('templates/showSearch.tpl'); 
        }
    }
?>