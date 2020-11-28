<?php

class CommentModel{

    private $db;
    //CREO LA CONEXIÓN CON LA BASE DE DATOS
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=carrito_de_compras;charset=utf8', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    //TRAIGO LOS COMENTARIO DE UN PRODUCTO
    function GetCommentByProduct($id_producto){
        $sentencia=$this->db->prepare("SELECT * FROM comentario WHERE id_producto=?");
        $sentencia->execute(array($id_producto));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    //TRAIGO UN COMENTARIO POR UN ID
    function GetComment($id_comentario){
        $sentencia=$this->db->prepare("SELECT * FROM comentario WHERE id_comentario=?");
        $sentencia->execute(array($id_comentario));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    //INSERTA UN COMENTARIO
    function InsertComment($comentario, $valoracion, $id_usuario, $id_producto){
        $sentencia = $this->db->prepare("INSERT INTO comentario(comentario, valoracion, id_usuario, id_producto) VALUES(?,?,?,?)");
        $sentencia->execute(array($comentario, $valoracion, $id_usuario, $id_producto));
        return $this->db->lastInsertId();
    }
    //BORRA UN COMENTARIO
    function DeleteComment($id_comentario){
        $sentencia = $this->db->prepare("DELETE FROM comentario WHERE id_comentario=?");
        $sentencia->execute(array($id_comentario));
    }
}