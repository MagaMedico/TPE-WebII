<?php
    require_once 'RouterClass.php';
    require_once 'api/ApiCommentController.php';

    // instacio el router
    $router = new Router();

    // armo la tabla de ruteo de la API REST
    $router->addRoute('product/:ID/comments', 'GET', 'ApiCommentController', 'GetComments');
    $router->addRoute('comments', 'POST', 'ApiCommentController', 'InsertComment');
    $router->addRoute('comments/:ID', 'DELETE', 'ApiCommentController', 'DeleteComment');

    //run
    $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']);
?>