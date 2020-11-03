<?php
require_once "./libs/smarty/Smarty.class.php";

class UserView{
    
    private $smarty;

    function __construct(){
        $this->smarty = new Smarty();
    }
    //MUESTRA EL LOGIN
    function ShowUsers($users){
        $this->smarty->assign('usuarios', $users);
        $this->smarty->display('templates/users.tpl');        
    }
}
?>