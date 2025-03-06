<?php
    class Base {
        private static function realizarConexion() {  
            try {
                $conexion = new PDO("mysql:host=localhost; dbname=dwes2", "root", "");
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
                $sql = "SELECT p.cod, p.nombre, p.nombre_corto, p.descripcion, p.PVP, p.familia 
                        FROM producto p
                        LEFT JOIN borrados1 b ON p.cod = b.producto
                        WHERE b.producto IS NULL";
                $conexion = self::realizarConexion();
                $resultado = $conexion->query($sql);
                $arra_productos = array();
                
                while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {
                    $producto = new Productos($fila); // Crear una instancia de Productos
                    $arra_productos[] = $producto; // Almacenar el objeto
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            } finally {
                $conexion = null;
            }
            return $arra_productos; // Retornar el array de objetos Productos
        }

        public static function getTotalUnidades($codigoProducto) {
            
            try {
                $sql = "SELECT COALESCE(SUM(s.unidades), 0) AS total_unidades
                        FROM stock s
                        WHERE s.producto = :codigoProducto";
                $conexion = self::realizarConexion(); // Conectar a la base de datos
                $stmt = $conexion->prepare($sql);
                $stmt->bindParam(':codigoProducto', $codigoProducto);
                $stmt->execute();
        
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                if ($resultado === false) {
                    throw new Exception("No se encontraron resultados para el producto: $codigoProducto");
                }
                return $resultado['total_unidades']; // Retornar el total de unidades
            } catch (PDOException $e) {
                echo "Error de base de datos: " . $e->getMessage();
                return 0; // Retornar 0 en caso de error
            } catch (Exception $e) {
                echo "Error: " . $e->getMessage();
                return 0; // Retornar 0 en caso de error
            } finally {
                $conexion = null; // Cerrar la conexión
            }
        }
         public static function verTienda($cod){
            try {
                /* SELECT t.cod, t.nombre from tienda t left join stock s on s.tienda where s.producto = "3DSNG"; */
                $sql = " SELECT t.nombre, s.unidades FROM tienda t JOIN stock s ON t.cod = s.tienda WHERE s.producto = :cod";
                $conexion = self::realizarConexion();
                $stmt = $conexion->prepare($sql); // Preparar la declaración
                $stmt->bindParam(':cod', $cod);
                $stmt->execute();

                $tiendas = array();
                while ($fila = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $tiendas[] = $fila; // Almacenar la fila directamente
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            } finally {
                $conexion = null;
            }
            return $tiendas;
        }

        public static function comprarProductos($productosSeleccionados) {
            // Conectar a la base de datos
            $conexion = self::realizarConexion(); // Asegúrate de que este método esté disponible
        
            try {
                // Preparar la consulta para obtener la tienda y las unidades del stock
                $sqlStock = "SELECT s.tienda, s.unidades 
                             FROM stock s 
                             WHERE s.producto = :producto";
                $stmtStock = $conexion->prepare($sqlStock);
        
                // Preparar la consulta para insertar en la tabla borrados1
                $sqlInsert = "INSERT INTO borrados1 (producto, tienda, unidades) VALUES (:producto, :tienda, :unidades)";
                $stmtInsert = $conexion->prepare($sqlInsert);
        
                foreach ($productosSeleccionados as $producto) {
                    // Obtener la tienda y las unidades del stock
                    $stmtStock->bindParam(':producto', $producto);
                    $stmtStock->execute();
                    $stockInfo = $stmtStock->fetch(PDO::FETCH_ASSOC);
        
                    if ($stockInfo) {
                        $tienda = $stockInfo['tienda'];
                        $unidades = $stockInfo['unidades'];
        
                        // Insertar en la tabla borrados1
                        $stmtInsert->bindParam(':producto', $producto);
                        $stmtInsert->bindParam(':tienda', $tienda);
                        $stmtInsert->bindParam(':unidades', $unidades);
                        $stmtInsert->execute(); // Ejecutar la inserción
                    } else {
                        return "No se encontró información de stock para el producto: $producto.";
                    }
                }
        
                return "Productos comprados con éxito.";
            } catch (PDOException $e) {
                return "Error al comprar productos: " . $e->getMessage();
            } finally {
                $conexion = null; // Cerrar la conexión
            }
        }
        public static function getBorrados() {
            try {
                $sql = "SELECT * from borrados1";
                $conexion = self::realizarConexion();
                $resultado = $conexion->query($sql);
                $arrayBorrados = array();
                
                while ($fila = $resultado->fetch(PDO::FETCH_ASSOC)) {

                    $arrayBorrados[] = $fila;
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            } finally {
                $conexion = null;
            }
            return $arrayBorrados; // Retornar el array de objetos Productos
        }

        public static function borrarProductosBorrados() {
            
            try {
                // Primero, eliminar los registros de stock que dependen de los productos
                $sqlStock = "DELETE FROM stock WHERE producto IN (SELECT producto FROM borrados1)";
                $conexion = self::realizarConexion(); // Conectar a la base de datos
                $stmtStock = $conexion->prepare($sqlStock);
                $stmtStock->execute();
        
                // Luego, eliminar los productos de la tabla productos que están en la tabla borrados1
                $sqlProducto = "DELETE FROM producto WHERE cod IN (SELECT producto FROM borrados1)";
                $stmtProducto = $conexion->prepare($sqlProducto);
                $stmtProducto->execute();

                // Finalmente, eliminar los registros de la tabla borrados1
                $sqlBorrados = "DELETE FROM borrados1";
                $stmtBorrados = $conexion->prepare($sqlBorrados);
                $stmtBorrados->execute();
        
                // Verificar cuántas filas fueron eliminadas
                return $stmtProducto->rowCount(); // Retornar el número de filas eliminadas
            } catch (PDOException $e) {
                echo "Error al borrar productos: " . $e->getMessage();
                return 0; // Retornar 0 en caso de error
            } finally {
                $conexion = null; // Cerrar la conexión
            }
        }
    }
?>