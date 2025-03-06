<?php
class Base {
    private static function realizarConexion() {  
        try {
            $conexion = new PDO("mysql:host=localhost; dbname=lindavista", "root", "");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET utf8");
        } catch (PDOException $e) {
            echo 'ERROR - No se ha podido conectar con la BD: ' . $e->getMessage();
            exit;
        }
        return $conexion;
    }
    public static function getViviendas() {
        try {
            $sql = "SELECT * FROM viviendas";
            $conexion = self::realizarConexion();
            $resultado = $conexion->query($sql);
            $arrayViviendas = array();
            while ($fila = $resultado->fetch()) {
                $arrayViviendas[] = new Viviendas($fila);
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        } finally {
            $conexion = null;
        }
        return $arrayViviendas;
    }

    public static function getViviendasPag($inicio,$fin){
        
        $sql="SELECT * FROM viviendas limit :n_inicio, :n_fin";
         $conexion=self::realizarConexion();
         $resultado=$conexion->prepare($sql);
         
        
         $resultado->bindValue(':n_inicio', $inicio , PDO::PARAM_INT);
         $resultado->bindValue(':n_fin', $fin, PDO::PARAM_INT);
         $resultado->execute();
         $arrayViviendas=array();
         while ($fila=$resultado->fetch()){
             $arrayViviendas[]= new Viviendas($fila);
         }
         $resultado->closeCursor();
         return ($arrayViviendas);
     }
     public static function contarViviendas(){
        try {
            $sql = "SELECT COUNT(*) FROM viviendas"; // Consulta para contar el total de viviendas
            $conexion = self::realizarConexion();
            $resultado = $conexion->query($sql);
            return $resultado->fetchColumn(); // Devuelve el número total de registros
        } catch (PDOException $e) {
            echo $e->getMessage();
            return 0; // En caso de error, devuelve 0
        } finally {
            $conexion = null; // Cierra la conexión
        }
     }
     public static function insertarVivienda($tipo, $zona, $direccion, $ndormitorios, $precio, $tamano, $extras, $foto, $observaciones) {
        try {
            $conexion = self::realizarConexion();
            $sql = "INSERT INTO viviendas (tipo, zona, direccion, ndormitorios, precio, tamano, extras, foto, observaciones) 
                    VALUES (:tipo, :zona, :direccion, :ndormitorios, :precio, :tamano, :extras, :foto, :observaciones)";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':zona', $zona);
            $stmt->bindParam(':direccion', $direccion);
            $stmt->bindParam(':ndormitorios', $ndormitorios);
            $stmt->bindParam(':precio', $precio);
            $stmt->bindParam(':tamano', $tamano);
            $stmt->bindParam(':extras', $extras);
            $stmt->bindParam(':foto', $foto);
            $stmt->bindParam(':observaciones', $observaciones);
            $stmt->execute();

            return true; // Retorna verdadero si la inserción fue exitosa
        } catch (PDOException $e) {
            echo "Error al insertar la vivienda: " . $e->getMessage();
            return false; // Retorna falso si hubo un error
        }
    }
    public static function borrarVivienda($id) {
        try {
            $conexion = self::realizarConexion();
            $sql = "DELETE FROM viviendas WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
    
            return $stmt->rowCount() > 0; // Retorna verdadero si se borró al menos una fila
        } catch (PDOException $e) {
            echo "Error al borrar la vivienda: " . $e->getMessage();
            return false; // Retorna falso si hubo un error
        }
    }
}

?>