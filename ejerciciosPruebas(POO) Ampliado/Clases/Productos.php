<?Php

class Productos {

	private $codigoArticulo;
	private $seccion;
	private $nombreArticulo;
	private $fecha;
	private $paisdeOrigen;
	private $precio;
	
	

	function __Construct ($registro){
		
		$this->codigoArticulo=  $registro['CODIGOARTICULO'];
		$this->seccion = $registro['SECCION'];
		$this->nombreArticulo = $registro['NOMBREARTICULO'];
		$this->fecha = $registro['FECHA'];
		$this->paisdeOrigen = $registro['PAISDEORIGEN'];
		$this->precio = $registro['PRECIO'];
		
	}

	//Getters	
	function getCodigoarticulo(){
		return $this->codigoArticulo;
	}
	function getSeccion(){
		return $this->seccion;
	}
	function getNombreArticulo(){
		return $this->nombreArticulo;
	}
	function getFecha(){
		return $this->fecha;
	}
	function getPaisdeOrigen(){
		return $this->paisdeOrigen;
	}
	function getPrecio(){
		return $this->precio;
	}
	

	//Setters
	function setCodigoArticulo($codigo){
		$this->codigoArticulo=$codigo;
	}

	function setSeccion($seccion){
		$this->seccion=$eccion;
	}
	
	function setNombreArticulo($nombre){
		$this->GAMA=$nombre;
	}
	function setFecha($fecha){
		$this->fecha=$fecha;
	}
	function setPaisdeOrigen($pais){
		$this->paisdeOrigen=$pais;
	}
	function setPrecio($precio){
		$this->precio=$precio;
	}
	

}
	
	

?>