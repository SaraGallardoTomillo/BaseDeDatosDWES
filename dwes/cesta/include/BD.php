<?php

class Base{
   
    private static function realizarConexion(){  
    try {
        $conexion = new PDO("mysql:host=localhost; dbname=dwes","root","");

        $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conexion->exec("SET CHARACTER SET utf8");
    } catch (PDOException $e) {
        echo 'ERROR - No se ha podido conectar con la BD: ' . $e->getMessage();
        exit;
    }
        return $conexion;
    }

    public static function getUsuario($dato1, $dato2){
        try{
            $sql = "SELECT * FROM usuarios WHERE usuario=:usuario AND contrasena= md5(:contrasena) ";
            $conexion=self::realizarConexion();
            $smt=$conexion->prepare($sql);
            $smt->execute(array(":usuario"=>$dato1,":contrasena"=>$dato2));
            $resultados=$smt->fetchAll();
            $contador=count($resultados);
            $smt->closeCursor();
        } catch (PDOException $e) {
            echo "ERROR - ): " . $e->getMessage();
            
        } finally{
            $conexion=null;
            
            return $contador;
        }
    }
    public static function getProductos(){
            
        try{
            $conexion=self::realizarConexion();
            $sql = "SELECT cod, nombre_corto, PVP FROM producto";
            $smt=$conexion->prepare($sql);
            $smt->execute(array());
            $arra_productos=array();
            while ($fila=$smt->fetch()){
                $arra_productos[]= new Productos($fila);
            }
            $smt->closeCursor();
            return ($arra_productos);
        } catch (PDOException $e) {
            echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
        } finally{
            $conexion=null;
        }
    }
    public static function getProductoPorCodigo($codigo) {
        try {
            $conexion = self::realizarConexion();
            $sql = "SELECT cod, nombre_corto, PVP FROM producto WHERE cod = :codigo"; // Asegúrate de que el nombre de la tabla sea correcto
            $smt = $conexion->prepare($sql);
            $smt->bindParam(':codigo', $codigo);
            $smt->execute();
            $resultado = $smt->fetch(PDO::FETCH_ASSOC);
            // Si se encuentra el producto, devolver un objeto de producto
            if ($resultado) {
                return new Productos($resultado); // Pasar el resultado completo como un arreglo
            }
        } catch (PDOException $e) {
            echo "ERROR - No se pudieron obtener los productos: " . $e->getMessage();
        } finally {
            $conexion = null;
        }
        return null; // Retornar null si no se encuentra el producto
    }
}

?>