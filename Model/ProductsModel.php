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
        //ACTUALIZA DATOS DE UN PRODUCTO
        function UpdateProductImg($product,$price,$stock,$description,$fileTemp=null,$brand,$product_id){
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
            $sentencia->execute([$mark_id]);
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BUSCA PRODUCTOS CON UN LIMITE DESDE QUE PRODUCTO Y CUANTOS RESULTADOS
        function GetProductsByLimit($desde, $productoPorPagina){
            $sentencia = $this->db->prepare("SELECT * FROM producto LIMIT $desde,$productoPorPagina");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BORRA LA IMAGEN
        function DeleteImg($filepath, $product_id){
            $sentencia = $this->db->prepare("UPDATE producto SET imagen=? WHERE id=?");
            $sentencia->execute(array($filepath,$product_id));
        }
    }
?>