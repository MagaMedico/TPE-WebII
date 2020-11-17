<?php
require_once "./libs/smarty/Smarty.class.php";

class UserView{
    
    private $smarty;

    function __construct(){
        $this->smarty = new Smarty();
    }
    //MUESTRA EL LOGIN
    function ShowUsers($users){
        $this->smarty->assign('users', $users);
        $this->smarty->display('templates/users.tpl');        
    }
    //MUESTRA LA PANTALLA DE EDITAR USUARIO
    function ShowEdit($user){
        $this->smarty->assign('user', $user);
        $this->smarty->display('templates/editUser.tpl');
    }
}
?>