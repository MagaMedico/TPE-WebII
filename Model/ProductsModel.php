<?php

    class ProductsModel{

        private $db;
        //CREO LA CONEXIÓN CON LA BASE DE DATOS
        function __construct(){
            $this->db = new PDO('mysql:host=localhost;'.'dbname=carrito_de_compras;charset=utf8', 'root', '');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
        }
        //BUSCO TODOS LOS PRODUCTOS
        function GetProducts(){
            $sentencia = $this->db->prepare("SELECT * FROM producto");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BUSCO UN SOLO PRODUCTO POR ID
        function GetProductById($product_id){
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
        function UpdateProduct($product,$price,$stock,$description,$brand,$product_id){
            $sentencia = $this->db->prepare("UPDATE producto SET nombre=?, precio=?, stock=?, descripcion=?, id_marca=? WHERE producto.id=?");
            $sentencia->execute(array($product,$price,$stock,$description,$brand,$product_id));
        }
        //BUSCO LOS PRODUCTOS QUE COICIDAN CON EL ID DEL FILTRO POR MARCA
        function GetProductsByMark($mark_id){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE id_marca=?");
            $sentencia->execute([$mark_id]);
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>