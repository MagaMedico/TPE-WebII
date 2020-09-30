<?php
    require_once 'Controller/ProductsController.php';
    require_once 'Controller/MarksController.php';
    require_once 'RouterClass.php';
    
    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

    $r = new Router();

    // rutas
    //PRODUCTOS
    $r->addRoute("home", "GET", "ProductsController", "Home");
    $r->addRoute("login", "GET", "ProductsController", "Login");
    $r->addRoute("username", "POST", "ProductsController", "LoginUsername");
    $r->addRoute("insert", "POST", "ProductsController", "InsertProduct");
    $r->addRoute("delete/:ID", "GET", "ProductsController", "DeleteProduct");
    $r->addRoute("filterMark", "GET", "ProductsController", "FilterMark");
    //ARREGLAR, NO FUNCIONAN COMO DEBEN
    $r->addRoute("edit/:ID", "GET", "ProductsController", "EditProduct");
    $r->addRoute("update/:ID", "GET", "ProductsController", "UpdateProduct");
    //MARCAS 
    $r->addRoute("mark", "GET", "MarksController", "HomeMarks");
    //MARCAS LoginUsername
    $r->addRoute("insertMark", "POST", "MarksController", "InsertMark");
    $r->addRoute("deleteMark/:ID", "GET", "MarksController", "DeleteMark");
    //FALTAN HACERLAS, ESTAN PLANTEADAS PERO NO HECHAS.
    $r->addRoute("editMark/:ID", "GET", "MarksController", "EditMark");
    $r->addRoute("updateMark/:ID", "GET", "MarksController", "UpdateMark");

    //Ruta por defecto.
    $r->setDefaultRoute("ProductsController", "Home");

    //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
?>