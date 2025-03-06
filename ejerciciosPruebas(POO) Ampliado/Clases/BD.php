<?php
require_once "Productos.php";
//Cambiar la conexión a la base de datos a Pruebas2
//Utilizar nueva base de datos para realizar los cambios

class Base{

    public static function realizarConexion(){   
   
        try {
            $conexion = new PDO("mysql:host=localhost; dbname=pruebas2","root","");
            //$conexion = new PDO("mysql:host=localhost; dbname=$pruebas",$usuario,$clave);
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET utf8");
            return $conexion;
        }
        catch(Exception $e)
        {
          echo "Error al realizar la conexión: " . $e->getMessage();
        }    

		
    }
    public static function cambiarCodigo(){
        try {
            $conexion = self::realizarConexion();
            // Hacer CODIGOARTICULO la clave primaria
            $sql = "ALTER TABLE productos ADD PRIMARY KEY (CODIGOARTICULO)";
            $conexion->exec($sql);
    
            echo "Cambios realizados correctamente.";
        } catch (PDOException $e) {
            echo "Error al realizar los cambios: " . $e->getMessage();
        } finally {
            $conexion = null;
        }
    }

	public static function getProductos(){
        try{
            $sql="SELECT * FROM PRODUCTOS";
            $conexion=self::realizarConexion();
		    $resultado=$conexion->query($sql);
	        $arra_productos=array();
            while ($fila=$resultado->fetch()){
                $arra_productos[]= new Productos($fila);
            }
        } catch (PDOException $e){
                echo $e->getMessage();
        } finally{
		        $conexion=null;
            }
        return ($arra_productos);
    }

    public static function getSeccion($dato1){
        try{
            $sql="SELECT * FROM PRODUCTOS WHERE SECCION='$dato1'";
            $conexion=self::realizarConexion();
		    $resultado=$conexion->query($sql);
	        $arra_productos=array();
            while ($fila=$resultado->fetch()){
                $arra_productos[]= new Productos($fila);
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally{
            $conexion=null;
        }
        return ($arra_productos);
    }

    public static function getSeccionesDisponibles(){
        try{
            $sql="select distinct SECCION from productos";
            $conexion=self::realizarConexion();
            $resultado=$conexion->query($sql);
            $arraySecciones = array();
            while($fila=$resultado->fetch()){
                $arraySecciones[]=new Produtos($fila);
            }
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally{
            $conexion=null;
        }
        return($arraySecciones);
    }

    public static function getTotalSecciones($dato1){
        try{
            $sql="select SUM(PRECIO) AS total FROM productos WHERE SECCION = $dato1";
            $conexion=self::realizarConexion();
            $resultado=$conexion->query($sql);
            $fila = $resultado->fetch(PDO::FETCH_ASSOC);
            $total = new Productos($fila);
            
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally{
            $conexion=null;
        }
        return $total;
    }

    public static function getProducto($dato1) {
        $producto = null;
        try {
            $conexion = self::realizarConexion();
            $stmt = $conexion->prepare("SELECT * FROM PRODUCTOS WHERE CODIGOARTICULO = :codigo");
            $stmt->bindParam(':codigo', $dato1);
            $stmt->execute();
            $fila = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if ($fila) {
                $producto = new Productos($fila);
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        } finally {
            $conexion = null;
        }
        return $producto; // Devuelve null si no se encuentra el producto
    }

    public static function insertar_producto($dato1,$dato2,$dato3,$dato4, $dato5, $dato6){
        try {
		    $sql="insert into productos (codigoarticulo,seccion,nombrearticulo,fecha,paisdeorigen,precio)"; 
            $sql.="VALUES ('$dato1', '$dato2', '$dato3', '$dato4', '$dato5', '$dato6')";
            $conexion=self::realizarConexion();
            $afectados=$conexion->exec($sql);
            if ($afectados > 0){
                $mensaje= "Se ha realizado la inserccion del producto correctamente";
            }
            
        } catch (PDOException $e){
            echo $e->getMessage();
             $mensaje= "No se ha realizado la insercion del producto correctamente";
        }
        finally {
            $conexion=null;
        }
        return $mensaje;
                 
    }




    public static function actualizar_producto($codigo,$nombre,$precio){
        try {
		    $sql="update productos set nombrearticulo='$nombre', precio='$precio' where codigoarticulo='$codigo'";
            $conexion=self::realizarConexion();
            $afectados=$conexion->exec($sql);
            if ($afectados > 0){
                $mensaje= "Se ha realizado exitosamente la modificacion del producto";
            }else{
                $mensaje= "No ha sido posible realizar la modificacion del prodcuto: ".$codigo;
            }
         } catch (PDOException $e){
            echo $e->getMessage();
             $mensaje= "No ha sido posible realizar la modificacion del prodcuto";
        }finally {
            $conexion=null;
        }
        return $mensaje;
                 
    }

    public static function borrar_producto($cod){
        try {
            $sql="delete from productos where codigoarticulo='$cod'";
            $conexion=self::realizarConexion();
            $afectados=$conexion->exec($sql);
            if ($afectados > 0){
                $mensaje= "Se ha realizado exitosamente el borrado del producto";
            }else{
                $mensaje= "No ha sido posible realizar el borrado del prodcuto: ".$cod;
            }
       } catch (PDOException $e){
             echo $e->getMessage();
        }   finally {
                $conexion=null;
            }
        return $mensaje;
                 
    }
}

?>