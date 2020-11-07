<?php
require_once 'RouterClass.php';
require_once 'api/ApiCommentsController.php';

// instacio el router
$router = new Router();

// armo la tabla de ruteo de la API REST
$router->addRoute('comments', 'GET', 'ApiCommentsController', 'GetComments');
$router->addRoute('comments/:ID', 'GET', 'ApiCommentsController', 'GetComent');
$router->addRoute('comments/:ID', 'DELETE', 'ApiCommentsController', 'DeleteComment');

$router->addRoute('comments', 'POST', 'ApiCommentsController', 'InsertComment');


$router->addRoute('comments/:ID', 'PUT', 'ApiCommentsController', 'UpdateComment');


 //run
 $router->route($_GET['resource'], $_SERVER['REQUEST_METHOD']); 