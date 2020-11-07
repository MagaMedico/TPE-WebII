<?php
require_once './Model/CommentModel.php';
require_once 'ApiController.php';

class ApiCommentController extends ApiController {

  
    function __construct() {
        parent::__construct();
        $this->model = new CommentModel();
    }

    public function GetComments($params = null) {
       // $comments = $this->model->GetComments();
        //$this->view->response($comments, 200);
    }

    
}