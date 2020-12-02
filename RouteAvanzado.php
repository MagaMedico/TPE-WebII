<?php
    require_once 'Controller/ProductsController.php';
    require_once 'Controller/MarksController.php';
    require_once 'Controller/LoginController.php';
    require_once 'Controller/UserController.php';
    require_once 'RouterClass.php';

    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');

    $r = new Router();

    //HOME
    $r->addRoute("home/:PAGE", "GET", "ProductsController", "Home");
    $r->addRoute("mark", "GET", "MarksController", "HomeMarks");
    $r->addRoute("filterMark", "POST", "ProductsController", "FilterProductsByMark");
    $r->addRoute("itemDetail/:ID", "GET", "ProductsController", "ItemDetail");
    $r->addRoute("search", "POST", "ProductsController", "SearchItem");
    //LOGIN
    $r->addRoute("login", "GET", "LoginController", "Login");
    $r->addRoute("register", "GET", "LoginController", "Register");
    $r->addRoute("newUser", "POST", "LoginController", "NewUser");
    $r->addRoute("verify", "POST", "LoginController", "VerifyUser");
    $r->addRoute("admin", "GET", "LoginController", "ShowAdmin");
    $r->addRoute("logout", "GET", "LoginController", "Logout");
    //PRODUCTOS
    $r->addRoute("insert", "POST", "ProductsController", "InsertProduct");
    $r->addRoute("delete/:ID", "GET", "ProductsController", "DeleteProduct");
    $r->addRoute("edit/:ID", "GET", "ProductsController", "EditProduct");
    $r->addRoute("update/:ID", "POST", "ProductsController", "UpdateProduct");
    //MARCAS
    $r->addRoute("insertMark", "POST", "MarksController", "InsertMark");
    $r->addRoute("deleteMark/:ID", "GET", "MarksController", "DeleteMark");
    $r->addRoute("editMark/:ID", "GET", "MarksController", "EditMark");
    $r->addRoute("updateMark/:ID", "POST", "MarksController", "UpdateMark");
    //ADMIN USER
    $r->addRoute("adminUsers", "GET", "UserController", "ShowUsers");
    $r->addRoute("editUser/:ID", "GET", "UserController", "EditUser");
    $r->addRoute("updateUser/:ID", "POST", "UserController", "UpdateUser");
    $r->addRoute("deleteUser/:ID", "GET", "UserController", "DeleteUser");
    //ELIMINA IMAGEN
    $r->addRoute(":PRODUCT/deleteImg/:ID", "GET", "ProductsController", "DeleteImg");
    //Ruta por defecto.
    $r->setDefaultRoute("ProductsController", "Home");

    //run
    $r->route($_GET['action'], $_SERVER['REQUEST_METHOD']);
?>