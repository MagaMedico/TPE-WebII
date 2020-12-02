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
            $sentencia = $this->db->prepare("SELECT * FROM producto INNER JOIN marca ON producto.id_marca = marca.id_marca ORDER BY producto.id");
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
            return $this->db->lastInsertId();
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
            $sentencia->execute(array($mark_id));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BUSCA PRODUCTOS CON UN LIMITE DESDE QUE PRODUCTO Y CUANTOS RESULTADOS
        function GetProductsByLimit($desde, $productoPorPagina){
            $sentencia = $this->db->prepare("SELECT * FROM producto INNER JOIN marca ON producto.id_marca = marca.id_marca LIMIT $desde,$productoPorPagina");
            $sentencia->execute();
            return $sentencia->fetchAll(PDO::FETCH_OBJ);//
        }
        //BUSCO ITEMS SEGÚN UN NOMBRE
        function SearchItemByName($search){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE nombre LIKE '%' ? '%' ");
            $sentencia->execute(array($search));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BUSCO ITEMS SEGÚN UN PRECIO
        function SearchItemByPrice($precioMinimo, $precioMaximo){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE precio BETWEEN ? AND ?");
            $sentencia->execute(array($precioMinimo, $precioMaximo));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
        //BUSCO ITEMS SEGÚN UN NOMBRE Y UN PRECIO
        function SearchItem($name, $precioMinimo, $precioMaximo){
            $sentencia = $this->db->prepare("SELECT * FROM producto WHERE nombre LIKE '%' ? '%' AND precio BETWEEN ? AND ?");
            $sentencia->execute(array($name, $precioMinimo, $precioMaximo));
            return $sentencia->fetchAll(PDO::FETCH_OBJ);
        }
    }
?>