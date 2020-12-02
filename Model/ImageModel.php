<?php

class ImageModel {
    private $db;
    //CREO LA CONEXIÓN CON LA BASE DE DATOS
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=carrito_de_compras;charset=utf8', 'root', '');
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }
    //BUSCO TODAS LAS IMAGENES
    function GetImagen(){
        $sentencia = $this->db->prepare("SELECT * FROM imagen");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    //BUSCO LAS IMAGENES DE UN PRODUCTO EN ESPECIFICO
    function GetImagenByProduct($id_product){
        $sentencia = $this->db->prepare("SELECT * FROM imagen WHERE id_producto=?");
        $sentencia->execute(array($id_product));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    //BUSCA FILEPATH DE IMAGEN PARA LUEGO ELIMINARLA DEL SERVIDOR
    function SearchFilepath($image_id){
        $sentencia = $this->db->prepare("SELECT imagen FROM imagen WHERE id=?");
        $sentencia->execute(array($image_id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    //BORRA LA IMAGEN
    function DeleteImg($image_id){
        $sentencia = $this->db->prepare("DELETE FROM imagen WHERE id=?");
        $sentencia->execute(array($image_id));
    }
    //BUSCA SI ESTE FILEPATH ESTA EN USO
    function SearchImageInUse($filepath){
        $sentencia = $this->db->prepare("SELECT imagen FROM imagen WHERE imagen=?");
        $sentencia->execute(array($filepath));
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    //AGREGAR UNA IMAGEN
    function InsertImg($filepath, $id_product){
        $sentencia = $this->db->prepare("INSERT INTO imagen(imagen, id_producto) VALUES(?,?)");
        $sentencia->execute(array($filepath, $id_product));
    }
}
?>