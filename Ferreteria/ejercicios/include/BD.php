<?php
include_once "productos.php";
class Base {
    private static function realizarConexion() {  
        try {
            $conexion = new PDO("mysql:host=localhost; dbname=ferreteria", "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo 'ERROR - No se ha podido conectar con la BD: ' . $e->getMessage();
            exit;
        }
        return $conexion;
    }

    public static function getProductos() {
        try {
            $sql = "SELECT * FROM PRODUCTOS";
            $conexion = self::realizarConexion();
            $resultado = $conexion->query($sql);
            $arra_productos = array();
            while ($fila = $resultado->fetch()) {
                $arra_productos[] = new Productos($fila);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conexion = null;
        }
        return $arra_productos;
    }

    public static function eliminarProducto($codigo) {
        try {
            $conexion = self::realizarConexion();
            $sql = "DELETE FROM productos WHERE CODIGOARTICULO = :codigo";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':codigo', $codigo);
            $stmt->execute();
        } catch (PDOException $e) {
            echo 'Error al eliminar el producto: ' . $e->getMessage();
        } finally {
            $conexion = null;
        }
    }
      // Método para encontrar un producto
      public static function encontrarProduto($codigo) {
        try{
            $sql="SELECT * FROM PRODUCTOS WHERE  CODIGOARTICULO  = :n_codigo";
            $conexion=self::realizarConexion();
            $resultado=$conexion->prepare($sql);
            $resultado->execute(array(":n_codigo"=> $codigo));
            $fila=$resultado->fetch();
            $producto= new Productos($fila);
            $resultado->closeCursor();
            }catch (PDOException $e){
            return 0;
             }finally{
                $conexion=null;
             }
                    
            return ($producto);
    }

    public static function modificarProducto($dato1,$dato2,$dato3,$dato4,$dato5,$dato6){
		try{
			$sql = "UPDATE PRODUCTOS SET SECCION=:n_seccion, NOMBREARTICULO= :n_nombre, FECHA=:n_fecha, PAISDEORIGEN=:n_pais, PRECIO=:n_precio WHERE CODIGOARTICULO=:n_codigo";
        	$conexion=self::realizarConexion($sql);
			$resultado=$conexion->prepare($sql);
			$resultado->execute(array(":n_seccion"=> $dato2,":n_nombre"=> $dato3,":n_fecha"=> $dato4,":n_pais"=> $dato5,":n_precio"=> $dato6,":n_codigo"=> $dato1));
            $resultado->closeCursor();
			return 1;
			}catch (PDOException $e){
				return 0;
                
			}finally{
                $conexion=null;
        }
    }
    public static function insertar_producto($dato1,$dato2,$dato3,$dato4,$dato5,$dato6){
        try{
    $sql="INSERT INTO `PRODUCTOS` (`CODIGOARTICULO`, `SECCION`, `NOMBREARTICULO`, `FECHA`, `PAISDEORIGEN`, `PRECIO` )
            VALUES (:n_codigo, :n_seccion, :n_nombre, :n_fecha, :n_pais, :n_precio) ";
            $conexion=self::realizarConexion($sql);
            $resultado=$conexion->prepare($sql);
            $afectados=$resultado->execute(array(":n_seccion"=> $dato2,":n_nombre"=> $dato3,":n_fecha"=> $dato4,":n_pais"=> $dato5,":n_precio"=> $dato6,":n_codigo"=> $dato1));
            $resultado->closeCursor();
            
            //return 1;
            return ($afectados);
        }catch (PDOException $e){
            if ($e->getCode()==23000)
            return 0;
            
         }finally{
            $conexion=null;
         }
                    
        }


        public static function getProductosLimites($inicio,$fin){
           // $sql="SELECT * FROM PRODUCTOS limit $inicio, $fin";
           $sql="SELECT * FROM PRODUCTOS limit :n_inicio, :n_fin";
            $conexion=self::realizarConexion();
            $resultado=$conexion->prepare($sql);
            //$resultado->execute(array(":n_inicio"=> $inicio,":n_fin"=> $fin));
           
            $resultado->bindValue(':n_inicio', $inicio , PDO::PARAM_INT);
            $resultado->bindValue(':n_fin', $fin, PDO::PARAM_INT);
            $resultado->execute();
            $arra_productos=array();
            while ($fila=$resultado->fetch()){
                $arra_productos[]= new Productos($fila);
            }
            $resultado->closeCursor();
            return ($arra_productos);
        }

}

?>