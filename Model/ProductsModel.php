<?php

class ProductsModel{

    private $db;
    //CREO LA CONEXIÓN CON LA BASE DE DATOS
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=carrito_de_compras;charset=utf8', 'root', '');
    }
    //BUSCO TODOS LOS PRODUCTOS
    function GetProducts(){
        $sentencia = $this->db->prepare("SELECT * FROM producto");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
    //BUSCO UN SOLO PRODUCTO POR ID
    function GetProduct($product_id){
        $sentencia = $this->db->prepare("SELECT * FROM producto WHERE id=?");
        $sentencia->execute(array($product_id));
        return $sentencia->fetch(PDO::FETCH_OBJ);
    }
    //INSERTO UN PRODUCTO
    function InsertProduct($product,$price,$stock,$description,$brand){
        $sentencia = $this->db->prepare("INSERT INTO producto(nombre, precio, stock, descripcion, id_marca) VALUES(?,?,?,?,?)");
        $sentencia->execute(array($product,$price,$stock,$description,$brand));
    }
    //ELIMINO UN PRODUCTO
    function DeleteProduct($product_id){
        $sentencia = $this->db->prepare("DELETE FROM producto WHERE id=?");
        $sentencia->execute(array($product_id));
    }
    //ACTUALIZA DATOS DE UN PRODUCTO
    function UpdateProduct($product_id,$product,$price,$stock,$description,$brand){
        $sentencia = $this->db->prepare("UPDATE producto SET nombre=$product, precio=$price, stock=$stock, descripcion=$description, id_marca=$brand WHERE id=?");
        $sentencia->execute(array($product_id,$product,$price,$stock,$description,$brand));
    }
    //BUSCO TODAS LAS MARCAS
    function GetMarks(){
        $sentencia = $this->db->prepare("SELECT * FROM marca");
        $sentencia->execute();
        return $sentencia->fetchAll(PDO::FETCH_OBJ);
    }
}

?>