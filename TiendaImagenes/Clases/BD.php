<?php
require_once("accesorio.php");

class Base{

    public static function realizarConexion(){   
        try {
            $conexion = new PDO("mysql:host=localhost; dbname=tiendaimagenes","root","");
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $conexion->exec("SET CHARACTER SET utf8");
            return $conexion;
        }
        catch(Exception $e)
        {
          echo "Error al realizar la conexión: " . $e->getMessage();
        }    
    }
		
        public static function getAccesorios(){
            try{
            $sql="SELECT * FROM ACCESORIOS ORDER by foto";
            $conexion=self::realizarConexion();
            $resultado=$conexion->prepare($sql);
            $resultado->execute(array());
            $arra_autores=array();
            while ($fila=$resultado->fetch()){
                $arra_autores[]= new Accesorio($fila);
            }
            $resultado->closeCursor();
            return ($arra_autores);
            }catch (PDOException $e){
                echo $e->getMessage();
            } finally{
                $conexion=null;
            }
        }

        public static function numeroRegistros(){
            try{
            $sql="select count(*) as 'contador' from accesorios";
            $conexion=self::realizarConexion();
            $resultado=$conexion->prepare($sql);
            $resultado->execute(array());
            $fila=$resultado->fetch();
            $contador=$fila[0];
            $resultado->closeCursor();
            return ($contador);
            }catch (PDOException $e){
                echo $e->getMessage();
            } finally{
                $conexion=null;
            }
                  
        }

        public static function get1AccesorioPos($pos){
            try{
            $sql="select * from accesorios order by foto LIMIT :n_pos, 1";
            $conexion=self::realizarConexion();
            $resultado=$conexion->prepare($sql);
            $resultado->bindParam(':n_pos', $pos, PDO::PARAM_INT);
            $resultado->execute();
            $fila=$resultado->fetch();
            $accesorio= new Accesorio($fila);
            return ($accesorio);
            }catch (PDOException $e){
                echo $e->getMessage();
            } finally{
                $conexion=null;
            }
            
        }

        public static function get1AccesorioCodigo($valor){
            try{
            $sql="select * from accesorios  WHERE codigoAcc=:valor";
            $conexion=self::realizarConexion();
            $resultado=$conexion->prepare($sql);
            $resultado->execute(array(":valor"=>$valor));
            $fila=$resultado->fetch();
            $accesorio= new Accesorio($fila);
            return ($accesorio);
        }catch (PDOException $e){
            echo $e->getMessage();
        } finally{
            $conexion=null;
        }
    }

    }
    ?>