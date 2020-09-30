<?php

    class MarksModel{

        private $db;
        //CREO LA CONEXIÓN CON LA BASE DE DATOS
        function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=carrito_de_compras;charset=utf8', 'root', '');
        }
        //BUSCO TODAS LAS MARCAS
        function GetMarks(){
            $sentencia = $this->db->prepare("SELECT * FROM marca");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //INSERTA UNA MARCA
        function InsertMark($mark,$category){
            $sentencia = $this->db->prepare("INSERT INTO marca(marca, categoria) VALUES(?,?)");
            $sentencia->execute(array($mark,$category));
        }
        //ELIMINO UNA MARCA
        function DeleteMark($mark_id){
            $sentencia = $this->db->prepare("DELETE FROM marca WHERE id_marca=?");
            $sentencia->execute(array($mark_id));
        }
    }
?>