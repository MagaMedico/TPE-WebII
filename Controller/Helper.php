<?php

class Helper{
    //VEO SI ESTA LOGGEADO Y ES ADMINISTRADOR
    public function CheckLoggedIn(){
        session_start();
        if(isset($_SESSION['EMAIL'])){
            return true;
        }else{
            return false;
        }
    }
}

?>