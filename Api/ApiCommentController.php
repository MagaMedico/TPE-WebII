<?php
require_once './Model/CommentModel.php';
require_once 'ApiController.php';

class ApiCommentController extends ApiController {

  
    function __construct() {
        parent::__construct();
        $this->model = new CommentModel();
    }

    public function GetComments($params = null) {
        $comments = $this->model->GetComments();
        $this->view->response($comments, 200);
    }

    public function InsertComment($params = null){
        $body = $this->getData();

        $idComment = $this->model->InsertComment($body->comentario,$body->valoracion,$body->id_usuario,$body->id_producto);

        if (!empty($idComment)) // verifica si la tarea existe
            $this->view->response($this->model->GetComment($idComment), 201);
        else
            $this->view->response("La tarea no se pudo insertar", 404);

    }

    public function DeleteComment($params = null){
        $id = $params[':ID'];
        $result = $this->model->DeleteComment($id);

        if($result > 0)
            $this->view->response("La tarea con el id=$id fue eliminada", 200);
        else
            $this->view->response("La tarea con el id=$id no existe", 404);

    }
}