<?php
require_once "Productos.php";

class Base{

    public static function realizarConexion(){   
   
        try {
            $conexion = new PDO("mysql:host=localhost; dbname=pruebas","root","");
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

    public static function getProducto($dato1){
        try{
            $sql = "SELECT * FROM PRODUCTOS WHERE CODIGOARTICULO = '$dato1'";

            $conexion=self::realizarConexion();
            $resultado=$conexion->query($sql);
            $fila=$resultado->fetch();
            $producto= new Productos($fila);
        } catch (PDOException $e){
            echo $e->getMessage();
        } finally{
            $conexion=null;
        }
        return ($producto);
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