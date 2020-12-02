<?php

    class UserModel{

        private $db;
        //CREO LA CONEXIÓN CON LA BASE DE DATOS
        function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=carrito_de_compras;charset=utf8', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        //TRAIGO UN USUARIO POR EMAIL
        function GetUser($user){
            $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE email=?");
            $sentencia->execute(array($user));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }
        //BUSCO TODOS LOS USUARIOS
        function GetUsers(){
            $sentencia = $this->db->prepare("SELECT * FROM usuario");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //TRAIGO UN SOLO USUARIO POR UN ID
        function GetUserById($id){
            $sentencia = $this->db->prepare("SELECT * FROM usuario WHERE id=?");
            $sentencia->execute(array($id));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }
        //CREA UN USUARIO
        function CreateUser($user, $password_hash, $admin){
            $sentencia = $this->db->prepare("INSERT INTO usuario (email, password, admin) VALUES(?,?,?)");
            $sentencia->execute(array($user,$password_hash,$admin));
        }
        //EDITO UN USUARIO
        function UpdateUser($admin, $id){
            $sentencia = $this->db->prepare("UPDATE usuario SET admin=? WHERE id=?");
            $sentencia->execute(array($admin, $id));
        }
        //BORRO UN USUARIO
        function DeleteUser($id){
            $sentencia = $this->db->prepare("DELETE FROM usuario WHERE id=?");
            $sentencia->execute(array($id));
        }
        //BUSCA SI EXISTE ALMENOS UN ADMINISTRADOR
        function ExistsAdmin(){
            $sentencia = $this->db->prepare("SELECT admin FROM usuario WHERE admin=?");
            $sentencia->execute(array(1));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>