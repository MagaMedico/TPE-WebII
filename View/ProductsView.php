<?php

require_once "./libs/smarty/Smarty.class.php";

class ProductsView{

    private $title;
    private $titleEdit;
    
    function __construct(){
        $this->title = "Tabla de productos";
        $this->titleEdit = "Editar producto";
    }
    //MUESTRA EL HOME
    function ShowHome($products){
        $smarty = new Smarty();
        $smarty->assign('titulo', $this->title);
        $smarty->assign('productos', $products);
        // muestro el template 
        $smarty->display('templates/products.tpl'); 
    }
    //VISTA PARA EDITAR UN PRODUCTO
    function ShowEditProduct($product){
        $smarty = new Smarty();
       // $smarty->assign('titulo', $this->titleEdit);
        $smarty->assign('producto', $product);
        // muestro el template 
        $smarty->display('templates/editProduct.tpl'); 
      
    }
    //REDIRECCIONA LAS CONSTANTES PARA RUTEO AL HOME
    function ShowHomeLocation(){
        header("Location: ".BASE_URL."home");
    }
    
}


?>