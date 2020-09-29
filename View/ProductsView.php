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
    //MUESTRA EL HOME
    function ShowHome($products){
        $smarty = new Smarty();
        $smarty->assign('titulo', $this->title);
        $smarty->assign('productos', $products);
        // muestro el template 
        $smarty->display('templates/products.tpl'); 
    }
    //MUESTRA EL LOGIN
    function ShowLogin(){
        $smarty = new Smarty();
        $smarty->display('templates/loginProduct.tpl'); 
    }
    //MUESTRA LA PAGINA PARA EL ADMIN
    function ShowLoginUsername($products){
        $smarty = new Smarty();
        $smarty->assign('titulo', $this->title);
        $smarty->assign('productos', $products);
        // muestro el template 
        $smarty->display('templates/loginUsername.tpl'); 
    }
    //VISTA PARA EDITAR UN PRODUCTO
    function ShowEditProduct($product){
        $smarty = new Smarty();
        //$smarty->assign('titulo', $this->titleEdit);
        $smarty->assign('producto', $product);
        // muestro el template 
        $smarty->display('templates/editProduct.tpl'); 
      
    }
    //REDIRECCIONA LAS CONSTANTES PARA RUTEO AL HOME
    function ShowHomeLocation(){
        header("Location: ".BASE_URL."home");
    }
    //MUESTRO LA TABLA DE MARCAS
    function ShowMarks($marks){
        $smarty = new Smarty();
        $smarty->assign('titulo', $this->titleMark);
        $smarty->assign('marks', $marks);
        // muestro el template 
        $smarty->display('templates/marks.tpl');
    }
}


?>