<?php

    class UserModel{

        private $db;
        //CREO LA CONEXIÓN CON LA BASE DE DATOS
        function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=carrito_de_compras;charset=utf8', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        //BUSCO TODOS LOS USUARIOS
        function GetUsers(){
            $sentencia = $this->db->prepare("SELECT * FROM usuario");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
       
    }
?>