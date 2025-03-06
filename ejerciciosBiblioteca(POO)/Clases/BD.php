<?php
    require_once 'Autor.php';

    class Base{
        public static function realizarConexion(){
            try {
                $conexion = new PDO("mysql:host=localhost; dbname=biblioteca","root","");
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $conexion->exec("SET CHARACTER SET utf8");
                return $conexion;
            }
            catch(Exception $e)
            {
              echo "Error al realizar la conexión: " . $e->getMessage();
            }    
        }

        public static function getInfoAutores(){
            try{
                $sql="Select * from autor;";
                $conexion = self::realizarConexion();
                $resultado = $conexion->query($sql);
                $arrayAutores=array();
                while($fila=$resultado->fetch()){
                    $arrayAutores[]= new Autor($fila);
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }finally{
                $conexion=null;
            }
            return ($arrayAutores);
        }

        public static function getAutorPorPais($dato){
            try{
                $sql= "SELECT NOMAUT FROM AUTOR WHERE PAIS='$dato1'";
                $conexion = self::realizarConexion();
                $resultado = $conexion->query($sql);
                $arrayAutores=array();
                while($fila=$resultado->fetch()){
                    $arrayAutores[] = new Autor($fila); 
                }
            }catch(PDOException $e){
                echo $e->getMessage();
            }finally{
                $conexion=null;
            }
            return ($arrayAutores);
        }
    }
?>