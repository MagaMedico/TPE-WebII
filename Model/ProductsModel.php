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
        function InsertProduct($product,$price,$stock,$description,$fileTemp=null,$brand){
            $name = basename($_FILES["input_file"]["name"]);
            $filepath = "img/". $name;
            move_uploaded_file($fileTemp, $filepath);
            $sentencia = $this->db->prepare("INSERT INTO producto(nombre, precio, stock, descripcion, imagen, id_marca) VALUES(?,?,?,?,?,?)");
            $sentencia->execute(array($product,$price,$stock,$description,$filepath,$brand));
        }
        //ELIMINO UN PRODUCTO
        function DeleteProduct($product_id){
            $sentencia = $this->db->prepare("DELETE FROM producto WHERE id=?");
            $sentencia->execute(array($product_id));
        }
        //ACTUALIZA DATOS DE UN PRODUCTO CON IMAGEN
        function UpdateProductImg($product,$price,$stock,$description,$fileTemp,$brand,$product_id){
            $name = basename($_FILES["edit_file"]["name"]);
            $filepath = "img/". $name;
            move_uploaded_file($fileTemp, $filepath);
            $sentencia = $this->db->prepare("UPDATE producto SET nombre=?, precio=?, stock=?, descripcion=?, imagen=?, id_marca=? WHERE producto.id=?");
            $sentencia->execute(array($product,$price,$stock,$description,$filepath,$brand,$product_id));
        }
        //ACTUALIZA DATOS DE UN PRODUCTO SIN IMAGEN
        function UpdateProduct($product,$price,$stock,$description,$brand,$product_id){
            $sentencia = $this->db->prepare("UPDATE producto SET nombre=?, precio=?, stock=?, descripcion=?, id_marca=? WHERE producto.id=?");
            $sentencia->execute(array($product,$price,$stock,$description,$brand,$product_id));
        }
        //BUSCO LOS PRODUCTOS QUE COICIDAN CON EL ID DEL FILTRO POR MARCA
        function GetProductsByMark($mark_id){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE id_marca=?");
            $sentencia->execute(array($mark_id));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BUSCA PRODUCTOS CON UN LIMITE DESDE QUE PRODUCTO Y CUANTOS RESULTADOS
        function GetProductsByLimit($desde, $productoPorPagina){
            $sentencia = $this->db->prepare("SELECT * FROM producto INNER JOIN marca ON producto.id_marca = marca.id_marca LIMIT $desde,$productoPorPagina");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BORRA LA IMAGEN
        function DeleteImg($product_id){
            $sentencia = $this->db->prepare("UPDATE producto SET imagen = NULL WHERE id=?");
            $sentencia->execute(array($product_id));
        }
        //BUSCA FILEPATH DE IMAGEN PARA LUEGO ELIMINARLA DEL SERVIDOR
        function SearchFilepath($product_id){
            $sentencia = $this->db->prepare("SELECT imagen FROM producto WHERE id=?");
            $sentencia->execute(array($product_id));
            return $sentencia->fetch(PDO::FETCH_OBJ);
        }
        //BUSCO ITEMS SEGÚN UN NOMBRE
        function SearchItemByName($search){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE nombre=?");
            $sentencia->execute(array($search));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BUSCO ITEMS SEGÚN UN PRECIO
        function SearchItemByPrice($search){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE precio=?");
            $sentencia->execute(array($search));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BUSCO ITEMS SEGÚN UN NOMBRE Y UN PRECIO
        function SearchItem($name, $price){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE nombre=? AND precio=?");
            $sentencia->execute(array($name, $price));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>