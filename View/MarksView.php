<?php

    require_once "./libs/smarty/Smarty.class.php";

    class MarksView{

        private $title;
        private $smarty;
        
        function __construct(){
            $this->title = "Tabla de Marcas";
            $this->smarty = new Smarty();
        }
        //MUESTRO LA TABLA DE MARCAS
        function ShowMarks($marks){
            $this->smarty->assign('titulo', $this->title);
            $this->smarty->assign('marks', $marks);
            $this->smarty->display('templates/marks.tpl');
        }
        //VISTA PARA EDITAR UNA MARCA
        function ShowEditMark($mark){
            $this->smarty->assign('mark', $mark);
            $this->smarty->display('templates/editMark.tpl');  
        }
    }
?>