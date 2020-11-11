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
        function ShowHome($products, $marks, $paginacion, $pagina, $user = null){
            $this->smarty->assign('titulo', $this->title);
            $this->smarty->assign('productos', $products);
            $this->smarty->assign('marks', $marks);
            $this->smarty->assign('paginacion', $paginacion);
            $this->smarty->assign('pagina', $pagina);
            $this->smarty->assign('usuario', $user);
            // muestro el template 
            $this->smarty->display('templates/products.tpl'); 
        }
        //VISTA PARA EDITAR UN PRODUCTO
        function ShowEditProduct($product, $marks){
            $this->smarty->assign('producto', $product);
            $this->smarty->assign('marks', $marks);
            // muestro el template 
            $this->smarty->display('templates/editProduct.tpl'); 
        }
        //VISTA DE UN PRODUCTO EN DETALLE - TABLA PRODUCTO Y TABLA DE LA MARCA
        function ShowItemDetail($product, $mark, $user = null){
            $this->smarty->assign('titulo', $this->title);
            $this->smarty->assign('producto', $product);
            $this->smarty->assign('mark', $mark);
            $this->smarty->assign('usuario', $user);
            // muestro el template 
            $this->smarty->display('templates/itemDetail.tpl'); 
        }
        //VEO LO BUSCADO
        function ShowSearch($products, $marks){
            $this->smarty->assign('titulo', $this->title);
            $this->smarty->assign('productos', $products);
            $this->smarty->assign('marks', $marks);
            $this->smarty->display('templates/showSearch.tpl'); 
        }

    }
?>