<?php

    require_once "./libs/smarty/Smarty.class.php";

    class MarksView{

        private $title;
        
        function __construct(){
            $this->title = "Tabla de Marcas";
        }
        //MUESTRO LA TABLA DE MARCAS
        function ShowMarks($marks){
            $smarty = new Smarty();
            $smarty->assign('titulo', $this->title);
            $smarty->assign('marks', $marks);
            // muestro el template 
            $smarty->display('templates/marks.tpl');
        }
        //VISTA PARA EDITAR UNA MARCA
        function ShowEditMark($mark){
            $smarty = new Smarty();
            $smarty->assign('mark', $mark);
            // muestro el template 
            $smarty->display('templates/editMark.tpl');  
        }
    }
?>