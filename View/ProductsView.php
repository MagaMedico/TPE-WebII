<?php

    require_once "./libs/smarty/Smarty.class.php";

    class ProductsView{

        private $title;
        private $titleEdit;
        
        function __construct(){
            $this->title = "Tabla de productos";
            $this->titleEdit = "Editar producto";
            $this->titleMark = "Tabla de marcas";
        }
        //REDIRECCIONA LAS CONSTANTES PARA RUTEO 
        function ShowLocation($action){
            header("Location: ".BASE_URL.$action);
        }
        //MUESTRA EL HOME
        function ShowHome($products, $marks, $paginacion){
            $smarty = new Smarty();
            $smarty->assign('titulo', $this->title);
            $smarty->assign('productos', $products);
            $smarty->assign('marks', $marks);
            $smarty->assign('paginacion', $paginacion);
            // muestro el template 
            $smarty->display('templates/products.tpl'); 
        }
        //VISTA PARA EDITAR UN PRODUCTO
        function ShowEditProduct($product, $marks){
            $smarty = new Smarty();
            $smarty->assign('producto', $product);
            $smarty->assign('marks', $marks);
            // muestro el template 
            $smarty->display('templates/editProduct.tpl'); 
        }
        //VISTA DE UN PRODUCTO EN DETALLE - TABLA PRODUCTO Y TABLA DE LA MARCA
        function ShowItemDetail($product, $mark){
            $smarty = new Smarty();
            $smarty->assign('titulo', $this->title);
            $smarty->assign('producto', $product);
            $smarty->assign('mark', $mark);
            // muestro el template 
            $smarty->display('templates/itemDetail.tpl'); 
        }
    }
?>