<?php
require_once './Model/CommentModel.php';
require_once 'ApiController.php';

class ApiCommentController extends ApiController {

  
    function __construct() {
        parent::__construct();
        $this->model = new CommentModel();
    }

    public function GetComments($params = null) {
        $id_product = $params[':ID'];
        $comments = $this->model->GetCommentByProduct($id_product);
        if (!empty($comments)) {
            $this->view->response($comments, 200);
        }// else {
            //$this->view->response("Los comentarios del producto con el id=$id_product no existen", 404);
        //}
    }

    public function InsertComment($params = null){
        $body = $this->getData();

        $idComment = $this->model->InsertComment($body->comentario,$body->valoracion,$body->id_usuario,$body->id_producto);

        if (!empty($idComment)) {
            $this->view->response($this->model->GetComment($idComment), 201);
        } else {
            $this->view->response("El comentario no se pudo insertar", 404);
        }
    }

    public function DeleteComment($params = null){
        $id = $params[':ID'];
        $result = $this->model->DeleteComment($id);

        if($result > 0) {
            $this->view->response("El comentario con el id=$id fue eliminada", 200);
        } else {
            $this->view->response("El comentario con el id=$id no existe", 404);
        }
    }
}